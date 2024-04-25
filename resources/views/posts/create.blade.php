@extends('layouts.app')
@section('title', 'Create Post')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="container">
    <h1>Create a New Post</h1>
    
    <form method="POST" action="/posts" enctype="multipart/form-data">
        @csrf 

        {{-- <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="number" class="form-control" id="id" name="id" aria-describedby="idHelp" >
            <div id="idHelp" class="form-text">Enter your ID.</div>
        </div> --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" value="{{ old('title') }}" name="title" placeholder="Title" >
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" name="body" value="{{ old('body') }}" placeholder="Body" rows="3" ></textarea>
        </div>
        <div class="mb-3">
               
            <label for="" class="form-label">Image</label>
            <input type="file" class="form-control" name="image">

            @error('image')
                <p class="text-danger m-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- <div class="mb-3">
            <label for="user_id" class="form-label">Posted by</label>
            <input type="text" class="form-control" id="title" name="user_id" placeholder="user id" >
        </div> --}}

        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li> {{ $error }}</li>
        @endforeach    
    </ul>    
</div>
@endif  
</div>

  

@endsection 