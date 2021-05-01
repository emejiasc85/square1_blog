<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'url'                       => route('show_post', [$this->id, $this->slug]),
            'description'               => $this->description,
            'short_description'         => Str::limit( strip_tags($this->description)),
            'publication_date'          => $this->publication_date,
            'publication_date_formated' => Carbon::parse($this->publication_date)->format('F d\\, Y'), //Jun 1, 2020
            'author_name'               => $this->user->name
        ];
    }
}
