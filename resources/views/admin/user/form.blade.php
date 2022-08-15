<div class="col-md-8">

    <div class="card mb-3">

        <div class="card-body">

              
            <div class="form-group {{ $errors->has('user_name') ? 'has-error' : '' }}">
                {!! Form::label('user_name') !!}
                {!! Form::text('user_name', null, ['class' => 'form-control', 'placeholder'=>'user_name...']) !!}

                @if($errors->has('user_name'))
                    <span class="help-block">{{ $errors->first('user_name') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                {!! Form::label('slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control','placeholder'=>'user slug...']) !!}

                @if($errors->has('slug'))
                    <span class="help-block">{{ $errors->first('slug') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                {!! Form::label('first_name') !!}
                {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder'=>'user first name...']) !!}

                @if($errors->has('first_name'))
                    <span class="help-block">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                {!! Form::label('last_name') !!}
                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder'=>'user last name...']) !!}

                @if($errors->has('last_name'))
                    <span class="help-block">{{ $errors->first('last_name') }}</span>
                @endif
            </div>

             <div class="form-group {{ $errors->has('job_title') ? 'has-error' : '' }}">
                {!! Form::label('job_title') !!}
                {!! Form::text('job_title', null, ['class' => 'form-control', 'placeholder'=>'user job title...']) !!}

                @if($errors->has('job_title'))
                    <span class="help-block">{{ $errors->first('job_title') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email') !!}
                {!! Form::text('email', null, ['class' => 'form-control','placeholder'=>'user email...']) !!}

                @if($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('password') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}

                @if($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                {!! Form::label('password_confirmation') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}

                @if($errors->has('password_confirmation'))
                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            

            <div class="form-group {{ $errors->has('bio') ? 'has-error' : '' }}">
                {!! Form::label('bio') !!}
                {!! Form::textArea('bio', null, ['class' => 'form-control','placeholder'=>'user bio...']) !!}

                @if($errors->has('bio'))
                    <span class="help-block">{{ $errors->first('bio') }}</span>
                @endif
            </div>
                

        
            <div class="card-footer text-end">

                <div class="d-flex">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-default">Cancel</a>

                     <button type="submit" class="btn btn-primary ms-auto">{{ $user->exists ? 'Update' : 'Save' }}</button>
                  
                  </div>

            </div>

        </div>

    </div>

</div> 

<div class="col-md-4">


    {{-- Feature Image --}} 
    <div class="card mb-3">

        <div class="card-header">
             <h3 class="card-title">Profile Picture</h3>
        </div>

        <div class="card-body">

           
            <div class="input-group {{ $errors->has('profile_picture') ? 'has-error' : '' }}">
                    

                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new img-thumbnail mb-3 " style="width: 250px; height: 200px;">
                             <img src="{{ ($user->profile_url) ? $user->profile_url : $user->default_profile }}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists img-thumbnail" style="width: 250px; height: 200px;">
                            
                        </div>
                        <div style="margin-top: 10px;">
                          <span class="btn btn-outline-secondary btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            {!! Form::file('profile_picture',) !!}
                          </span>
                          <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                   
                    @if($errors->has('profile_picture'))
                        <span class="help-block">{{ $errors->first('profile_picture') }}</span>
                    @endif
                </div>   
            </div> 

        </div>

    </div>


</div> 


 