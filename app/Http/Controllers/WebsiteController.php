<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebsiteRequest;
use App\Http\Requests\SubscribeWebsiteRequst;
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

    public function subscribe(SubscribeWebsiteRequst $request, WebsiteService $websiteService)
    {
        $website = $websiteService->subscribe($request);

        $website->load('users');

        return response()->apiSuccess($website);
    }
}
