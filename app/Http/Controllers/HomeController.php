<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Sponsor;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user, Sponsor $sponsor)
    {
        $user = Auth::user();
        $review = Auth::user()->reviews()->orderBy('id', 'desc')->first();
        $message = Auth::user()->messages()->orderBy('id', 'desc')->first();
        $sponsor = Auth::user()->sponsors()->orderBy('id', 'desc')->first();
        return view('doctor_view.dashboard', compact('user', 'review', 'message','sponsor'));
    }

    public function myReviews()
    {
        $user = Auth::user();
        $users = User::all();
        $reviews = Auth::user()->reviews()->orderBy('id', 'desc')->get();

        return view('doctor_view.reviews', compact('user', 'users', 'reviews'));
    }

    public function myMessages()
    {
        $user = Auth::user();
        $users = User::all();
        $messages = Auth::user()->messages()->orderBy('id', 'desc')->get();

        return view('doctor_view.messages', compact('user', 'users', 'messages'));
    }

}
