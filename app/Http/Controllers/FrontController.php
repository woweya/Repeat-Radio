<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontController extends Controller
{
    public function index()
    {

            $response = Http::get('http://api.sailorradio.com/api/v1/songs/previous');
            $data = $response->json();
            return view('welcome', compact('data'));

    }
}
