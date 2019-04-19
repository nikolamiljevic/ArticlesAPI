@extends('index')

@section('content')
<h1> Profile page</h1>
<h1>Add Article</h1>

<form id="itemForm">
        <div class="form-group">
            <label>Title</label>
            <input type="text" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea id="content" class="form-control"></textarea>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
</form>

@endsection

@section('profile')
<h1>My Articles</h1>

<script>
    $(document).ready(function(){

        getArticles();

         //dobavljanje clanaka iz apija
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