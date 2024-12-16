<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:10240',
        ]);

        // Store the uploaded image
        $path = $request->file('image')->store('pictures', 'public');

        // Save to database
        Picture::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_url' => '/storage/' . $path,
        ]);

        return redirect()->back()->with('success', 'Picture uploaded successfully!');
    }
}
