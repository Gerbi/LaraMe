<?php

namespace App\Http\Controllers;

use App\friendships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\notifications;

class ProfileController extends Controller
{
    public function index($slug){
        $userData = DB::table('users')
            ->leftJoin('profiles', 'profiles.user_id','users.id')
            ->where('slug', $slug)
            ->get();
       return view('profile.index', compact('userData'))->with('data', Auth::user()->profile);
    }

    public function uploadPhoto(Request $request){

        $file = $request->file('pic');
        $filename = $file->getClientOriginalName();

        $path = 'public/img';

        $file->move($path, $filename);
        $user_id = Auth::user()->id;

        DB::table('users')->where('id', $user_id)->update(['pic' => $filename]);
        //return view('profile.index');
        return back();
    }

    public function editProfileForm() {
        return view('profile.editProfile')->with('data', Auth::user()->profile);
    }

    //function update profile user
    public function updateProfile(Request $request) {

        $user_id = Auth::user()->id;

        DB::table('profiles')->where('user_id', $user_id)->update($request->except('_token'));
        return back();
    }

    public function findFriends() {

        $uid = Auth::user()->id;
        $allUsers = DB::table('profiles')
            ->leftJoin('users', 'users.id', '=', 'profiles.user_id')
            ->where('users.id', '!=', $uid)->get();

        return view('profile.findFriends', compact('allUsers'));
    }

    public function sendRequest($id) {

        Auth::user()->addFriend($id);

        return back();
    }

    public function requests() {
        $uid = Auth::user()->id;

        $FriendRequests = DB::table('friendships')
            ->rightJoin('users', 'users.id', '=', 'friendships.requester')
            ->where('status', '=', null)
            ->where('friendships.user_requested', '=', $uid)->get();

        return view('profile.requests', compact('FriendRequests'));
    }

    public function accept($name, $id) {

        $uid = Auth::user()->id;
        $checkRequest = friendships::where('requester', $id)
            ->where('user_requested', $uid)
            ->first();
        if ($checkRequest) {

            $updateFriendship = DB::table('friendships')
                ->where('user_requested', $uid)
                ->where('requester', $id)
                ->update(['status' => 1]);

            $notifications = new notifications;
            $notifications->note = 'Accepted your friend request';
            $notifications->user_hero = $id; // who is accepting my request
            $notifications->user_logged = Auth::user()->id; // me
            $notifications->status = '1'; // unread notifications
            $notifications->save();

            if ($notifications) {

                return back()->with('msg', 'You are now Friend with ' . $name);
            }
        } else {
            return back()->with('msg', 'You are now Friend with this user');
        }
    }

    public function friends() {
        $uid = Auth::user()->id;

        $friends1 = DB::table('friendships')
            ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
            ->where('status', 1)
            ->where('requester', $uid) // who is loggedin
            ->get();

        $friends2 = DB::table('friendships') // send request
            ->leftJoin('users', 'users.id', 'friendships.requester')
            ->where('status', 1)
            ->where('user_requested', $uid)
            ->get();

        $friends = array_merge($friends1->toArray(), $friends2->toArray());

        return view('profile.friends', compact('friends'));
    }

    public function requestRemove($id) {

        DB::table('friendships')
            ->where('user_requested', Auth::user()->id)
            ->where('requester', $id)
            ->delete();

        return back()->with('msg', 'Request has been deleted');
    }

    public function notifications($id){
        $uid = Auth::user()->id;
        $notes = DB::table('notifications')
            ->leftJoin('users', 'users.id', 'notifications.user_logged')
            ->where('notifications.id', $id)
            ->where('user_hero', $uid)
            ->orderBy('notifications.created_at', 'desc')
            ->get();

        $updateNoti = DB::table('notifications')
            ->where('notifications.id', $id)
            ->update(['status' => 0]);

        return view('profile.notifications', compact('notes'));
    }


}
