<?php

//Command: php artisan make:controller 'Admin\PropertyController' --resource

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertySubCategory;
use App\Http\Requests\PropertyRequest;
use Intervention\Image\Facades\Image;
use File;

class PropertyController extends BackendController 
{

     protected $limit = 5; 
    protected $uploadPath;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->uploadPath = public_path(config('cms.image.directory'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

         $onlyTrashed = FALSE;

        if (($status = $request->get('status')) && $status == 'trash')
        {
            $properties       = Property::onlyTrashed()->with('category', 'owner')->latest()->paginate($this->limit);
            $propertyCount   = Property::onlyTrashed()->count();
            $onlyTrashed = TRUE;
        }
        elseif ($status == 'published')
        {
            $properties       = Property::published()->with('category', 'owner')->latest()->paginate($this->limit);
            $propertyCount   = Property::published()->count();
        }
  
        elseif ($status == 'pending')
        {
            $properties       = Property::pending()->with('category', 'owner')->latest()->paginate($this->limit);
            $propertyCount   = Property::pending()->count();
        }
        elseif ($status == 'rejected')
        {
            $properties       = Property::rejected()->with('category', 'owner')->latest()->paginate($this->limit);
            $propertyCount   = Property::rejected()->count();
        }
         elseif ($status == 'own')
        {
            $properties       = $request->user()->properties()->with('category', 'owner')->latest()->paginate($this->limit);
            $propertyCount   = $request->user()->properties()->count();
        }
        else
        {
            $properties       = Property::with('category', 'owner')->latest()->paginate($this->limit);
            $propertyCount   = Property::count();
        }

        $statusList = $this->statusList($request);

        //$properties = Property::with('category','owner')->latestFirst()->paginate($this->limit);
        return view('admin.property.index', compact('properties','propertyCount','onlyTrashed','statusList'));
    }



    private function statusList($request)
    {
        return [
            'own'        => $request->user()->properties()->count(),
            'all'        => Property::count(),
            'published'  => Property::published()->count(),
            'pending'    => Property::pending()->count(),
            'rejected'   => Property::rejected()->count(),
            'trash'      => Property::onlyTrashed()->count(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {
         $property = new Property();
      

         return view('admin.property.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {

    
        $data = $request->all();
        $new_property =  $request->user()->properties()->create($data);

        if ($request->hasFile('images'))
        {
            $destination = $this->uploadPath;


            foreach($request->file('images') as $image)
            {
                $extension = $image->getClientOriginalExtension();
                $type      = $image->getClientMimeType();
                $name      = $image->getClientOriginalName();
                $size      = $image->getSize()/1024;
                $fileName  = $data['title'].'-image-'.time().rand(1,100).'.'.$extension;
                $image->move($destination, $fileName);
        
                $object = PropertyImage::create([
                    'property_id' => $new_property->id,
                    'image'       => $fileName,
                    //'type'      => $type,
                    'name'        => $name,
                    'size'        => $size,
                    'extension'   => $extension,
                ]);
  
               
            } 

            //Create a thumbnail

            if ( ! is_null($new_property->propertyImages[0]->image))
            {
                $image           = $new_property->propertyImages[0]->image;
                $imgExtension    = $new_property->propertyImages[0]->extension;
                $fileName        = $new_property->propertyImages[0]->image;

                $width           = config('cms.image.thumbnail.width');
                $height          = config('cms.image.thumbnail.height');
                $thumbnail       = str_replace(".{$imgExtension }", "_thumb.{$imgExtension}", $fileName);

                Image::make($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            } 
           
        }




        return redirect('/admin/property')->with('message', 'Your property was created successfully!');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view("admin.property.edit", compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $property = Property::with('propertyImages')
    ->where('id', $id)
    ->first();

    //dd($property);
        //$property     = Property::findOrFail($id);
        //$oldImage = $property->image;

        if($request->hasFile('images')){

            //Removing the previous images
            $propertyImages = $property->propertyImages;

            foreach($propertyImages as $propertyImage)
            {
                $image = $propertyImage->image;
                $this->removeImage($image);
            }
        }
        //After remove old image update the property
        //$data = $request->all();
        //$property->update($data);

        //dd($property->update($data));
      


        //The upload the newly selected images
        if ($request->hasFile('images'))
        {
            $destination = $this->uploadPath;

        


            foreach($request->file('images') as $image)
            {
                $extension = $image->getClientOriginalExtension();
                $type      = $image->getClientMimeType();
                $name      = $image->getClientOriginalName();
                $size      = $image->getSize()/1024;
                $fileName  = $request->title.'-image-'.time().rand(1,100).'.'.$extension;
                $image->move($destination, $fileName);
                
                $propertyImage = new PropertyImage();
                $propertyImage->create([
                    'property_id' => $property->id,
                    'image'       => $fileName,
                    //'type'        => $type,
                    'name'        => $name,
                    'size'        => $size,
                    'extension'   => $extension,

                ]);
                //$property->propertyImages->image = $fileName;
                //$property->propertyImages->name = $name;
                //$property->propertyImages->size = $size;
                //$property->propertyImages->extension = $extension;
              
                $property->save();

               
            } 
         

            //Create a thumbnail

            if ( ! is_null($property->propertyImages[0]->image))
            {
                dump($property->id);
                $image           = $property->propertyImages[0]->image;
                $imgExtension    = $property->propertyImages[0]->extension;
                $fileName        = $property->propertyImages[0]->image;

                $width           = config('cms.image.thumbnail.width');
                $height          = config('cms.image.thumbnail.height');
                $thumbnail       = str_replace(".{$imgExtension }", "_thumb.{$imgExtension}", $fileName);
                //dd($destination . '/' . $fileName);

                Image::make($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            } 
           
        }

        $notification = array(

            'message' => 'Your property was updated successfully!',
            'alert-type'=> 'success'
        );
        //return redirect('/admin/property')->with($notification);
        return redirect('/admin/property')->with('message', 'Your property was updated successfully!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Property::findOrFail($id)->delete();

        return redirect('/admin/property')->with('trash-message', ['Your property has moved to Trash', $id]);
    }


    public function forceDestroy($id)
    {
        $property = Property::withTrashed()->findOrFail($id);
       //$images = explode(",", $property->propertyImages);
        $propertyImages = $property->propertyImages;
        $property->forceDelete();

        foreach($propertyImages as $propertyImage){

            $image = $propertyImage->image;

            $this->removeImage($image);
            //if(File::exists($imagePath)) {
               // File::delete($imagePath);
           // }
        }
      

        return redirect('/admin/property?status=trash')->with('message', 'Your property has been deleted successfully');
    }
   


    public function restore($id)
    {
        $property = Property::withTrashed()->findOrFail($id);
        $property->restore();

        return redirect()->back()->with('message', 'You property has been moved from the Trash');
    }
    private function removeImage($image)
    {
        if ( ! empty($image) )
        {
            $imagePath     = $this->uploadPath . '/' . $image;
            $ext           = substr(strrchr($image, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if ( file_exists($imagePath) ) unlink($imagePath);
            if ( file_exists($thumbnailPath) ) unlink($thumbnailPath);
        }
    }
}
