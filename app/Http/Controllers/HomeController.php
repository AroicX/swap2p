<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Carbon;
use App\Models\Merge;
use App\Models\Record;
use App\Models\Stage;
use App\Models\User;
use App\Models\Payment;

class HomeController extends Controller
{
    public function index()
    {
        $record = Record::where('user_id', Auth::user()->user_id)->first();
        $stage = Stage::where('sid', $record->stage)->first();
        $downlines = Payment::where('upline_id', Auth::user()->user_id)
            ->with('proof')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $mergeToPay = Merge::where([
            'downline' => Auth::user()->user_id,
            'status' => 0,
        ])->first();

        // return $downlines;

        if (Auth::user()->email === 'admin@yopmail.com') {
            return view('index', [
                'record' => $record,
                'stage' => $stage,
                'downlines' => $downlines,
                'showCount' => false,
                'countdown' => null,
            ]);
        }

        if ($mergeToPay) {
            if (intval($mergeToPay->status) === 0) {
                $now = Carbon::now();
                $end = new Carbon(
                    $mergeToPay->created_at->addDay()->toDateTimeString()
                );

                $timenow = $now->toDateTimeString();
                $timeend = $end->toDateTimeString();

                if ($now->gt($end)) {
                    $user = User::where(
                        'user_id',
                        Auth::user()->user_id
                    )->first();
                    $user->status = 'dormant';
                    $user->save();
                    $response = [
                        'message' => 'Your accuount has expired.',
                        'alert' => 'danger',
                    ];
                    Auth::logout();
                    return redirect('/')->with($response);
                }

                $countdown =
                    $end->isoFormat('ddd MMM D YYYY') .
                    ' ' .
                    $end->toTimeString() .
                    ' GMT+0100 (West Africa Standard Time)';

                return view('index', [
                    'record' => $record,
                    'stage' => $stage,
                    'downlines' => $downlines,
                    'showCount' => true,
                    'countdown' => $countdown,
                ]);
            }
        }

        return view('index', [
            'record' => $record,
            'stage' => $stage,
            'downlines' => $downlines,
            'showCount' => false,
            'countdown' => null,
        ]);
    }

    public function expired()
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();
        $user->status = 'dormant';
        $user->save();
        $response = [
            'message' => 'Your accuount has expired.',
            'alert' => 'danger',
        ];
        Auth::logout();
        // return redirect('/')->with($response);
    }

    public function profile()
    {
        return view('user.profile.index');
    }
    public function activate()
    {
        return view('user.verify');
    }
    public function edit_profile()
    {
        $user = User::findOrFail(Auth::id());
        return view('user.profile.edit', ['user' => $user]);
    }
    public function bank()
    {
        $user = User::findOrFail(Auth::id());
        return view('user.profile.bank', ['user' => $user]);
    }
    public function downlines()
    {
        $downlines = User::where('referral_code', Auth::user()->user_id)
            ->orderBy('id', 'desc')
            ->get();
        return view('user.downlines', ['downlines' => $downlines]);
    }
    public function genealogy()
    {
        return view('user.genealogy');
    }
    public function payment_history()
    {
        $uplines = Payment::where('downline_id', Auth::user()->user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $downlines = Payment::where('upline_id', Auth::user()->user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.payment_history', [
            'uplines' => $uplines,
            'downlines' => $downlines,
        ]);
    }
}
