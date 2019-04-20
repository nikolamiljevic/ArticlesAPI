@extends('index')

@section('content')
<h1> Profile page</h1>
<h1>Add Article</h1>

<form id="articleForm" enctype="multipart/form-data">
        <div class="form-group">
            <label>Title</label>
            <input type="text" id="title" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea id="content" name="content" class="form-control"></textarea>
        </div>
        <div class="form-group">
        <label>Photo</label><br>
        <input type="file" id="photo" name="photo">
        <input type="hidden" value="">
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
                            <img src="{{asset('storage/article_images/${article.photo}')}}">
                            <p>Author: ${article.username}</p>
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
          //  let photo = $('input#photo')[0].files[0]//.name;  
         //let photo = $('#photo').prop('files')[0];    
         var formData = new FormData(this);
     
//console.log(photo);
           addArticle(title, content, formData);
        });

             //dodavanje clanka kroz API
             function  addArticle(title, content, formData){
            $.ajax({
                method: 'POST',
                url: 'http://zadatak.test/api/articles',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: formData
            }).done(function(response){
                let output = `
                        <li class="list-group-item" id="test${response.article.id}">
                            <a href="">
                                <strong>${response.article.title}</strong> 
                                <p>${response.article.content}</p>
                                <button class="deleteLink btn btn-danger" data-id="${response.article.id}">Delete</button>
                                <button class="editLink  btn btn-primary" data-id="${response.article.id}">Edit</button>
                            </a>
                            <img src="{{asset('storage/article_images/${response.article.photo}')}}">
                            <p>Author: ${response.username} </p>
                        </li>
                    `;
                    $('#articles').append(output);   
                    alert('article added');   
                   // console.log(photo);
                
            });
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