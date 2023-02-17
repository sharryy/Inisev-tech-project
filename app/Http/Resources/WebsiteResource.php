<?php

namespace App\Http\Resources;

use App\Models\Website;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Website */
class WebsiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'website_id' => $this->website_id,
            'name'       => $this->name,
            'url'        => $this->url,
            'subscribers'      => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
