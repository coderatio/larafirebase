<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\LaraFirebase;
use Coderatio\PhpFirebase\PhpFirebase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{
    protected $pfb;

    public function __construct()
    {
        $this->pfb = new LaraFirebase('../secret/php-crud-f7984-3f535927d6d2.json');
        $this->pfb->setTable('posts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkInternetConnection();

        return response()->json([
            'connected' => true,
            'posts' => $this->pfb->getRecords()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkInternetConnection();

        $insertRecord = $this->pfb->insertRecord([
            'title' => $request->title,
            'body' => $request->body,
            'date' => now()->toDateTimeString()
        ], true);

        return response()->json([
            'connected' => true,
            'post' => $insertRecord
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        $this->checkInternetConnection();

        return response()->json([
            'connected' => true,
            'post' => $this->pfb->getRecord($request->postId)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->checkInternetConnection();
        return response()->json([
            'connected' => true,
            'post' => $this->pfb->getRecord($request->postId)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->checkInternetConnection();

        $post = $this->pfb->updateRecord($request->id, [
            'title' => $request->title,
            'body' => $request->body,
            'date' => now()->toDateTimeString()
        ]);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $this->checkInternetConnection();
        $this->pfb->deleteRecord($request->postId);

         return response()->json([
             'connected' => true,
             'posts' => $this->pfb->getRecords()
         ]);
    }

    public function checkInternetConnection()
    {
        $connected = @fsockopen("www.google.com", 80);
        if ($connected) {
            fclose($connected);
            return true; //action when connected
        }

        exit(json_encode([
            'connected' => false,
            'data' => []
        ]));
    }
}
