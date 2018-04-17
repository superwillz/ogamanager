@extends('layouts.app')

@section('content')
  <div class="panel-body">
    @include('partials.flash_message')


    <h4>{{ isset($user) ?  "Edit" : "Add" }} New User</h4><hr>

    <div class="row">
        <div class="col col-md-3">
            @include('partials.navbar');
        </div>

        <div class="col col-md-9 menu_action_box">
            <form class="form-horizontal" method="POST" action="@if(!isset($user)){{ route('create_user') }}@endif" >
                {{ csrf_field() }}
                
                @if(isset($user))
                    <input type="hidden" name="_method" value="PUT" />
                @endif

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="@if(isset($user)){{ $user->name }}@else{{ old('name') }}@endif" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="@if(isset($user)){{ $user->email }}@else{{ old('email') }}@endif" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if(!isset($user))
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="user-type" class="col-md-4 control-label">User Type</label>

                    <div class="col-md-6">
                        <select id="user-type" class="form-control" name="type" required>
                            <option></option>
                            <option value="manager">Manager</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            @if(!isset($user))
                                Create User
                            @else
                                Edit User Details
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
  </div>
@endsection
