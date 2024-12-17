<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function index()
    {
        $posts = Post::latest()->paginate(8);
        return view('manage-post', compact('posts'));
    }

    public function index2()
    {
        $posts = Post::latest()->paginate(8);
        return view('inspiration', compact('posts'));
    }

    // create
    public function create()
    {
        return view('users-create');
    }

    // Store
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'art_type' => 'required|string|max:255',
            'title' => 'required|string|unique:posts|max:255',
            'description' => 'required|string',
        ]);

        // $post = new Post();
        // $post->name = $request->input('name');
        // $post->age = $request->input('age');
        // $post->title = $request->input('title');
        // $post->description = $request->input('description');
        // $post->save();

        Post::insert([
            'name'=> $request->name,
            'art_type' => $request->art_type,
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            ]);
    

        return redirect()->route('manage-post')->with('success', 'Post created successfully!');
    }

    // edit post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('users-edit', compact('post'));
    }

    // Update post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->name = $request->input('name');
        $post->art_type = $request->input('art_type');
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return redirect()->route('manage-post')->with('success', 'Post updated successfully!');
    }

    // show a specific post
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('users-show', compact('post'));
    }

    // Delete 
    public function destroy($id)
    {
    
        $post = Post::findOrFail($id);
        $post->delete();
    
        // Redirect 
        return redirect()->route('manage-post')->with('success', 'Post deleted successfully!');
    }

}
