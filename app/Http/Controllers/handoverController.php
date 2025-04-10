<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderedProducts;
use App\Models\order;
use App\Models\client;
use App\Models\user;
use App\Models\rsp;
use App\Models\rom;
use App\Models\delivery1;
use App\Models\delivery1Products;
use App\Models\undeliveredOrders;
use App\Models\undelivered1Products;
use RealRashid\SweetAlert\Facades\Alert;

class handoverController extends Controller
{
    public function handOver1(Request $request )
    {
        $order_id=$request->order_id;

        $rom=rom::join('users','users.id','=','roms.user_id')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','roms.user_id']);


        $orderedProducts=orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();


        return view('KD.deliveryList',compact('orderedProducts','rom'));

    }
    public function store(Request $request )
    {
        $order_id=$request->order_id;

        $orderedProducts=orderedProducts::join('orders','orders.id','=','ordered_products.order_id')
        ->join('products','products.id','=','ordered_products.product_id')
        ->where('ordered_products.order_id',$order_id)->get();

        $products = \Cart::getcontent();

        $deliver1 = delivery1::create([

            'rom_id'=>$request->rom,
            'kd_id'=> auth()->user()->id,

            'order_id'=>$request->order_id,
            'deliveryTotalPrice'=>$request->total,




        ]);
        // iterate through the products and store them into the database

        foreach($products as $product){
            delivery1Products::create([
                'product_id' => $product->id,
                'delivery1_id' => $deliver1->id,
                'delivered_quantity' => $product->quantity,
                'subTotal' => $product->attributes->subtotal,

            ]);}

            $undeliveredOrders = undeliveredOrders::create([

                'rom_id'=>$request->rom,
                'kd_id'=> auth()->user()->id,

                'order_id'=>$request->order_id,

            ]);

            foreach($products as $product){
                undelivered1Products::create([
                    'product_id' => $product->id,
                    'undelivered1_id' => $undeliveredOrders->id,
                    'undelivered_quantity' => $product->attributes->ordered_quantity-$product->quantity,

                ]);}


        Alert::toast('successfully handovered', 'success');

        return redirect('/key_distroDashboard');
    }


    public function kdHandoverIndex( )
    {


        $rom=delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*'])->sortDesc();

        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get();


        return view('KD.handoverHistory',compact('deliveredProducts','rom'));

    }
    public function kdHandoverDetails(Request $request )
    {
        $rom_id=$request->delivery1_id;

        $rom=delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);

        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$rom_id)->get();



        return view('KD.deliveryDetails',compact('deliveredProducts','rom'));

    }
    public function kdUndeliveredIndex( )
    {


        $rom=undeliveredOrders::join('users','users.id','=','undelivered_orders.rom_id')
        ->join('roms','roms.user_id','=','undelivered_orders.rom_id')
        ->where('undelivered_orders.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','undelivered_orders.*'])->sortDesc();

        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get();


        return view('KD.undeliveredOrders',compact('deliveredProducts','rom'));

    }
    public function kdUndeliveredDetails(Request $request )
    {
        $rom_id=$request->delivery1_id;

        $rom=delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);

        $deliveredProducts=undelivered1Products::join('undelivered_orders','undelivered_orders.id','=','undelivered1_products.undelivered1_id')
        ->join('products','products.id','=','undelivered1_products.product_id')
        ->where('undelivered_orders.kd_id',auth()->user()->id)->where('undelivered1_products.undelivered1_id',$rom_id)->get();



        return view('KD.undeliveredDetails',compact('deliveredProducts','rom'));

    }


    public function romDeliveryIndex( )
    {


        $kd=delivery1::join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1s.confirmationStatus','unconfirmed')->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);

        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get();


        return view('ROM.newDeliveries',compact('deliveredProducts','kd'));

    }
    public function romDeliveryHistoryIndex( )
    {


        $kd=delivery1::join('users','users.id','=','delivery1s.kd_id')
        ->join('key_distros','key_distros.user_id','=','delivery1s.kd_id')
        ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1s.confirmationStatus','confirmed')->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);

        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get();


        return view('ROM.newDeliveries',compact('deliveredProducts','kd'));

    }


    public function romDeliveryDetails(Request $request )
    {
        $rom_id=$request->delivery1_id;

        $rom=delivery1::join('users','users.id','=','delivery1s.rom_id')
        ->join('roms','roms.user_id','=','delivery1s.rom_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get(['users.firstName','users.middleName'
        ,'users.lastName','delivery1s.*']);

        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.rom_id',auth()->user()->id)->where('delivery1_products.delivery1_id',$rom_id)->get();



        return view('ROM.deliveryDetails',compact('deliveredProducts','rom'));

    }




    public function update(Request $request,)
    {

        $delivery1update = delivery1::where('id',$request->delivery1s_id)->update([
            'confirmationStatus'=>$request->confirm]);

            Alert::toast('delivery Confirmed', 'success');

        return redirect('/romDashboard');
    }

}


