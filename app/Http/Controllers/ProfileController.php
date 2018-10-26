<?php

namespace App\Http\Controllers;

use App\friendships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class ProfileController extends Controller
{
    public function index($slug){


        return view('profile.index')->with('data', Auth::user()->profile);
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
            ->where('status', '=', Null)
            ->where('friendships.user_requested', '=', $uid)->get();


        return view('profile.requests', compact('FriendRequests'));
    }

    public function accept($name, $id) {

        $uid = Auth::user()->id;
        $checkRequest = friendships::where('requester',$id)
            ->where('user_requested', $uid)
            ->first();

        if($checkRequest){
         $updateFriendships =   DB::table('friendships')
                ->where('user_requested', $uid)
                ->where('requester', $id)
                ->update(['status' => 1]);
            if ($updateFriendships){

                return back()->with('profile.requests')->with('msg','You are now Friend with '.$name);

            }
        }else{
            return back()->with('profile.requests')->with('msg','You are now Friend with this user');
        }


    }
}
