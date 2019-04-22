@extends('index')

@section('content')
<h1>All Articles</h1>
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
    });
     </script>
@endsection

