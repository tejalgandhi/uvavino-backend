<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Page extends JsonResource
{
    private $json_extras = [
        'contacts',
    ];

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $extras = array_merge(
            ['translatable' => json_decode($this->getRawOriginal('extras_translatable'))],
            $this->prepareExtras($this->extras) ?? [],
        );

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'title' => $this->title,
            'content' => $this->content,
            'extras' => $extras,
        ];
    }

    public function prepareExtras($original)
    {
        if (! $original) {
            return null;
        }

        // Filter nulls
        $extras = array_filter($original, function ($extra) {
            return isset($extra);
        });

        // Decode JSONs
        foreach ($this->json_extras as $key) {
            if (isset($extras[$key])) {
                $extras[$key] = json_decode($extras[$key]);
            }
        }

        return $extras;
    }
}
