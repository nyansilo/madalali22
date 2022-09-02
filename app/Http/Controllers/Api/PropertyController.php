<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Http\Resources\DistrictCollection;
use App\Http\Resources\PropertyCollection;
use App\Http\Resources\Property as PropertyResource;
use App\Http\Resources\PropertyDistrictCollection;
use App\Http\Resources\PropertyRegionCollection;
use App\Http\Resources\RegionCollection;
use App\Models\PropertyCategory;
use App\Models\Region;
use App\Models\PropertySubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;


class PropertyController extends Controller
{

    protected $uploadPath;

    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directory'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return PropertyCollection
     */
    public function index()
    {
        return new PropertyCollection(Property::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PropertyResource|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            //'title'          => 'required',
            //'slug'           => 'required|unique:properties',
            //'description'    => 'required',
            //'category_id'    => 'required',
            //'subcategory_id' => 'required',
            //'seller_name'    => 'required',
            //'favorite'       => 'required',
            //'type'       => 'required',
            //'seller_email'   => 'required',
            //'seller_phone'   => 'required',
            //'image_one'          => 'mimes:jpg,jpeg,bmp,png',
            //'image_two'          => 'mimes:jpg,jpeg,bmp,png',
        ]);

        if($validator->fails()){
            return response(['errors' => $validator->errors()], 422);
        }



        $data = $this->handleRequest($request);
        $property =  $request->user()->properties()->create($data);

