@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="container">
    <h1>Edit</h1>
    
    <form method="POST" action="/posts/{{ $post['id'] }}" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        
    <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" value="{{$post['title']}}" id="title" name="title" >
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <input type="text" class="form-control" value="{{$post['body']}}" id="title" name="body" >
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Posted_by</label>
            <input type="text" class="form-control" value="{{$post->user->name}}" id="posted_by" name="user_id" >
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Post - image</label>
            <input type="file" class="form-control" name="image">

            @error('image')
                <p class="text-danger m-2">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li> {{ $error }}</li>
        @endforeach    
    </ul>    
</div>
@endif  
@endsection