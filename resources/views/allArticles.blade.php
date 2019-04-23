@extends('index')

@section('content')
<h1>All Articles</h1>

<div id="findUserArticles">
    <p>Filter articles by author</p>
        @foreach($users as $user)
        <button  class="btn btn-primary" type="submit" value="{{$user->id}}">{{$user->name}}</button>
    @endforeach
    <button id="clearFilter" class="btn btn-danger">Clear filter</button>
</div>
<br>
@endsection

@section('allArticles')
<script>
    $(document).ready(function(){

        getArticles();

    //dobavljanje clanaka iz apija bez mogucnosti editovanja i brisanja
         function getArticles(){
            $.ajax({
                url:'http://zadatak.test/api/articles'   
            }).done(function(articles){
               // console.log('articles', articles);
                let output = '';
                //izlistavanje clanaka
                $.each(articles, function(key, article){
                    //console.log(article.user)
                    
                    output+= `
                        <li id="test${article.id}" class="list-group-item">
                            <a href="/api/articles/${article.id}">    
                                <strong>${article.title}</strong> 
                                <p>${article.content}</p>
                            </a>
                            <img style="height:200px" src="{{asset('storage/article_images/${article.photo}')}}">
                            <p>Author: ${article.username}</p>
                           
                        </li>
                        
                    `;
                });
               
                //dodavanje u listu
                $('#articles').html(output);
                
            });
        }


    
//event za filtriranje
    $('#findUserArticles button').on('click',function(e){
            e.preventDefault();
            let userId = $(this).val();
            let userName = $(this).html();
            console.log(userName);
            getArticlesByUser(userId,userName);
            //alert($(this).val());
            
            });
            
        
//filtriranje clanaka po korisniku
        function getArticlesByUser(userId,userName){
            $.ajax({
                url:'http://zadatak.test/user-articles/'+userId
            }).done(function(articles){
                
                let output = '';
                //izlistavanje clanaka
                $.each(articles, function(key, article){
                    console.log(article);
                    output+= `
                              <li id="test${article.id}" class="list-group-item">
                            <a href="/api/articles/${article.id}">    
                                <strong>${article.title}</strong> 
                                <p>${article.content}</p>
                                
                            </a>
                            <img style="height:200px" src="{{asset('storage/article_images/${article.photo}')}}">
                            <p>Author: ${userName}</p>
                        </li>
                    `; 
                });
                //dodavanje u listu
                $('#articles').html(output);
                
            });
        }


//event za resetovanje filtera
        $('#clearFilter').on('click',function(e){
            e.preventDefault();
            getArticles();
        });

});
     </script>
@endsection

