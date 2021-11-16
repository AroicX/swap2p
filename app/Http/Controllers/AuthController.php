<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMailer;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Activity;
use App\Models\Record;
use App\Models\Merge;
use App\Models\Stage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function signup()
    {
        return view('auth.signup');
    }
    public function reset()
    {
        return view('auth.reset');
    }
    public function referral_link($ref)
    {
        return redirect('/backoffice/signup?ref=' . $ref);
    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'referral_code' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $uplineData = Record::where(
            'user_id',
            $request->referral_code
        )->first();

        if (!empty($uplineData)) {
            if ($uplineData->stage === 1 && $uplineData->downline_left > 0) {
                $user = new User();
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->username = $request->username;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->referral_code = $request->referral_code;
                $user_id = substr(time(), 3, 9) . rand(10, 100);
                $user->user_id = $user_id;
                $user->evc = substr(rand(), 0, 5);
                $user->save();
                $stageDownline = Stage::where('sid', '1')->value('downline');

                Activity::create([
                    'user_id' => $user_id,
                    'message' => 'Registration',
                ]);
                Merge::create([
                    'upline' => $request->referral_code,
                    'downline' => $user->user_id,
                    'stage' => 1,
                    'status' => 0,
                ]);
                Record::create([
                    'user_id' => $user_id,
                    'stage' => 1,
                    'downline_brought' => 0,
                    'downline_left' => $stageDownline,
                ]);
                $response = [
                    'message' => 'Huraay, welcome onboard',
                    'alert' => 'success',
                ];

                return redirect('backoffice/login')->with($response);
            } else {
                $response = [
                    'message' => 'Error! Use a different referral code',
                    'alert' => 'error',
                ];
                return redirect('backoffice/signup')->with($response);
            }
        } else {
            $response = [
                'message' => 'Error! Referral code invalid',
                'alert' => 'error',
            ];
            return redirect('backoffice/signup')->with($response);
        }
    }
    public function signin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $last_login = new Carbon();

        $last_ip = [
            'user_ip' => $_SERVER['REMOTE_ADDR'],
            'browserAgent' => $_SERVER['HTTP_USER_AGENT'],
        ];
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->status === 'dormant') {
                throw ValidationException::withMessages([
                    'error' => 'Your accuount has expired',
                ]);
                return redirect()->back();
            }
            if ($user->status === 'block') {
                throw ValidationException::withMessages([
                    'error' => 'Your accuount has been blocked',
                ]);
                return redirect()->back();
            }
        }

        if (Auth::attempt($credentials)) {
            Activity::create([
                'user_id' => $user->user_id,
                'message' => 'Logged in',
            ]);

            User::where('user_id', $user->user_id)->update([
                'login_count' => $user->login_count + 1,
                'last_login' => $last_login->today()->toDateString(),
                'last_ip_used' => json_encode($last_ip),
            ]);

            Activity::create([
                'user_id' => $user->user_id,
                'message' => 'ip address logged ',
                'data' => $last_login,
            ]);

            $response = [
                'message' => 'Login successfully.',
                'alert' => 'success',
            ];

            return redirect('backoffice')->with($response);
        } else {
            throw ValidationException::withMessages([
                'error' => 'Invalid login credentials provided',
            ]);

            return redirect()->back();
        }
    }

    public function logout()
    {
        $activity = Activity::create([
            'user_id' => Auth::user()->user_id,
            'message' => 'Logged out',
        ]);
        Auth::logout();
        $response = [
            'message' => 'Logged out.',
            'alert' => 'success',
        ];
        return redirect('/')->with($response);
    }
}
