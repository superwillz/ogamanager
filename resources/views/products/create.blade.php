@extends('layouts.app')

@section('content')
  <div class="panel-body">
    
    <h3>Add a Product</h3><hr>
      @include('partials.flash_message')

    <div class="row">
        <div class="col col-md-3">
            @include('partials.navbar')
        </div>

        <div class="col col-md-9 menu_action_box">
                @if(count($categories) == 0)
                    <h4 class="alert alert-warning text-center">
                        There are no Product Categories in the Inventory yet. <br>
                        Please <a href="{{ route('add_category') }}">Add a Product Category</a> before you add products.
                    </h4>
                @else
                <form class="form-horizontal" method="POST" action="{{ route('create_product') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Product Category</label>

                    <div class="col-md-6">
                        <select id="category" class="form-control" name="category" value="{{ old('category') }}" required autofocus>
                            <option></option>
                            @foreach($categories AS $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Product Name</label>

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
                    <label for="name" class="col-md-4 control-label">Product Description</label>

                    <div class="col-md-6">
                        <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus></textarea>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('manufacturer') ? ' has-error' : '' }}">
                    <label for="manufacturer" class="col-md-4 control-label">Product Manufacturer</label>

                    <div class="col-md-6">
                        <input id="manufacturer" type="text" class="form-control" name="manufacturer" value="{{ old('manufacturer') }}" required autofocus>

                        @if ($errors->has('manufacturer'))
                            <span class="help-block">
                                <strong>{{ $errors->first('manufacturer') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                    <label for="weight" class="col-md-4 control-label">Product Weight</label>

                    <div class="col-md-6">
                        <input id="weight" type="text" class="form-control" name="weight" value="{{ old('weight') }}" required autofocus>

                        @if ($errors->has('weight'))
                            <span class="help-block">
                                <strong>{{ $errors->first('weight') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('colour') ? ' has-error' : '' }}">
                    <label for="colour" class="col-md-4 control-label">Product Colour</label>

                    <div class="col-md-6">
                        <input id="colour" type="text" class="form-control" name="colour" value="{{ old('colour') }}" required autofocus>

                        @if ($errors->has('colour'))
                            <span class="help-block">
                                <strong>{{ $errors->first('colour') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                    <label for="stock" class="col-md-4 control-label">No. of Products to Stock</label>

                    <div class="col-md-6">
                        <input id="stock" type="text" class="form-control" name="stock" value="{{ old('stock') }}" required autofocus>

                        @if ($errors->has('stock'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stock') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Add Product
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>
  </div>
@endsection
