<?php

namespace App\Http\Services;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;

class PostService
{
    public function store(CreatePostRequest $request)
    {
        return Post::create($request->validated());
    }
}
