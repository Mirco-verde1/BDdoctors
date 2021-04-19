<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;
use App\User;
use App\UserDetail;
use App\Vote;


class GuestController extends Controller
{
    public function index()

    {
        $users= User::all();
        $userDetail= UserDetail::all();
        $userDepartment= Department::all();

         return view('homepage', compact('users', 'userDetail', 'userDepartment'));
    }



    public function advance()

    {
         return view('advanced');
    }



    public function show(User $user, $id){


        $user = User::where('id', $id)->first();
        $departments = Department::all();
        $detail = UserDetail::all();
        return view('showDoc', compact('user', 'departments','detail'));

    }

}
