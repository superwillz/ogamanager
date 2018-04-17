@extends('layouts.app')

@section('content')
  <div class="panel-body">

  <h3>Viewing All Products in Inventory <small style="font-size:12px;">( 
    <span style="color:red;font-weight:bold;">Out of Stock</span>  -  
    <span style="color:orange;font-weight:bold;"> Going Out of Stock</span> -  
    <span style="color:grey;font-weight:bold;"> Average in Stock</span> -  
    <span style="color:green;font-weight:bold;"> In Stock</span>
  )
  </small></h3>

  <form class="pull-right" action="/product/search" method="POST">
    {{ csrf_field() }}
    <input type="text" name="product_identity" placeholder="Product ID" />  
    <button type="submit" name="search_order" class="btn btn-xs btn-primary">Search</button>  
  </form>

  <hr>

  <div class="row">
      <div class="col col-md-3">
          @include('partials.navbar')
      </div>

      <div class="col col-md-9 menu_action_box">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="row">Name</th>
              <th scope="row">Category</th>
              <th scope="row">Description</th>
              <th scope="row">Manufacturer</th>
              <th scope="row">Weight</th>
              <th scope="row">Colour</th>
              <th scope="row">Stock</th>
              <th scope="row">Last Updated By</th>
              <th scope="row">Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products AS $product)
              <tr style="color:#fff;background:@if($product->stock == 0){{ 'red' }}@elseif($product->stock <= 5){{ 'orange' }}@elseif($product->stock <= 19){{ 'grey' }}@else{{ 'green' }}@endif" >
                <td>
                  @if((auth()->user()->type == 'admin') || (auth()->user()->type == 'manager'))
                    <a href="/product/{{ $product->id }}/delete" style="color:red" onclick='return confirm("Are you sure you want to delete this product?")'  title="Delete Order"><strong>X</strong></a>
                  @endif
                  {{ $product->name }}
                </td>
                <td width="80">{{ $product->category->name }}</td>
                <td width="180">{{ substr($product->description, 0, 50) }}...</td>
                <td>{{ $product->manufacturer }}</td>
                <td>{{ $product->weight }}</td>
                <td>{{ $product->colour }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->updated_by->name }}</td>
                <td>{{ $product->updated_at->diffForHumans() }}</td>
              </tr>
            @endforeach
          
          </tbody>
        </table>
      </div>
      </div>
  </div>
@endsection
