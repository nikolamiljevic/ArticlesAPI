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
                console.log('articles', articles);
                let output = '';
                //izlistavanje clanaka
                $.each(articles, function(key, article){
                    
                    output+= `
                        <li id="test${article.id}" class="list-group-item">
                            <a href="/api/articles/${article.id}">    
                                <strong>${article.title}</strong> 
                                <p>${article.content}</p>
                            </a>
                            <p>Author:</p>
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

