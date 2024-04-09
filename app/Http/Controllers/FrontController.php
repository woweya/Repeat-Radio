<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FrontController extends Controller
{
    public function index()
    {

            $response = Http::get('http://api.sailorradio.com/api/v1/songs/previous');
            $data = $response->json();
            return view('welcome', compact('data'));

    }

    public function User(User $user)
    {
        if(Auth::check()){
            $user = Auth::user();
            $id = Auth::user()->id;
            return view('user-info', compact('user', 'id'));
        }


    }
}
