<div class="col-md-9">

     <div class="card mb-3">

        <div class="card-body">

              
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label('title') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}

                @if($errors->has('title'))
                    <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                {!! Form::label('slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control']) !!}

                @if($errors->has('slug'))
                    <span class="help-block">{{ $errors->first('slug') }}</span>
                @endif
            </div>


            <div class="card-footer text-end">
                  <div class="d-flex">
                    <a href="{{ route('admin.property_category.index') }}" class="btn btn-default">Cancel</a>
                     <button type="submit" class="btn btn-primary ms-auto">{{ $category->exists ? 'Update' : 'Save' }}</button>
                
                  
                  </div>

              </div>

     

      </div>

</div> 


 