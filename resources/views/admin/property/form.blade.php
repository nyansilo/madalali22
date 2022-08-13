<div class="col-md-8">

    <div class="card mb-3">

        <div class="card-body">

            {!! Form::label('title', 'Title',['class'=>'form-label']) !!}
            <div class="mb-2 {{ $errors->has('title') ? 'has-error' : '' }}">         
                  {!! Form::text('title', null, ['class' => 'form-control']) !!}

                  @if($errors->has('title'))
                  <span class="help-block">{{ $errors->first('title') }}</span>
                  @endif
            </div>

            {!! Form::label('slug','Slug',['class'=>'form-label']) !!}
            <div class="mb-2  {{ $errors->has('slug') ? 'has-error' : '' }}">
                  {!! Form::text('slug', null, ['class' => 'form-control']) !!}

                  @if($errors->has('slug'))
                  <span class="help-block">{{ $errors->first('slug') }}</span>
                  @endif
            </div>

            {{ Form::hidden('property_code', App\Models\Property::random_strings(6),null, array('id' => 'property_code')) }}



            {!! Form::label('address','Address',['class'=>'form-label']) !!}
            <div class="mb-2  {{ $errors->has('address') ? 'has-error' : '' }}">
                  {!! Form::text('address', null, ['class' => 'form-control']) !!}

                  @if($errors->has('address'))
                  <span class="help-block">{{ $errors->first('address') }}</span>
                  @endif
            </div> 

            {!! Form::label('region','Region/City',['class'=>'form-label']) !!}
            <div class="mb-2 {{ $errors->has('region_id') ? 'has-error' : '' }}">
              {!! Form::select('region_id', App\Models\Region::pluck('name', 'id'),  null, ['class' => 'form-select', 'placeholder' => 'Select a Region City']) !!}
                @if($errors->has('region_id'))
                    <span class="help-block">{{ $errors->first('region_id') }}</span>
                @endif
            </div>

            {!! Form::label('district','District',['class'=>'form-label']) !!}
            <div class="mb-2 {{ $errors->has('district_id') ? 'has-error' : '' }}">
                @php 

                    if(old('district_id')) {
                        //$old_district_name = App\Models\District::where('id', old('district_id'))->first()->name;
                    }

                     $value = old('district_id');

                   
                @endphp
                


                

                {!! Form::select('district_id', [null=>'Select'], $value, ['class' => 'form-select', 'id' => 'district' ]) !!}

                @if($errors->has('district_id'))
                    <span class="help-block">{{ $errors->first('district_id') }}</span>
                @endif
            </div>



            {!! Form::label('category','Main Category',['class'=>'form-label']) !!}
            <div class="mb-2 {{ $errors->has('category_id') ? 'has-error' : '' }}">
              {!! Form::select('category_id',  App\Models\PropertyCategory::pluck('title', 'id'),  null, ['class' => 'form-select', 'placeholder' => 'Select a Category']) !!}
                @if($errors->has('category_id'))
                    <span class="help-block">{{ $errors->first('category_id') }}</span>
                @endif
            </div>

            {!! Form::label('sub_category','Sub Category',['class'=>'form-label']) !!}
            <div class="mb-2 {{ $errors->has('subcategory_id') ? 'has-error' : '' }}">
                <select class="form-select" name="subcategory_id" id="subcategory" data-selected-subcategory="{{ old('subcategory_id') }}">
                            
                </select>
                @if($errors->has('subcategory_id'))
                    <span class="help-block">{{ $errors->first('subcategory_id') }}</span>
                @endif
            </div>

             {!! Form::label('type','Type',['class'=>'form-label']) !!}
             <div class="mb-2 {{ $errors->has('type') ? 'has-error' : '' }}">

                 {!! Form::select('type',[ null => 'Select Type'] + ['Rent' => 'For Rent', 'Sale' => 'For Sale'], null, ['class' => 'form-select']) !!}
                @if($errors->has('type'))
                    <span class="help-block">{{ $errors->first('type') }}</span>
                @endif
            </div>

            <div>

                {!! Form::label('status','Status',['class'=>'form-label']) !!}
                 <div class="mb-2 {{ $errors->has('status') ? 'has-error' : '' }}">

                     {!! Form::select('status',[ null => 'Select Status'] + ['pending' => 'Pending', 'rejected' => 'Rejected', 'published' => 'Published'], null, ['class' => 'form-select']) !!}
                    @if($errors->has('status'))
                        <span class="input-group help-block">{{ $errors->first('status') }}</span>
                    @endif
                </div>
            </div>    

             {!! Form::label('area','Area',['class'=>'form-label']) !!}
            <div class="input-group mb-2  {{ $errors->has('area') ? 'has-error' : '' }}">
                
                  {!! Form::text('area', null, ['class' => 'form-control']) !!}
                  <span class="input-group-text"> Square Metre</span>

                  
            </div>
            @if($errors->has('area'))
                  <span class="help-block error">{{ $errors->first('area') }}</span>
            @endif 
           


            {!! Form::label('price','Price',['class'=>'form-label']) !!}
            <div class="input-group mb-2  {{ $errors->has('price') ? 'has-error' : '' }}">
                
                  {!! Form::text('price', null, ['class' => 'form-control']) !!}
                  <span class="input-group-text"> Tsh</span>

                 
            </div>
             @if($errors->has('price'))
                  <span class="help-block error ">{{ $errors->first('price') }}</span>
             @endif 

             
            {!! Form::label('description','Description',['class'=>'form-label']) !!}
              <div class="mb-2  {{ $errors->has('description') ? 'has-error' : '' }}">
                  
                  {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

                  @if($errors->has('description'))
                  <span class="help-block">{{ $errors->first('description') }}</span>
                  @endif
            </div> 


        </div>

        <div class="card-footer text-end">
            <div class="d-flex">
                <a href="{{ route('admin.property.index') }}" class="btn btn-default">Cancel</a>
                 <button type="submit" class="btn btn-primary ms-auto">{{ $property->exists ? 'Update' : 'Save' }}</button>
            
              
            </div>

        </div>

    </div>

</div> 


<div class="col-md-4">

    {{-- Rooms --}} 
    <div class="card mb-3" id="room">

        <div class="card-header">
             <h3 class="card-title">Number of Rooms</h3>
        </div>
        
        <div class="card-body">

             {!! Form::label('room','Total Rooms',['class'=>'form-label']) !!}
            <div class="input-group mb-2 {{ $errors->has('room') ? 'has-error' : '' }}">

                 {!! Form::select('room',[ null => 'Please Select'] + ['1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','NA' => 'N/A'], null, ['class' => 'form-select']) !!}
            </div>
            @if($errors->has('room'))
                    <span class="help-block error">{{ $errors->first('room') }}</span>
            @endif


            {!! Form::label('bed','Bed Room',['class'=>'form-label']) !!}
            <div class="input-group mb-2 {{ $errors->has('bed') ? 'has-error' : '' }}">

                {!! Form::select('bed',[ null => 'Please Select'] + ['1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','NA' => 'N/A'], null, ['class' => 'form-select']) !!}
              
            </div>
            @if($errors->has('bed'))
                    <span class="help-block error">{{ $errors->first('bed') }}</span>
            @endif

            {!! Form::label('bath','Bath Room',['class'=>'form-label']) !!}
            <div class="input-group mb-2 {{ $errors->has('bath') ? 'has-error' : '' }}">

                {!! Form::select('bath',[ null => 'Please Select'] + ['1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','NA' => 'N/A'], null, ['class' => 'form-select'])!!}
               
            </div>
            @if($errors->has('bath'))
                    <span class="help-block error">{{ $errors->first('bath') }}</span>
            @endif


            {!! Form::label('sitting_room','Sitting Room',['class'=>'form-label']) !!}
            <div class="input-group mb-2 {{ $errors->has('sitting_room') ? 'has-error' : '' }}">

                 {!! Form::select('sitting_room',[ null => 'Please Select'] + ['1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','NA' => 'N/A'], null, ['class' => 'form-select']) !!}
                
            </div>
            @if($errors->has('sitting_room'))
                    <span class="help-block error">{{ $errors->first('sitting_room') }}</span>
            @endif

        </div>
    </div>

     {{-- Rooms --}} 
    <div class="card mb-3" id="vehicle">

        <div class="card-header">
             <h3 class="card-title">Vehicle Features</h3>
        </div>
        
        <div class="card-body">

            {!! Form::label('brand','Brand',['class'=>'form-label']) !!}
            <div class="input-group mb-2 {{ $errors->has('brand') ? 'has-error' : '' }}">

                {!! Form::text('brand', null, ['class' => 'form-control','placeholder' => 'Toyota | Nissan ...']) !!}
               
            </div>
             @if($errors->has('brand'))
                    <span class="help-block error">{{ $errors->first('brand') }}</span>
            @endif

            {!! Form::label('coverage','Coverage',['class'=>'form-label']) !!}
            <div class="input-group mb-2 {{ $errors->has('coverage') ? 'has-error' : '' }}">

                {!! Form::text('coverage', null, ['class' => 'form-control','placeholder' => 'eg 1800']) !!}
                 <span class="input-group-text"> Km</span>
                
            </div>
            @if($errors->has('coverage'))
                    <span class="help-block error">{{ $errors->first('coverage') }}</span>
            @endif

            {!! Form::label('engine_capacity','Engine Capacity',['class'=>'form-label']) !!}
            <div class="input-group mb-2 {{ $errors->has('engine_capacity') ? 'has-error' : '' }}">

                {!! Form::text('engine_capacity', null, ['class' => 'form-control','placeholder' => 'eg 900']) !!}
                 <span class="input-group-text"> cc</span>
                
            </div>
            @if($errors->has('engine_capacity'))
                <span class="help-block error">{{ $errors->first('engine_capacity') }}</span>
            @endif

            {!! Form::label('color','Color',['class'=>'form-label']) !!}
            <div class="input-group mb-2 {{ $errors->has('color') ? 'has-error' : '' }}">

                {!! Form::text('color', null, ['class' => 'form-control','placeholder' => 'Silver | black ..']) !!}
                
            </div>
            @if($errors->has('color'))
                <span class="help-block error">{{ $errors->first('color') }}</span>
            @endif


            {!! Form::label('driving_type','Driving Type',['class'=>'form-label']) !!}
            <div class="input-group mb-2 {{ $errors->has('driving_type') ? 'has-error' : '' }}">

                 {!! Form::select('driving_type',[ null => 'Select Type'] + ['Automatic' => 'Automatic', 'Manual' => 'Manual'], null, ['class' => 'form-select']) !!}
                
            </div>
            @if($errors->has('driving_type'))
                <span class="help-block error">{{ $errors->first('driving_type') }}</span>
            @endif

            {!! Form::label('fuel_type','Fuel Type',['class'=>'form-label']) !!}
            <div class="input-group mb-2 {{ $errors->has('fuel_type') ? 'has-error' : '' }}">

                 {!! Form::select('fuel_type',[ null => 'Select Type'] + ['Diesel' => 'Diesel', 'Petrol' => 'Petrol','Electricity' => 'Electricity', 'Gas' => 'Gas',], null, ['class' => 'form-select']) !!}
               
            </div>
             @if($errors->has('fuel_type'))
                <span class="help-block error">{{ $errors->first('fuel_type') }}</span>
            @endif

          
        </div>
    </div>


    


    {{-- Feature Image --}} 
    <div class="card mb-3">

        <div class="card-header">
             <h3 class="card-title">Feature Image</h3>
        </div>

        <div class="card-body">

           
            <div class="input-group {{ $errors->has('images[]') ? 'has-error' : '' }}">
                    

                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new img-thumbnail mb-3 " style="width: 250px; height: 200px;">
                             <img src="{{ ($property->image_thumb_url) ? $property->image_thumb_url : '/img/default-image.jpeg' }}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists img-thumbnail" style="width: 250px; height: 200px;">
                            
                        </div>
                        <div style="margin-top: 10px;">
                          <span class="btn btn-outline-secondary btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            {!! Form::file('images[]',['multiple' => true]) !!}
                          </span>
                          <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                   
                    @if($errors->has('images[]'))
                        <span class="help-block">{{ $errors->first('images[]') }}</span>
                    @endif
                </div>   
            </div> 

        </div>

    </div>


    


</div?    