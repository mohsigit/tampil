<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display a listing of the posts
    public function index()
    {
        return Post::all(); // Return all posts as JSON
    }

    // Store a newly created post in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Save data to the database
        $post = Post::create($request->all());

        // Return response or the created post data
        return response()->json($post, 201);
    }

    // Display the specified post
    public function show(Post $post)
    {
        return response()->json($post); // Return the specific post as JSON
    }

    // Update the specified post in storage
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Added validation for type
            'content' => 'required|string',
        ]);
        $post->update($request->all()); // Update the post
        return response()->json($post); // Return the updated post
    }

    // Remove the specified post from storage
    public function destroy(Post $post)
    {
        $post->delete();
        return response(null, 204);
    }
}
