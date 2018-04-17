@if((auth()->user()->type == 'admin') || (auth()->user()->type == 'user'))
    <ul>
        @if(auth()->user()->type == 'admin')
            <li><a href="{{ route('view_users') }}">View Users <br><small><strong>(Total: {{ $total_users }})</strong></small></a></li>
            <li><a href="{{ route('add_user') }}">Add User</a></li>
        @endif
        <!-- <li><a href="{{ route('add_user') }}">View Recent Orders</a></li> -->
        <li><a href="{{ route('view_orders') }}">View All Orders <br><small><strong>(Total: {{ $total_orders }}, Unanswered: {{ $unanswered_orders }})</strong></small></a></li>
        <!-- <li><a href="{{ route('add_user') }}">Search Order</a></li> -->
        <li><a href="{{ route('view_products') }}">View All Products<br><small><strong>(Total: {{ $total_products }})</strong></small></a></li>
        <li><a href="{{ route('add_product') }}">Add Product</a></li>
        <!-- <li><a href="{{ route('add_user') }}">Search Product</a></li> -->
        <li><a href="{{ route('add_category') }}">Add Product Category</a></li>
        <!-- <li><a href="{{ route('add_user') }}">Check Product Category Status</a></li> -->
        <!-- <li><a href="{{ route('add_user') }}">Move Product</a></li> -->
    </ul>
@elseif(auth()->user()->type == 'staff')
    <div class="row">
        <div class="col col-md-6">
            <a href="{{ route('make_order') }}" class="btn btn-sm btn-success">Make an Order</a>
        </div>

        <div class="col col-md-6">
            <a href="{{ route('view_orders') }}" class="btn btn-sm btn-primary">View Orders History</a>
        </div>
    </div>
@endif