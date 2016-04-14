<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function homepage(Request $request)
    {
        if($request->session()->get('client_username'))
        {
            return redirect('/client/home');
        }
        else {
            return view('public/welcome');
        }
    }
    public function aboutpage(Request $request)
    {
        return view('public/about');
    }
}