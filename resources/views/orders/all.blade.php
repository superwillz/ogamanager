@extends('layouts.app')

@section('content')
  <div class="panel-body">

  <h3>Viewing Orders</h3>

  <form class="pull-right" action="/order/search" method="POST">
    {{ csrf_field() }}
    <input type="text" name="order_identity" placeholder="Order ID" />  
    <button type="submit" name="search_order" class="btn btn-xs btn-primary">Search</button>  
  </form>

<div style="clear:both"></div>
  <hr>

  <div class="row">
    <div class="col col-md-3">
        @include('partials.navbar')
    </div>

    <div class="col col-md-9 menu_action_box">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="row">ID #</th>
            <th scope="row">From</th>
            <th scope="row">Name/Prod. ID</th>
            <th scope="row">Description</th>
            <th scope="row">Qty Requested</th>
            <th scope="row">Status</th>
            <th scope="row">Delivered</th>
            <th scope="row">Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders AS $order)
            <?php
              $product = \App\Product::find($order->product_id);
            ?>
            <tr>
              <td width="50">
                @if((auth()->user()->type == 'admin') || (auth()->user()->type == 'manager'))
                <a href="/order/{{ $order->id }}/delete" style="color:red" onclick='return confirm("Are you sure you want to delete this order?")' title="Delete Order"><strong>X</strong></a>
                @endif
                #{{ $order->id }}
              </td>
              <td>{{ $order->ordered_by->name }}</td>
              <td>{{ $product->name }} <strong>{{ $product->manufacturer }}</strong> / #{{ $product->id }}</td>
              <td width="150">{{ substr($product->description, 0, 100) }}...</td>
              <td>{{ $order->qty }}</td>
              <td>
                {{ ucwords($order->status) }}<br>
                @if($order->status == 'not approved')
                    <small><strong>Reason:</strong></small>
                @endif

                @if((auth()->user()->type == 'admin') || (auth()->user()->type == 'manager'))
                  @if($order->status == 'not approved')
                    <!-- <small><a href="/order/{{ $order->id }}/approve" style="font-size:9px;" class="btn btn-xs btn-success">Appr</a></small> -->
                  @elseif($order->status == 'approved')
                    <!-- <small><a href="/order/{{ $order->id }}/unapprove" style="font-size:9px;" class="btn btn-xs btn-danger">UnAppr</a></small> -->
                  @else
                  <small><a href="/order/{{ $order->id }}/approve" style="font-size:9px;" class="btn btn-xs btn-success">Appr</a></small> 
                    <small><a href="/order/{{ $order->id }}/unapprove" style="font-size:9px;" class="btn btn-xs btn-danger">UnAppr</a></small>
                  @endif
                @endif
              </td>
              <td>{{ ucwords($order->delivered) }}</td>
              <td>{{ $order->updated_at->diffForHumans() }}</td>
            </tr>
          @endforeach
        
        </tbody>
      </table>
    </div>
  </div>
  </div>
@endsection
