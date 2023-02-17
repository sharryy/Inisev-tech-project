<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebsiteRequest;
use App\Http\Services\WebsiteService;
use Illuminate\Http\Request;

class WebsiteController
{
    public function store(StoreWebsiteRequest $request, WebsiteService $websiteService)
    {
        $website = $websiteService->create($request);

        if (!$website) {
            return response()->apiError('Failed to create website', 500);
        }

        return response()->apiSuccess($website);

    }
}
