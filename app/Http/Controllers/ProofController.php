<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Proof;
use App\Models\Merge;
use App\Models\User;
use App\Models\Record;
use App\Models\Payment;
use App\Models\Stage;
use Illuminate\Support\Facades\Auth;
use App\Mail\Approve;
use App\Mail\Approved;
use Illuminate\Support\Facades\Mail;

class ProofController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $validated = $request->validate([
                    'file' => 'mimes:jpeg,png|max:2048',
                ]);

                $extension = $request->file->extension();
                $name = time() . '.' . $extension;
                $request->file->move(public_path('proofs'), $name);

                $merge = Merge::where('id', $request->mid)->first();
                // $stage = Stage::where('id', $merge->stage)->first('amount');
                // $user = User::where('user_id', $merge->upline)->first();

                Proof::create([
                    'mid' => $request->mid,
                    'status' => 0,
                    'note' => $request->note,
                    'file' => $name,
                    'pid' => rand() . time(),
                ]);

                // Mail::to($data[1]['email'])->send(new Approve($data));

                $response = [
                    'message' => 'Proof uploaded',
                    'alert' => 'success',
                ];
                return redirect('/backoffice/merging')->with($response);
            }
        }
        abort(500, 'Could not upload image :(');
    }

    public function view($pid)
    {
        $proof = Proof::where('pid', $pid)->first();

        return view('user.view_proof', ['proof' => $proof]);
    }

    public function verify(Request $request)
    {
        $proof = Proof::findOrFail($request->id);
        $proof->status = 1;

        $merge = Merge::where('id', $proof->mid)->first();
        $stage = Stage::where('sid', $merge->stage)->first();
        $merge->status = 1;
        //GET UPLINE RECORDS
        $uplineRecord = Record::where('user_id', $merge->upline)->first();
        $newBrought = $uplineRecord->downline_brought + 1;
        $newLeft = $uplineRecord->downline_left - 1;
        $uplineRecord->downline_brought = $newBrought;
        $uplineRecord->downline_left = $newLeft;
        if ($newLeft == 0) {
            $uplineRecord->isQualified = 'yes';
        }

        $proof->save();
        $merge->save();
        $uplineRecord->save();

        $downlinePaymentHistory = new Payment();
        $downlinePaymentHistory->sid = $merge->stage;
        $downlinePaymentHistory->pid = $proof->id;
        $downlinePaymentHistory->upline_id = $merge->upline;
        $downlinePaymentHistory->downline_id = $merge->downline;
        $downlinePaymentHistory->amount = $stage->amount;
        $downlinePaymentHistory->purpose = 'Payment for merging';
        $downlinePaymentHistory->save();
        $response = [
            'message' => 'Proof verified',
            'alert' => 'success',
        ];

        // send mails
        // $user = User::where('user_id', $merge->upline)->first();
        // $data = [$stage, $user];
        // Mail::to(Auth::user()->email)->send(new Approved($data));

        return redirect('backoffice/merging')->with($response);
    }
    public function remove(Request $request)
    {
        $proof = Proof::findOrFail($request->id);
        unlink(public_path('proofs/' . $proof->file));
        $proof->delete();
        $response = [
            'message' => 'Proof deleted',
            'alert' => 'success',
        ];
        return redirect('backoffice/merging')->with($response);
    }
}
