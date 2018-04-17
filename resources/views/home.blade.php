@extends('layouts.app')

@section('content')
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

       <div class="row">
        <div class="col col-md-3">
            @include('partials.navbar')
        </div>

        <div class="col col-md-9 menu_action_box text-center">
            <br><br>
            <button class="btn btn-lg btn-danger">
                <strong>{{ $total_orders }}</strong><br><small>Total Orders</small>
            </button>

            <button class="btn btn-lg btn-primary">
                <strong>{{ $total_categories }}</strong><br><small>Total Categories</small>
            </button>

            <button class="btn btn-lg btn-success">
                <strong>{{ $total_products }}</strong><br><small>Total Products</small>
            </button>

            <button class="btn btn-lg btn-info">
                <strong>{{ $total_users }}</strong><br><small>Total Users</small>
            </button>

			<!-- div id="peeng-it-api-box"></div> -->
        </div>
       </div>
    </div>
@endsection
