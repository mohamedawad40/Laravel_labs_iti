<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function index(){
        $posts = Post::paginate(6);
        // $posts=Post::all();
        // dd($posts);
        return view ("posts.index",["posts"=>$posts]);
    }
    function create(){
        return view("posts.create");
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
                "user_id"=>Auth::id()
            ]
        );

        
        if ($request->hasFile('image')) {
            // Store the uploaded image and assign its path to the post's 'image' attribute
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
            $post->save(); // Save the post with the image path
        }
        return redirect("/posts");
    }

    function show($id){
        // $post = [
        //             "id" => $id,
        //             "title" => "This is number : $id",
        //             "body" => "This is the body",
        //             "posted_by" => "Ali"
        //         ];
        //Post::where('id',$id)->get();

        $post=Post::find($id);
        return view("posts.show",["post"=>$post]);
    }

   
    function edit($id){
        $post=Post::find($id);
        return view("posts.edit",["post"=>$post]);
    }
    public function update(Request $request, $id)
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
    return redirect("/posts");
}
    // function destroy($id){
    //     Post::destroy($id);
    //     return redirect("/posts");
    // }
    // function destroy($id){
    //     $post = Post::findOrFail($id);
    // if ($post->image) {
    //     Storage::disk('public')->delete($post->image);
    // }
    //     Post::destroy($id);
    //     return redirect("/posts");
    // }
    public function destroy($id){
    $post = Post::findOrFail($id);
    if ($post->image) {
        // Use Storage directly without importing
        \Storage::disk('public')->delete($post->image);
    }

    Post::destroy($id);

    return redirect("/posts");
}


}


Auth::routes();
