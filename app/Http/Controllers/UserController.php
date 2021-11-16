<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bank;
use App\Models\Activity;
use App\Models\Record;
use App\Models\Stage;
use App\Models\Merge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update_profile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->save();
        Activity::create([
            'user_id' => Auth::user()->user_id,
            'message' => 'Profile updated',
        ]);
        $response = [
            'message' => 'Profile updated successfully',
            'alert' => 'success',
        ];
        return redirect('backoffice/profile')->with($response);
    }

    public function queue()
    {
        $record = Record::where('user_id', Auth::user()->user_id)->first();

        $mergeToReceive = Record::where([
            'stage' => $record->stage,
            ['downline_left', '>', 0],
        ])
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('user.queue', ['mergeToReceive' => $mergeToReceive]);
    }
    public function growth()
    {
       

        $mergeToReceive = Record::where([
            'stage' => 1,
            ['downline_left', '>', 0],
        ])
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('user.growth', ['mergeToReceive' => $mergeToReceive]);
    }

    public function update_password(Request $request)
    {
        $id = Auth::user()->id;
        $cpassword = $request->old;
        $newpassword = $request->new;
        $cnewpassword = $request->c_npassword;

        if (User::where('id', $id)) {
            if (Hash::check($cpassword, Auth::user()->password, [])) {
                if ($newpassword == $cnewpassword) {
                    $user = User::where('id', $id)->first();
                    $user->password = Hash::make($newpassword);
                    $user->save();

                    $notification = [
                        'message' =>
                            'Successful... You Have Channged your Password !',
                        'alert' => 'success',
                    ];
                    return redirect()
                        ->back()
                        ->with($notification);
                } else {
                    $notification = [
                        'message' =>
                            'New Password & Confirm Password No Match ',
                        'alert' => 'info',
                    ];
                    return redirect()
                        ->back()
                        ->with($notification);
                }
            } else {
                $notification = [
                    'message' => 'Old Password is invaild ',
                    'alert' => 'error',
                ];
                return redirect()
                    ->back()
                    ->with($notification);
            }
        }
    }

    public function update_bank(Request $request)
    {
        $getBank = Bank::where('bank_code', $request->bank_code)->first('id');
        $user = User::findOrFail(Auth::id());
        $user->bank_id = $getBank->id;
        $user->account_name = $request->acc_name;
        $user->account_number = $request->account_number;
        $user->save();
        Activity::create([
            'user_id' => Auth::user()->user_id,
            'message' => 'Bank details updated',
        ]);
        $response = [
            'message' => 'Bank details updated successfully',
            'alert' => 'success',
        ];
        return redirect('backoffice/profile')->with($response);
    }

    public function verify(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if ($user->evc == $request->evc) {
            $user->status = 'active';
            $user->save();
            // QUERY TO MAKE SURE USER REFERRAL DOESNT EXCEED REUQUIRED STAGE DOWNLINE GOES HERE
            // $merge = Merge::create([
            //     'upline' => $user->referral_code,
            //     'downline' => $user->user_id,
            //     'stage' => 1,
            //     'status' => 0,
            // ]);
            Activity::create([
                'user_id' => Auth::user()->user_id,
                'message' => 'Verify successfully',
            ]);
            $response = [
                'message' => 'Account verified',
                'alert' => 'success',
            ];
            return redirect('backoffice/profile/bank/details')->with($response);
        } else {
            $response = [
                'message' => 'Wrong verification code',
                'alert' => 'warning',
            ];
            return redirect('backoffice/profile/verify')->with($response);
        }
    }
    public function merging__old()
    {
        $mergeToPay = Merge::where([
            'downline' => Auth::user()->user_id,
            'status' => 0,
        ])->first();
        $mergeToReceive = Merge::where([
            'upline' => Auth::user()->user_id,
            'status' => 0,
        ])->get();
        $mergings = Merge::where([
            'downline' => Auth::user()->user_id,
            'status' => 1,
        ])
            ->orderBy('id', 'desc')
            ->get();

        // return $mergings;
        return view('user.merging', [
            'mergeToPay' => $mergeToPay,
            'mergeToReceive' => $mergeToReceive,
            'mergings' => $mergings,
        ]);
    }

    public function merging()
    {
        $record = Record::where('user_id', Auth::user()->user_id)->first();
        $stage = Stage::where('sid', $record->stage)->first();

        //fix merge errors

        $mergeToPay = null;
        $checkQueue = null;
        $mergeToPay = Merge::where([
            'downline' => Auth::user()->user_id,
            'status' => 0,
        ])
            ->with('getUpline', 'getDownline')
            ->first();

        if (intval($record->stage) === 1) {
            $mergeToReceive = Merge::where([
                'upline' => Auth::user()->user_id,
                'status' => 0,
            ])->get();
            $mergings = Merge::where([
                'downline' => Auth::user()->user_id,
                'status' => 1,
            ])
                ->orderBy('id', 'desc')
                ->get();

            return view('user.merging', [
                'mergeToPay' => $mergeToPay,
                'mergeToReceive' => $mergeToReceive,
                'mergings' => $mergings,
            ]);
        }

        if ($mergeToPay) {
            $checkQueue = Record::where(
                'user_id',
                $mergeToPay->upline
            )->first();
        }

        if ($checkQueue) {
            if ($checkQueue->isQualifed === 'no') {
                $mergeToReceive = Merge::where([
                    'upline' => Auth::user()->user_id,
                    'status' => 0,
                ])->get();
                $mergings = Merge::where([
                    'downline' => Auth::user()->user_id,
                    'status' => 1,
                ])
                    ->orderBy('id', 'desc')
                    ->get();

                return view('user.merging', [
                    'mergeToPay' => $mergeToPay,
                    'mergeToReceive' => $mergeToReceive,
                    'mergings' => $mergings,
                ]);
                // }
            } else {
                $findNext = Record::where([
                    'stage' => $record->stage,
                    ['downline_left', '>', 0],
                ])
                    ->with('user')
                    ->orderBy('created_at', 'asc')
                    ->first();

                $mergeToPay->upline = $findNext->user_id;
                $findNext->save();
                $mergeToPay->save();

                if ($mergeToPay->upline === Auth::user()->user_id) {
                    $getNext = Record::where([
                        'stage' => $record->stage,
                        ['downline_left', '>', 0],
                    ])
                        ->with([
                            'user' => function ($q) {
                                return $q
                                    ->where('status', '=', 'active')
                                    ->get();
                            },
                        ])
                        ->orderBy('created_at', 'asc')
                        ->skip(1)
                        ->first();

                    $mergeToPay->upline = $getNext->user_id;
                    $getNext->save();
                    $mergeToPay->save();

                    $mergeToReceive = Merge::where([
                        'upline' => Auth::user()->user_id,
                        'status' => 0,
                    ])->get();
                    $mergings = Merge::where([
                        'downline' => Auth::user()->user_id,
                        'status' => 1,
                    ])
                        ->orderBy('id', 'desc')
                        ->get();

                    return view('user.merging', [
                        'mergeToPay' => $mergeToPay,
                        'mergeToReceive' => $mergeToReceive,
                        'mergings' => $mergings,
                    ]);
                }

                $mergeToReceive = Merge::where([
                    'upline' => Auth::user()->user_id,
                    'status' => 0,
                ])->get();
                $mergings = Merge::where([
                    'downline' => Auth::user()->user_id,
                    'status' => 1,
                ])
                    ->orderBy('id', 'desc')
                    ->get();

                return view('user.merging', [
                    'mergeToPay' => $mergeToPay,
                    'mergeToReceive' => $mergeToReceive,
                    'mergings' => $mergings,
                ]);
            }
        }

        $mergeToReceive = Merge::where([
            'upline' => Auth::user()->user_id,
            'status' => 0,
        ])->get();
        $mergings = Merge::where([
            'downline' => Auth::user()->user_id,
            'status' => 1,
        ])
            ->orderBy('id', 'desc')
            ->get();

        return view('user.merging', [
            'mergeToPay' => $mergeToPay,
            'mergeToReceive' => $mergeToReceive,
            'mergings' => $mergings,
        ]);
    }

    public function upload_proof()
    {
        $id = Merge::where([
            'downline' => Auth::user()->user_id,
            'status' => 0,
        ])->value('id');
        return view('user.upload_proof', ['mid' => $id]);
    }

    public function upgrade()
    {
        $record = Record::where('user_id', Auth::user()->user_id)->first();
        $stage = Stage::where('sid', $record->stage)->first();

        return view('user.upgrade', ['record' => $record, 'stage' => $stage]);
    }
    public function stage_upgrade(Request $request)
    {
        $record = Record::where('user_id', $request->user_id)->first();
        if ($record->isQualified == 'yes') {
            $stage = $record->stage;
            $newStage = $stage + 1;
            $stage = Stage::where('sid', $newStage)->first();
            $record->isQualified = 'no';
            $record->stage = $newStage;
            $record->downline_brought = 0;
            $record->downline_left = $stage->downline;
        }

        $qualified = Record::where([
            'stage' => $record->stage,
            ['downline_left', '>', 0],
        ])
            ->orderBy('id', 'asc')
            ->first();
        if (!empty($qualified)) {
            $merge = new Merge();
            $merge->upline = $qualified->user_id;
            $merge->downline = $request->user_id;
            $merge->status = 0;
            $merge->stage = $record->stage;
            $merge->save();
            $qualified->save();
        }
        $record->save();
        //
        $response = [
            'message' => 'Upgraded successfully',
            'alert' => 'success',
        ];
        return redirect()
            ->back()
            ->with($response);
    }
}
