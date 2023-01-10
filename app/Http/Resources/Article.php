<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category_id,
            'slug' => $this->slug,
            'content' => $this->content,
            'image' => $this->image,
            'images' => $this->images,
            'videos' => $this->videos,
            'status' => $this->status,
            'date' => $this->date,
            'documents' => $this->documents,
            'featured' => $this->featured,
            'link' => $this->link,
        ];
    }
}
