@extends('layouts.app')

@section('content')
  <div class="panel-body">
    
    <h3>Make an Order</h3><hr>
      @include('partials.flash_message')

    <div class="row">
        <div class="col col-md-3">
            @include('partials.navbar')
        </div>

        <div class="col col-md-9 menu_action_box">
            <form class="form-horizontal" method="POST" action="{{ route('create_order') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Select Product</label>

                <div class="col-md-6">
                    <select id="product" class="form-control" name="product" value="{{ old('product') }}" required autofocus>
                        <option></option>
                        @foreach($products AS $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('product'))
                        <span class="help-block">
                            <strong>{{ $errors->first('product') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                <label for="quantity" class="col-md-4 control-label">Order Quantity</label>

                <div class="col-md-6">
                    <!-- <input id="quantity" name="quantity" type="range" min="1" max="10" value="{{ old('quantity') }}" required autofocus /> -->
                    <select id="quantity" class="form-control" name="quantity" value="{{ old('quantity') }}" required autofocus>
                        @for($i = 1; $i<=10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                
                    @if ($errors->has('quantity'))
                        <span class="help-block">
                            <strong>{{ $errors->first('quantity') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Make Order
                    </button>
                </div>
            </div>
        </form>
    </div>    
  </div>
@endsection
