<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Services\PostService;
use Illuminate\Http\Request;

class PostController
{
    public function store(CreatePostRequest $request, PostService $postService)
    {
        $post = $postService->store($request);
        $post->load('website.users');

        return response()->apiSuccess(PostResource::make($post));
    }
}
