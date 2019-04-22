@extends('index')

@section('content')
<h1>Edit Article</h1>


<form id="articleForm" enctype="multipart/form-data">
        <div class="form-group">
            <label>Title</label>
        <input type="text" id="title"  name="title" value="{{$article->title}}"class="form-control">
        </div>
        <div class="form-group">
            <label>Content</label>
        <textarea id="content" name="content"  class="form-control">{{$article->content}}</textarea>
        </div>
  
        <input type="submit" value="Update" class="btn btn-primary">


        <input type="hidden" id="articleId" value="{{$article->id}}">
</form>

@endsection

@section('edit')
<script>
$(document).ready(function(){

 //edit event
 $('body').on('submit',function(e){
                e.preventDefault();
            
               
                let id = $('#articleId').val();
                let title = $('#title').val();
                let content = $('#content').val();
                updateArticle(id,title,content);
            });

//update funkcija
            function updateArticle(id,title,content){
                $.ajax({
                    method: 'POST',
                    url: 'http://zadatak.test/api/articles/'+id,
                    data:{_method:'PUT',id:id,title:title,content:content}
                }).done(function(response){
                    alert('Article updated');
                    console.log(response);
                   
                    let output = `
                        <li class="list-group-item" id="test${response.id}">
                            <a href="">
                                <strong>${response.title}</strong> 
                                <p>${response.content}</p>
                                <button class="deleteLink btn btn-danger" data-id="${response.id}">Delete</button>
                                <button class="editLink  btn btn-primary" data-id="${response.id}">Edit</button>
                            </a>
                            <img src="{{asset('storage/article_images/${response.photo}')}}">
                            
                        </li>
                    `;
                    $('#articles').append(output);   
                //alert('article added');   
                });
            }
});

</script>
@endsection