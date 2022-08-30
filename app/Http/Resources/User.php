<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'id'             => $this->id,
            'firstName'      => $this->first_name,
            'lastName'       => $this->last_name,
            'userName'       => $this->user_name,
            'phoneNumber'    => $this->phone_number,
            'bio'            => $this->bio,
            'jobTitle'       => $this->job_title,
            'email'          => $this->email,
            'profileImg'     => asset('img/' .$this->profile_picture),
            'joinedOn'       => $this->created_at->toFormattedDateString()

        ];
    }
}
