<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest; 
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    function index(){
        $posts = Post::paginate(6);
        // $posts=Post::all();
        // dd($posts);
        // return $posts;
        return PostResource::collection($posts);

    }

    function store(StorePostRequest $request){
        ///get data and insert into db
        // $data=$request->all();
        //validation
         
        //insert
        //solution 1 
        // $post=new Post;
        // $post->title=$request->title;
        // $post->body=$request->body;
        // $post->save();
        //solution 2 ///need to put fields  in fillable array in model
      
      
        $post = Post::create(
            [
                "title"=>$request->title,
                "body"=>$request->body,
                "user_id"=>$request->user_id,
            ]
        );

        
        if ($request->hasFile('image')) {
            // Store the uploaded image and assign its path to the post's 'image' attribute
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
            $post->save(); // Save the post with the image path
        } 
        return "post stored";
    }

    function show($id){
        // $post = [
        //             "id" => $id,
        //             "title" => "This is number : $id",
        //             "body" => "This is the body",
        //             "posted_by" => "Ali"
        //         ];
        //Post::where('id',$id)->get();

        // $post=Post::find($id);
        // return $post;
        $posts=Post::with('user')->findOrfail($id);
        return new PostResource($post);
    }

    public function update(StorePostRequest $request, $id)
{
    $post = Post::find($id);
    $post->title = $request->title;
    $post->body = $request->body;

    // Check if a new image file has been uploaded
    if ($request->hasFile('image')) {
        if ($post->image !== null) {
            Storage::delete($post->image);
        }
        
        $imagePath = $request->file('image')->store('images', 'public');
        $post->image = $imagePath;
    }

    $post->save();
    return "post updated";
}


    public function destroy($id){
    $post = Post::findOrFail($id);
    if ($post->image) {
        // Use Storage directly without importing
        \Storage::disk('public')->delete($post->image);
    }

    Post::destroy($id);

    return "post deleted";
}


}


