@extends('index')

@section('content')
<h1> Profile page</h1>
<h1>Add Article</h1>

<form id="articleForm" enctype="multipart/form-data">
        <div class="form-group">
            <label>Title</label>
            <input type="text" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea id="content" class="form-control"></textarea>
        </div>
        <div class="form-group">
        <label>Photo</label><br>
        <input type="file" id="photo" name="photo">
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
</form>
<h1>My Articles</h1>
@endsection

@section('profile')


<script>
    $(document).ready(function(){

        getArticles();

//SVI CLANCI KORISNIKA

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
                            <button class="deleteLink btn btn-danger" data-id="${article.id}">Delete</button>
                            <button class="editLink  btn btn-primary" data-id="${article.id}">Edit</button>
                        </li>
                    `;
                });
                //dodavanje u listu
                $('#articles').html(output);
            });
        }


 //DODAVANJE NOVOG CLANKA

        //event za dodavanje clanka
        $('#articleForm').on('submit',function(e){
            e.preventDefault();
            let title = $('#title').val();
            let content = $('#content').val();
            

            addArticle(title,content);
        });

             //dodavanje clanka kroz API
             function  addArticle(title,content){
            $.ajax({
                method: 'POST',
                url: 'http://zadatak.test/api/articles',
                data:{title:title,content:content}
            }).done(function(article){
                let output = `
                        <li class="list-group-item" id="test${article.id}">
                            <a href="">
                                <strong>${article.title}</strong> 
                                <p>${article.content}</p>
                                <button class="deleteLink btn btn-danger" data-id="${article.id}">Delete</button>
                                <button class="editLink  btn btn-primary" data-id="${article.id}">Edit</button>
                            </a>
                        </li>
                    `;
                    $('#articles').append(output);   
                    alert('article added');   
                    console.log(article);
                
            })
        }

//BRISANJE CLANKA

         //delete event
         $('body').on('click','.deleteLink',function(e){
                e.preventDefault();
            
                let id = $(this).data('id');
                deleteArticle(id);

            });

        //brisanje clanka kroz API
        function deleteArticle(id){
                $.ajax({
                    method: 'POST',
                    url: 'http://zadatak.test/api/articles/'+id,
                    data:{_method:'DELETE'}
                }).done(function(article){
                    alert('Article deleted');
                    $('#test'+id).remove();
                })
            }

});

</script>
@endsection