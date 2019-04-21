@extends('index')

@section('content')

<h1> Single article page</h1>
<div class="container">
<h1>{{$article->title}}</h1>
<img style="height:200px" src="{{asset('storage/article_images/'.$article->photo)}}">

<p>{{$article->content}}</p>
<p>Author: {{$article->user->name}}</p>
    @if(!$article->photo2)
    @else
     <img src="{{asset('storage/article_images/'.$article->photo2)}}">
    @endif
</div>
@endsection



