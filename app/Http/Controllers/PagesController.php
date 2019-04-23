<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\User;

class PagesController extends Controller
{
    public function allArticles(){
        $users = User::all();
        return view('allArticles',compact('users'));
    }

    public function profile(){
        $userId = Auth::user()->id;
        return view('profile',compact('userId'));
    }

    public function edit($id){
        $article = Article::find($id);
        return view('edit',compact('article'));
    }
}
