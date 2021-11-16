<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use App\Models\Merge;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdministratorController extends Controller
{
    public function activites()
    {
        $activites = Activity::paginate(30);
        return view('admin.activites.index', ['activites' => $activites]);
    }
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }

    public function delete_user($user_id = null)
    {
        $user = User::where('user_id', $user_id)
            ->with('merges', 'merges.getDownline', 'record', 'payment')
            ->first();

        $delete = $user->deleteAll();

        if ($delete) {
            $notification = [
                'message' => 'User has been deleted.',
                'alert' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Error deleteing user.',
                'alert' => 'error',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }
    public function deleteMerings($user_id = null)
    {
        $user = User::where('user_id', $user_id)
            ->with('merges', 'merges.getDownline', 'record', 'payment')
            ->first();

        $delete = $user->deleteMerges();

        if ($delete) {
            $notification = [
                'message' => 'Merings has been deleted.',
                'alert' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Error deleteing merings.',
                'alert' => 'error',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }

    public function manage_merging()
    {
        // $merge = Merge::where('status', '0')
        //     ->with('stage')
        //     ->get();
        // $merges = Merge::orderBy('created_at', 'desc')->get();
        $merges = Merge::orderBy('created_at', 'desc')->paginate(30);
        return view('admin.merge.index', ['merges' => $merges]);
    }

    static function countdown($date)
    {
        $now = Carbon::now();
        $start = new Carbon($now->toDateTimeString());

        $end = new Carbon($date->addDay()->toDateTimeString());

        return $start->diffInHours($end);
    }

    public function toReceive($param)
    {
        if (!$param) {
            return redirect()->back();
        }

        $mergeToReceive = Record::where([
            'stage' => $param,
            ['downline_left', '>', 0],
        ])
            ->with([
                'user' => function ($q) {
                    return $q->where('status', '=', 'active')->get();
                },
            ])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.merge.next', ['mergeToReceive' => $mergeToReceive]);
    }
}
