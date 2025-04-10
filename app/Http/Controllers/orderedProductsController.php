<?php

namespace App\Http\Controllers;

use App\Models\orderedProducts;
use App\Models\order;
use App\Models\client;
use App\Models\user;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\CartController;
use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderedProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.createdBy',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);



        $kd=order::join('users','users.id','=','orders.KD_id')->
        join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->where('orders.createdBy',auth()->user()->id)->get();

        return view('agent.showOrders',compact('client','kd'));

    }
    public function kdView()
    {
        $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id) ->where('orders.confirmStatus','unconfirmed')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*']);
        return view('KD.showOrders',compact('client'));

    }

    public function orderHistory()
    {
        $client= order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.*'])->sortDesc();

        return view('KD.orderHistory',compact('client'));

    }
    public function orderDetails(Request $request )
    {
        $auth = Auth::user()->userName;
        $order_id=$request->order_id;

        $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')
        ->where('orders.KD_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $orderedProducts=orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();


        return view('orderCart.orderDetails',compact('orderedProducts','auth'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $order = order::create([


            $client_ids = explode('|', $request->client),

            'client_id'=>$client_ids[0],
            'KD_id'=>$client_ids[1] ,
            'createdDate'=> today(),
            'createdBy'=> auth()->user()->id,
            'totalPrice'=>$request->total
        ]);

        $products = \Cart::getcontent();

        // iterate through the products and store them into the database

        foreach($products as $product){
            OrderedProducts::create([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'ordered_quantity' => $product->quantity,
                'subTotal'=>$product->attributes->subtotal,
            ]);
        }

        Alert::toast('successfully Ordered', 'success');

        return redirect('/showOrders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function show(orderedProducts $orderedProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(orderedProducts $orderedProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orderedProducts $orderedProducts)
    {

        $orderupdate = order::where('id',$request->order_id)->update([
            'confirmStatus'=>$request->confirm]);

            Alert::toast('Order Confirmed', 'success');

        return redirect('key_distroDashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orderedProducts  $orderedProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(orderedProducts $orderedProducts)
    {
        //
    }
}
