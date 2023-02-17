<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Post */
class PostResource extends JsonResource
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
            'post_id' => $this->post_id,
            'title'   => $this->title,
            'slug'    => $this->slug,
            'content' => $this->content,
            'website' => WebsiteResource::make($this->whenLoaded('website')),
        ];
    }
}
