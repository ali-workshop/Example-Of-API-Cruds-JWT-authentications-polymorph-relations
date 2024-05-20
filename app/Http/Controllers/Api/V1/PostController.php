<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\services\Traits\apiresponse;
use Exception;

class PostController extends Controller
{
    use apiresponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::paginate(20);
        return $this->successResponse(PostResource::collection($posts),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            $validated=$request->safe()->only(['title','body']);
            $post=new Post();
            $post->title=$validated['title'];
            $post->title=$validated['body'];
            $post->save();
            return $this->successResponse(new PostResource($post),200);
        }
        catch(Exception $e)
        {
            return $this->errorResponse('MAN what the problem ther is error.... fix it quicly pls:');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $this->successResponse(new PostResource($post),200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        
        try
        {
            $validated=$request->safe()->only(['title','body']);
            $post->title=$validated['title'];
            $post->title=$validated['body'];
            $post->save();
            return $this->successResponse(new PostResource($post),200);
        }
        catch(Exception $e)
        {
            return $this->errorResponse('MAN what the problem ther is error.... fix it quicly pls:');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        
        $post->delete();
        $data='the post deleted succussefully';
        return $this->successResponse($data,200);
    }
}
