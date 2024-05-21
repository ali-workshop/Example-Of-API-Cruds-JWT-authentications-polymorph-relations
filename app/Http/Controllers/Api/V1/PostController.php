<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\services\Traits\apiresponse;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    use apiresponse;
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('auth:api');
     }
    public function index()
    {
        $posts=Post::paginate(20);
        return $this->successResponse(PostResource::collection($posts),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try
        {
            $validated=$request->safe()->only(['title','body','category_id','user_id']);
            $post=new Post();
            $post->title=$validated['title'];
            $post->category_id=$validated['category_id'];
            $post->user_id=$validated['user_id'];
            $post->body=$validated['body'];
            $post->save();
            return $this->successResponse(new PostResource($post),200);
        }
        catch(Exception $e)
        {
            return $this->errorResponse('MAN what the problem ther is error.... fix it quicly pls:',[$e]);
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
    public function update(UpdatePostRequest $request, Post $post)
    {
        
        try
        {
            $validated=$request->safe()->only(['title','body','category_id','user_id']);
            $post->title=$validated['title'];
            $post->category_id=$validated['category_id'];
            $post->user_id=$validated['user_id'];
            $post->body=$validated['body'];
            $post->save();
            return $this->successResponse(new PostResource($post),200);
        }
        catch(Exception $e)
        {
            return $this->errorResponse('MAN what the problem ther is error.... fix it quicly pls:',[$e]);
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
