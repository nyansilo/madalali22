<?php

namespace App\Http\Resources;

use App\Http\Resources\Lookups\BlogCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class Blog extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description'=> $this->body,
            'image'=> $this->image_url,
            //'image'=> asset('img/' . $this->image),
            'category' => new BlogCategory($this->category),
            'createdBy' => new Admin($this->author),
            //'comment' => new Comment($this->comments),
            'commentNumber' => $this->comments->count(),
            'likes' => $this->likes,
            //'comments' => Comment::collection($this->comments),
            'createdAt' => $this->created_at->diffForHumans(),
            'updatedAt' => $this->updated_at->toDateTimeString(),
            'publishedAt' => $this->published_at->toDateTimeString(),

        ];
    }
}
