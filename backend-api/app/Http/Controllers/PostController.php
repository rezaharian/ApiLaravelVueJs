<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data' => $posts

        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
        'title' => 'required',
        'content' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        if($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Created',
                'data' => $post
            ], 201);
        }

        return response()-> json([
            'success' => false,
            'message' => 'post Failed to save',
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        //
        $post = Post::findOrfail($id);

        return response()->json([
            'success' => True,
            'message' => 'Detail Data Post',
            'data' => $post
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

    
        $post = Post::findOrFail($post->id);

        if($post) {

        
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post Updated',
                'data'    => $post  
            ], 200);

        }

      
        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
          $post = Post::findOrfail($id);

        if($post) {

            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post Deleted',
            ], 200);

        }

        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);
    }
}
