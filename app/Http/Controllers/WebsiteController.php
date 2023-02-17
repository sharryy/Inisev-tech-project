<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebsiteRequest;
use App\Http\Requests\SubscribeWebsiteRequst;
use App\Http\Resources\WebsiteResource;
use App\Http\Services\WebsiteService;
use Illuminate\Http\Request;

class WebsiteController
{
    public function store(StoreWebsiteRequest $request, WebsiteService $websiteService)
    {
        $website = $websiteService->create($request);
        $website->load('users');

        return response()->apiSuccess(WebsiteResource::make($website));

    }

    public function subscribe(SubscribeWebsiteRequst $request, WebsiteService $websiteService)
    {
        $website = $websiteService->subscribe($request);

        $website->load('users');

        return response()->apiSuccess(WebsiteResource::make($website));
    }
}
