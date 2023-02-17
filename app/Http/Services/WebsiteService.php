<?php

namespace App\Http\Services;

use App\Http\Requests\StoreWebsiteRequest;
use App\Models\Website;

class WebsiteService
{
    public function create(StoreWebsiteRequest $request)
    {
        return Website::create($request->validated());
    }
}
