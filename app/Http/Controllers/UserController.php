<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function CreateUser(UserPostRequest $req, $id){
        $validated = $req->validated();
        $user = new User();
        $user->first_name = $req->input('firstname');
        $user->middle_name = $req->input('middlename');
        $user->last_name = $req->input('lastname');
        $user->birthday = $req->input('birthday');
        $user->snils = $req->input('snils');
        $user->inn = $req->input('inn');
        $user->org_id=$id;
        $user->save();
        return redirect()->route('org-data-by-id',  $id);
    }

    public function getUserById($id) {
        $user = new User();
        return(view('user-profile', ['data'=>$user->join('organizations', 'users.org_id', '=', 'organizations.id')->where('users.id', '=', $id)->first()]));
    }
}
