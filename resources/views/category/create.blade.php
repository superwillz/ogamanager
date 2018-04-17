@extends('layouts.app')

@section('content')
  <div class="panel-body">    
    <h3>Add a Category</h3><hr>
      @include('partials.flash_message')

    <div class="row">
        <div class="col col-md-3">
            @include('partials.navbar')
        </div>

        <div class="col col-md-9 menu_action_box">
            <form class="form-horizontal" method="POST" action="{{ route('create_category') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Category Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Category Description</label>

                <div class="col-md-6">
                    <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus></textarea>

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Add Category
                    </button>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection
