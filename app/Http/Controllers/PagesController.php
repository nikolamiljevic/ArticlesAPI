<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function allArticles(){
        return view('allArticles');
    }

    public function profile(){
        $userId = Auth::user()->id;
        return view('profile',compact('userId'));
    }
}
