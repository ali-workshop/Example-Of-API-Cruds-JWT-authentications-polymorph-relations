<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments=Comment::paginate(20);
        return $this->successResponse(CommentResource::collection($comments),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        try
        {
            $validated=$request->safe()->only(['body','user_id']);
            $comment=new Comment();
            $comment->body=$validated['body'];
            $comment->user_id=$validated['user_id'];
            $comment->save();
            return $this->successResponse(new CommentResource($comment),200);
        }
        catch(Exception $e)
        {
            return $this->errorResponse('MAN what the problem ther is error.... fix it quicly pls:');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return $this->successResponse(new CommentResource($comment),200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        try
        {   #no need to validate the user_id i think???
            $validated=$request->safe()->only(['body']);
            $comment->title=$validated['body'];
            $comment->save();
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
    public function destroy(Comment $comment)
    {
         
        $comment->delete();
        $data='the Commment deleted succussefully';
        return $this->successResponse($data,200);
    }
}
