<?php

namespace App\Http\Resources;

use App\Http\Resources\Lookups\PropertyCategory;
use App\Http\Resources\Lookups\PropertyDistrict;
use App\Http\Resources\Lookups\PropertyRegion;
use App\Http\Resources\Lookups\PropertyImage;
use App\Http\Resources\Lookups\PropertySubCategory;
use App\Http\Resources\User;
use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Mime\toString;

class Property extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return array(
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'description'    => $this->description,
            'type'           => $this->type,
            'price'          => $this->price,
            'address'        => $this->address,
            'viewNumber'     => $this->view_number,
            //'images'       => $this->propertyImages,
            'images'         => PropertyImage::collection($this->propertyImages),
            'isFavorite'     => $this->is_favorite,
            'category'       => new PropertyCategory($this->category),
            'subCategory'    => new PropertySubCategory($this->subcategory),
            'region'         => new PropertyRegion($this->region),
            'district'       => new PropertyDistrict($this->district),
            'createdBy'      => new User($this->owner),
            'createdAt'      => $this->created_at->toFormattedDateString(),
            'updatedAt'      => $this->updated_at->toDateTimeString(),
            'area'           => $this->area,
            'room'           => $this->room,
            'sittingRoom'    => $this->sitting_room,
            'bed'            => $this->bed,
            'bath'           => $this->bath,
            'vehicleBrand'   => $this->brand,
            'modelType'      => $this->model_type,
            'drivingType'    => $this->driving_type,
            'engineCapacity' => $this->engine_capacity,
            'coverage'       => $this->coverage,
            'fuelType'       => $this->fuel_type,
            'color'          => $this->color,
            'rate'           => $this->rate,
            'numRate'        => $this->numRate,
            'isBooking'      => $this->is_booking,

        );

    }



}
