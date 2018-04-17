<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return view('orders.create', compact('products'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // CHECK QUANTITY OF PRODUCTS AVAILABLE FOR ORDER
        // $check_qty = Products

        // GET TOTAL QUANTITY ORDERED FOR THIS PRODUCT
        $total_orders_for_product = Order::where('product_id',  $request->product)->sum('qty');
        
        $product = Product::find($request->product);
        // $stock_left = $product->stock - $total_orders_for_product;
        $stock_left = $product->stock - $request->quantity;
        
        if($product->stock > 0) { // STOCK IS AVAILABLE
            if($product->stock >= $request->quantity) { // IF PRODUCT STOCK IS MORE THAN QTY REQUESTED
                $update_products = Product::where('id', $request->product)->update(['stock' => $stock_left]);
            
                $created_order = Order::create(['from_id' => auth()->user()->id, 'product_id' => $request->product, 'qty' => $request->quantity]);

                if($created_order) {
                    $request->session()->flash('success', 'Your order for <strong>' . $request->quantity . ' piece(s)</strong> of <strong>' . $product->name . '</strong> has been created and your Order ID is #' . $created_order->id . ' <a href="\order\history">View Order Details</a>');
                }
            } else {
                // ORDER QUANTITY IF MORE THAN STOCK
                $request->session()->flash('error', 'Your order for <strong>' . $request->quantity . ' piece(s)</strong> of <strong>' . $product->name . '</strong> is more than our stock. You can request for less than ' . ++$product->stock . ' piece(s)');
            }
        } else {
            // PRODUCT IS OUT OF STOCK
            $request->session()->flash('error', 'Sorry, Your order for <strong>' . $request->quantity . ' piece(s)</strong> of <strong>' . $product->name . '</strong> couldn\'t be completed as WE ARE OUT OF STOCK for the product.');
        }
        
        return redirect()->route('make_order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $product = Product::where('name', $request->order_identity)->first();

        $orders = Order::where('id', $request->order_identity)->get();

        if(count($orders) > 0) {
            request()->session()->flash('success', 'Found Result for <strong>#' . $request->order_identity . '</strong>!');
            return view('orders.all', compact('orders'));
        } elseif($product) {
            $orders = Order::where('product_id', $product->id)->get();
            request()->session()->flash('success', 'Found Result for <strong>' . $request->order_identity . '</strong>!');
            return view('orders.all', compact('orders'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_order = Order::destroy($id);

        if($deleted_order) {
            request()->session()->flash('success', 'You deleted order <strong>#' . $id . '</strong>!');

            return redirect()->route('view_orders');
        }
    }

    public function history() {
        if(auth()->user()->type == 'staff') {
            $orders = Order::where('from_id', auth()->user()->id)->get();
        } else {
            $orders = Order::get();
        }

        return view('orders.all', compact('orders'));
    }

    public function action($id, $action)
    {
        if($action == 'approve') { 
            $status = "approved"; 
        } elseif($action == 'unapprove') {
            $status = "not approved"; 
        }

        $order = Order::where('id', $id)->first();
        $act_on_order = Order::where('id', $order->id)->update(['status' => $status]);

        if($act_on_order) {
            if($action == 'unapprove') { 
                $product = Product::where('id', $order->product_id);
                $product_stock = $product->first()->stock;

                $update_products = $product->update(['stock' => ($product_stock + $order->qty)]);
            }
    
            request()->session()->flash('success', 'You ' . $action . 'd order <strong>#' . $id . '</strong>!');

            // SENDS A USER AN EMAIL MESSAGE

            return redirect()->route('view_orders');
        }
    }
}
