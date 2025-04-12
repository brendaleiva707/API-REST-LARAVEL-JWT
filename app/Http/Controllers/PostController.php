<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller{
    
    public function addPost(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5|max:255',
            'body' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = $request->user();

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $user->id;
        $post->save();

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }

    public function getPosts(){
        $user = auth('api')->user();

        $posts = Post::with('user')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();

        if ($posts->isEmpty()) {
            return response()->json(['message' => 'No posts found'], 404);
        }

        return response()->json($posts, 200);
    }

    public function getPostById($id){
        $post = Post::with('user')->find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post, 200);
    }

    public function updatePostById(Request $request, $id){
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $user = $request->user();

        /*Solo el autor puede editar su post*/
        if ($post->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|min:5|max:255',
            'body'  => 'sometimes|string|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        if ($request->has('title')) {
            $post->title = $request->title;
        }

        if ($request->has('body')) {
            $post->body = $request->body;
        }

        $post->save();

        return response()->json(['message' => 'Post updated successfully', 'post' => $post], 200);
    }

    
    public function deletePostById(Request $request, $id){
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $user = $request->user();

        if ($post->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }

}
