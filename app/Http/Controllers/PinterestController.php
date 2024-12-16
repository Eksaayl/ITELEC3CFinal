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
        $pictures = Picture::with('user')->latest()->get(); // Eager load user relationships
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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $picture = Picture::findOrFail($id);
    $picture->title = $request->title;
    $picture->description = $request->description;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('pictures', 'public');
        $picture->image_url = '/storage/' . $path;
    }

    $picture->save();

    return redirect()->back()->with('success', 'Picture updated successfully!');
}

}
