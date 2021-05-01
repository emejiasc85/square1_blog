<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostResource extends JsonResource
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
            'id'                        => $this->id,
            'title'                     => $this->title,
            'slug'                      => $this->slug,
            'url'                       => $this->url,
            'description'               => $this->description,
            'short_description'         => Str::limit( strip_tags($this->description)),
            'publication_date'          => $this->publication_date,
            'publication_date_formated' => $this->publicationDateFormated,
            'author_name'               => $this->user->name
        ];
    }
}
