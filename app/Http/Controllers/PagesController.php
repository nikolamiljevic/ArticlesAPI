<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function allArticles(){
        return view('allArticles');
    }

    public function profile(){
        return view('profile');
    }
}
