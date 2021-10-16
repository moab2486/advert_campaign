<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReadResource extends JsonResource
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
            "status_code" => 200,
            "message" => "Successfully created",
            "data"  => [
                'id' => $this->id,
                'advert_name' => $this->advert_name,
                'advert_date_from' => $this->advert_date_from,
                'advert_date_to' => $this->advert_date_to,
                'daily_advert_budget' => $this->daily_advert_budget,
                'total_advert_budget' => $this->total_advert_budget,
                'advert_creatives_path' => $this->advert_creatives_path,
            ],
        ];
    }
}
