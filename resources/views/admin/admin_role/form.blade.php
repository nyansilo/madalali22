<div class="col-md-9">

     <div class="card mb-3">

        <div class="card-body">

              
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Role name...']) !!}

                @if($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                {!! Form::label('slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder'=>'Role Slug...']) !!}

                @if($errors->has('slug'))
                    <span class="help-block">{{ $errors->first('slug') }}</span>
                @endif
            </div>

            <div class="form-group" {{ $errors->has('permissions') ? 'has-error' : '' }}>
                
                {!! Form::label('permissions','Add Permissions',['class'=>'form-label', 'for'=>'permissions']) !!}
                   
                    <input type="text" data-role="tagsinput" name="permissions" class="form-control"  id="permission" value="@foreach($role->permissions as $permission){{ $permission->name. ","}}@endforeach">

                @if($errors->has('permissions'))
                    <span class="help-block">{{ $errors->first('permissions') }}</span>
                @endif  
            </div>   


            <div class="card-footer text-end">
                  <div class="d-flex">
                    <a href="{{ route('admin.admin_role.index') }}" class="btn btn-default">Cancel</a>
                     <button type="submit" class="btn btn-primary ms-auto">{{ $role->exists ? 'Update' : 'Save' }}</button>
                
                  
                  </div>

              </div>

     

      </div>

</div> 


 