<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Services\PostService;
use Illuminate\Http\Request;

class PostController
{
    public function store(CreatePostRequest $request, PostService $postService)
    {
        $post = $postService->store($request);

        if (!$post) {
            return response()->apiError('Failed to create post', 500);
        }

        return response()->apiSuccess($post);
    }
}
