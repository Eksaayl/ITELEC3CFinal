<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinterestController extends Controller
{
    public function index()
    {
        $pictures = Picture::with(['user', 'comments' => function ($query) {
            $query->with('user')->latest(); // Load comments with user and order them
        }])->latest()->get();
    
        return view('test', compact('pictures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:10240',
        ]);

        $path = $request->file('image')->store('pictures', 'public');

        Picture::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_url' => '/storage/' . $path,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('test')->with('success', 'Photo uploaded successfully!');
    }

    public function destroy($id)
    {
        $picture = Picture::findOrFail($id);

        // Check if the user is authorized to delete
        if ($picture->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized action'], 403);
        }

        $picture->delete();

        return response()->json(['success' => true, 'message' => 'Picture deleted successfully!']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Optional image
        ]);

        $picture = Picture::findOrFail($id);

        // Authorization check: ensure the user owns the picture
        if ($picture->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized action'], 403);
        }

        // Update title and description
        $picture->title = $request->title;
        $picture->description = $request->description;

        // Handle new image upload (delete old image if exists)
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($picture->image_url && file_exists(public_path($picture->image_url))) {
                unlink(public_path($picture->image_url));
            }

            // Store new image
            $path = $request->file('image')->store('pictures', 'public');
            $picture->image_url = '/storage/' . $path;
        }

        $picture->save();

        return response()->json(['success' => true, 'message' => 'Picture updated successfully!']);
    }

    public function addComment(Request $request, $id)
{
    $request->validate([
        'body' => 'required|string|max:255',
    ]);

    Comment::create([
        'picture_id' => $id,
        'user_id' => Auth::id(),
        'body' => $request->body,
    ]);

    return back()->with('success', 'Comment added successfully!');
}

public function deleteComment($id)
{
    $comment = Comment::findOrFail($id);

    // Authorization: Allow only comment owner or admin
    if ($comment->user_id === Auth::id() || Auth::user()->role === 'admin') {

        $comment->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }

    return back()->with('error', 'Unauthorized action.');
}

}
