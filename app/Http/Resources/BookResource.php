<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            "status" => $this->status_code,
            "message" => $this->message,
            "data"  => [
                'id' => $this->id,
                'name' => $this->name,
                'isbn' => $this->isbn,
                'authors' => $this->authors,
                'country' => $this->country,
                'number_of_pages' => $this->numberOfPages,
                'publisher' => $this->publisher,
                'released_date' => $this->release_date
            ],
        ];
    }
}
