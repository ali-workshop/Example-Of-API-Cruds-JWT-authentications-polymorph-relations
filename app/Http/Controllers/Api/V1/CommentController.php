<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\services\Traits\apiresponse;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    use apiresponse;
    /**
     * Display a listing of the resource.
     */
    public function index($postId)
    {
        $post = Post::find($postId);
        $comments = $post->comments;
        return $this->successResponse(CommentResource::collection($comments),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request,$postId)
    {
        try
        {
            $validated=$request->safe()->only(['body','user_id']);
            $post = Post::findOrFail($postId);
            $comment=new Comment();
            $comment->body=$validated['body'];
            $comment->user_id=$validated['user_id'];
            $post->comments()->save($comment);
            return $this->successResponse(new CommentResource($comment),200);
        }
        catch(Exception $e)
        {
            return $this->errorResponse('MAN what the problem ther is error.... fix it quicly pls:',[$e]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($postId, $commentId)
    {
        $post = Post::findOrFail($postId);
        $comment = $post->comments()->findOrFail($commentId);
        return $this->successResponse(new CommentResource($comment),200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, $postId, $commentId)
    {

        $post = Post::findOrFail($postId);
        $comment = $post->comments()->findOrFail($commentId);
        try
        {   #no need to validate the user_id i think???
            $validated=$request->safe()->only(['body']);
            $comment->title=$validated['body'];
            $post->comments()->save($comment);
            return $this->successResponse(new CommentResource($comment),200);
        }
        catch(Exception $e)
        {
            return $this->errorResponse('MAN what the problem ther is error.... fix it quicly pls:');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($postId, $commentId)
    {
         
        $post = Post::findOrFail($postId);
        $comment = $post->comments()->findOrFail($commentId);

        $comment->delete();
        $data='the Commment deleted succussefully';
        return $this->successResponse($data,200);
    }
}
