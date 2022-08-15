<?php

//Command: php artisan make:model Admin

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Property;
use App\Traits\HasRolesAndPermissions;
use App\Models\Blog;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    protected $guard = 'admins';

    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'slug',
        'first_name',
        'last_name',
        'job_title',
        'email',
        'password',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     /**
     * et up Admin/Author - Property  Relationship.
     * One User will have many properties.
     */

    public function properties()
    {
        return $this->hasMany(Property::class, 'owner_id');
    }

     /**
     * Set up Admin/Author- Blogs  Relationship.
     * One User will have many properties.
     */

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    public function getFullNameAttribute($value)
    {
        $firstName = $this->first_name;
        $lastName  = $this->last_name;
        $fullName  = $firstName ." ".$lastName;

        return $fullName; 
    }

    public function getDefaultProfileAttribute($value){

             $directory = config('cms.image.directory');
             $imageUrl = asset("{$directory}/"."profileImg.png");
             return $imageUrl;
    }

    public function getProfileUrlAttribute($value)
    {
    
        $imageUrl = "";

        //Make sure the owner has image
        if ( ! is_null($this->profile_picture))
        {
            $directory = config('cms.image.directory');
            //public_path() is helper function for site public directory
            //{$directory}/ is simple (img) folder where image get stored
            //$this->propertyImages[0]->image is the image itself
            //this keyword refer this Model(Property)
            $imagePath = public_path() . "/{$directory}/" . $this->profile_picture;
            //then if imagePath exist in the server we return the imageUrl
            if (file_exists($imagePath)) $imageUrl = asset("{$directory}/" . $this->profile_picture);

        }

        return $imageUrl;
    }
}