        return new PropertyResource($property);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProperty(Request $request, $property_id)
    {
        $validator = Validator::make($request->all(),[
            //'title'          => 'required',
            //'slug'           => 'required|unique:properties',
            //'description'    => 'required',
            //'category_id'    => 'required',
            //'subcategory_id' => 'required',
            //'seller_name'    => 'required',
            //'favorite'       => 'required',
            //'type'       => 'required',
            //'seller_email'   => 'required',
            //'seller_phone'   => 'required',
            //'image_one'          => 'mimes:jpg,jpeg,bmp,png',
            //'image_two'          => 'mimes:jpg,jpeg,bmp,png',
        ]);

        if($validator->fails()){
            return response(['errors' => $validator->errors()], 422);
        }


        $property  = Property::findorFail($property_id);

//        $property->price = $request->get('price');
//        $property->favorite = $request->get('favorite');
//        $property->type = $request->get('type');
//        $property->update();

        $oldImageOne = $property->image_one;
        $oldImageTwo = $property->image_two;
        $data     = $this->handleRequest($request);
        //dd($property->update($data));

        $property->update($data);


        if ($oldImageOne !== $property->image_one || $oldImageTwo !== $property->image_two) {
            $this->removeImageOne($oldImageOne);
            $this->removeImageTwo($oldImageTwo);
        }

        return  response([
            'isFavorite' => $property->favorite,
            'price' => $property->price,
            'type' => $property->type,


        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($property_id)
    {
        $user = auth('api')->user();
        //dd($property_id);


        //$property = Property::where('id',$property_id )->get();

        //$property = Property::where('id',$property_id )->where('owner_id','=',$user_id)->get();

        $property = $user->properties()->findOrfail($property_id);
        $property->delete();
        $this->removeImageOne($property->image_one);
        $this->removeImageTwo($property->image_two);

        return  response(['data' => 'Successfully deleted', 'status' => 200]);
    }

    public function getRecentProperties()
    {
        $recent  = Property::with('owner','district','region','category')
            ->latest()
            ->paginate(10);
        return new PropertyCollection($recent);
    }

    public function getPopularProperties()
    {
        $popular  = Property::with('owner','district','region','category')
            ->popular()
            ->paginate(10);
            $popularCollection = new PropertyCollection($popular);
        //return $popularCollection->response()->setStatusCode(200);
        return $popularCollection;
    }

    public function getFeaturedProperties()
    {
        $featuredProperties  = Property::with('owner','district','region','category')
            ->featured()
            ->paginate(10);

        $featuredrCollection = new PropertyCollection($featuredProperties);
        //return $popularCollection->response()->setStatusCode(200);
        return $featuredrCollection;
    }



    public function getRelatedPropertiesByPropertyId($propertyId)
    {
        $property = Property::findorFail($propertyId);
        $relatedProperties  = $property->relatedProperties(6, true)
                                       ->with('owner','district','region','category')->get();

        $elatedCollection = new PropertyCollection($relatedProperties);
        return $elatedCollection;
    }


    public function getPropertiesByCategoryId($category_id)
    {
        $category  = PropertyCategory::findorFail($category_id);
        $properties = $category->properties()
            ->with('owner','district','region')
            ->latest()
            ->paginate(10);
        return new PropertyCollection($properties);
    }

    public function getFavoritePropertiesByUserId($user_id)
    {

        $user  = User::findorFail($user_id);
        $favorites = $user->properties()
            ->with('owner','district','region')
            ->favorite()
            ->latestFirst()
            ->paginate(10);
        return new PropertyCollection($favorites);
    }


    public function getUserPropertiesByUserId($user_id)
    {

        //$user  = User::findorFail($user_id);
        //$user_properties = $user->properties();
        $user_properties = Property::where('owner_id',$user_id)
               // dd($user_properties);

            ->with('owner','district','region')
            ->latestFirst()
            ->paginate(10);
        return new PropertyCollection($user_properties);
    }



    public function updateFavoriteByPropertyId(Request $request, $product_id)
    {
        $validator = Validator::make($request->all(),[
            //'title'          => 'required',
            //'slug'           => 'required|unique:properties',
            //'description'    => 'required',
            //'category_id'    => 'required',
            //'subcategory_id' => 'required',
            //'seller_name'    => 'required',
            //'favorite'       => 'required',
            //'type'       => 'required',
            //'seller_email'   => 'required',
            //'seller_phone'   => 'required',
            //'image_one'          => 'mimes:jpg,jpeg,bmp,png',
            //'image_two'          => 'mimes:jpg,jpeg,bmp,png',
        ]);

        if($validator->fails()){
            return response(['errors' => $validator->errors()], 422);
        }


        $property  = Property::findorFail($product_id);

//        $property->price = $request->get('price');
//        $property->favorite = $request->get('favorite');
//        $property->type = $request->get('type');
//        $property->update();

        $oldImageOne = $property->image_one;
        $oldImageTwo = $property->image_two;
        $data     = $this->handleRequest($request);
        //dd($property->update($data));

        $property->update($data);


        if ($oldImageOne !== $property->image_one || $oldImageTwo !== $property->image_two) {
            $this->removeImageOne($oldImageOne);
            $this->removeImageTwo($oldImageTwo);
        }

        return  response([
            'isFavorite' => $property->favorite,
            'price' => $property->price,
            'type' => $property->type,


        ]);

        //return new PropertyResource($property);
    }

    private function handleRequest($request)
    {
         $data = $request->all();
        //$data = $request->only('favorite','type', 'price');


        if ($request->hasFile('image_one') || $request->hasFile('image_two'))
        {
            $image_one       = $request->file('image_one');
            $fileName1    = $image_one->getClientOriginalName();
            $image_two       = $request->file('image_two');
            $fileName2    = $image_two->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded1 = $image_one->move($destination, $fileName1);
            $successUploaded2 = $image_two->move($destination, $fileName2);

            if ($successUploaded1 || $successUploaded2 )
            {
                $width     = config('cms.image.thumbnail.width');
                $height    = config('cms.image.thumbnail.height');
                $extension1 = $image_one->getClientOriginalExtension();
                $extension2 = $image_two->getClientOriginalExtension();
                $thumbnail1 = str_replace(".{$extension1}", "_thumb.{$extension1}", $fileName1);
                $thumbnail2 = str_replace(".{$extension2}", "_thumb.{$extension2}", $fileName2);

                Image::make($destination . '/' . $fileName1)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail1);

                Image::make($destination . '/' . $fileName2)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail2);
            }

            $data['image_one'] = $fileName1;
            $data['image_two'] = $fileName2;
        }

        return $data;
    }

    private function removeImageOne($image_one)
    {
        if ( ! empty($image_one) )
        {
            $imagePath     = $this->uploadPath . '/' . $image_one;
            $ext           = substr(strrchr($image_one, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $image_one);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if ( file_exists($imagePath) ) unlink($imagePath);
            if ( file_exists($thumbnailPath) ) unlink($thumbnailPath);
        }
    }

    private function removeImageTwo($image_two)
    {
        if ( ! empty($image_two) )
        {
            $imagePath     = $this->uploadPath . '/' . $image_two;
            $ext           = substr(strrchr($image_two, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $image_two);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if ( file_exists($imagePath) ) unlink($imagePath);
            if ( file_exists($thumbnailPath) ) unlink($thumbnailPath);
        }
    }

    public function getSubCategories($category_id)
    {
        $subcategories = SubCategory::where('category_id',$category_id)->pluck('title', 'id');
        return json_encode($subcategories);


    }

    public function getAllRegions()
    {

        $regions = Region::get();

        return  response(['state' => $regions, 200 ]);

    }
//    public function getDistrictsByRegionId(Request $request)
//    {
//        $region_id = $request->only('state_id');
//        $districts = District::where('region_id',$region_id)->get();
//        return  response(['cities' => $districts , 200]);
//    }
    public function getDistrictsByRegionId($region_id)
    {

        $districts = District::where('region_id',$region_id)->get();
        return  response(['cities' => $districts , 200]);
    }

    public function getAllCategories()
    {

        $categories = PropertyCategory::get();

        return  response(['data' => $categories, 200 ]);

    }

    public function getCategoriesByCategoryId($category_id )
    {

        $subcats = SubCategory::where('category_id',$category_id)->get();
        return  response(['data' => $subcats , 200]);
    }





}
