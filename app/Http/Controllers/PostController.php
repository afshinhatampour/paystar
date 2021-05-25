<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::all();

        return response()->json(['data' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostCreateRequest $request
     * @return void
     */
    public function store(PostCreateRequest $request)
    {
        $request['user_id'] = auth()->user()->id;
        $post = Post::create($request->all());

        return response()->json(['data' => $post->id, 'message' => 'new post created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        return response()->json(['data' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $request['user_id'] = auth()->user()->id;
        $post->update($request->all());

        return response()->json(['data' => 'post updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'post deleted successfully']);
    }
}
