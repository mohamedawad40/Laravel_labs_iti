@extends('layouts.app')
@section('title', 'Home Page')
@section('content')
    
<a href="/posts/create">Create</a>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><table class='table table-striped'>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Body</th>
        <th>Posted By</th>
        <th>action</th>
        <th>Image</th>
    </tr>

    @foreach ($posts as $post)
        <tr>
            <td>{{ $post['id'] }}</td>
            <td>{{ $post['title'] }}</td>
            <td>{{ $post['body'] }}</td>
            <td>{{ $post->user->name }}</td>
            <td>
                <td><img src="{{ asset('storage/' . $post->image) }}" width="100" height="100"></td>            <td>
                
                {{-- <a href="{{ $post['id'] }}" class="btn btn-info">View</a> --}}
                <a href="{{ route("posts.show",$post['id']) }}" class="btn btn-info">View</a>

                {{-- <a href="/posts/{{ $post['id'] }}/edit" class="btn btn-primary">Edit</a> --}}
                <a href="/posts/{{ $post['id'] }}/edit" class="btn btn-primary">Edit</a>

                <form action="/posts/{{ $post['id'] }}" method="post">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach

</table>
<div class="d-flex justify-content-center">
    {{ $posts->links('vendor.pagination.pagination') }}
</div>

@endsection