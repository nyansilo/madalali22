<?php

namespace App\Http\Resources\Lookups;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyImage extends JsonResource
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
            //'propertyId' => $this->property_id,
            //'imageName' => $this->image,
            //'imgUrl' => (!is_null($this->image)) ? asset('img/' .$this->image) : asset('img/default-placeholder.png'),

            'imgUrl'=> asset('img/' .$this->image),

        ];
    }
}
