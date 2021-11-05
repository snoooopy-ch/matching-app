<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $data['menu'] = 'profile';
        return view('admin.profile', $data);
    }

    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        User::where('id', $user_id)->update($request->all());
        return response()->json([
            'status' => true
        ]);
    }

    public function changePassword(Request $request)
    {
        if(Hash::check($request->current_pwd, Auth::user()->password)) {
            $new_pwd = $request->new_pwd;
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($new_pwd)
            ]);
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error_msg' => __('cur_pwd_incorrect')
            ]);
        }
    }
}
