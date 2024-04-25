@extends('layouts.app')
@section('title', 'View Post')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><table class='table table-striped'>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Body</th>
            <th>Posted By</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $post['id'] }}</td>
            <td>{{ $post['title'] }}</td>
            <td>{{ $post['body'] }}</td>
            <td>{{ $post['posted_by'] }}</td>
        </tr>
    </tbody>
</table>


<div class="card mt-3">
    <div class="card-header">
        Comments
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach ($post->comments as $comment)
            <li class="list-group-item">{{$comment['pivot']['body']}}</li>
            @endforeach
        </ul>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">
        Write a Comment
    </div>
    <div class="card-body">
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                <label for="content">Comment:</label>
                <textarea class="form-control" id="content" name="body" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection