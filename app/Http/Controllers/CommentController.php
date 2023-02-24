<?php

namespace App\Http\Controllers;

use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepositoryInterface)
    {
        $this->commentRepository = $commentRepositoryInterface;

        $this->middleware('auth:api');
    }
    public function show($id){
        
        $response = $this->commentRepository->getCommentById($id);

        return response()->json([
            "status" => true,
            "data" => $response
        ]);
    }

    public function store(Request $request){
        $guest = 1;
        $this->validate($request,[
            'news' => 'required|integer|exists:news,id',
            'title' => 'required|string|max:255',
            'content'=>'required|string',
        ]);

        $response = $this->commentRepository->storeComment($request, $guest);

        return response()->json([
            'status' => true,
            'data' => $response
        ], 200);
    }
}
