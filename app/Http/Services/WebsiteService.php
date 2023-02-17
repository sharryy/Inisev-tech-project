<?php

namespace App\Http\Services;

use App\Http\Requests\StoreWebsiteRequest;
use App\Http\Requests\SubscribeWebsiteRequst;
use App\Models\Website;

class WebsiteService
{
    public function create(StoreWebsiteRequest $request)
    {
        return Website::create($request->validated());
    }

    public function subscribe(SubscribeWebsiteRequst $request)
    {
        $website = Website::find($request->offsetGet('websites_website_id'));

        if (!$website) {
            return false;
        }

        $website->subscribers()->create($request->validated());

        return $website;
    }
}
