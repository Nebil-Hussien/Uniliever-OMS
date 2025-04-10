<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderedProducts;
use App\Models\user;
use App\Models\client;
use App\Models\rsp;
use RealRashid\SweetAlert\Facades\Alert;

class delivery2cartController extends Controller
{
    public function productList()
    {
        $products = Product::all();

        return view('orderCart.productList', compact('products'));
    }




    public function cartList()
    {
       $cartItems = \Cart::getContent();
        // dd($cartItems);
        $rsp=rsp::join('users','users.id','=','rsps.user_id')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','rsps.user_id']);
        
        return view('ROM.deliveryCartList', compact('cartItems','rsp'));
    }


    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'subtotal'=>$request->subTotal,
       
            'attributes' => array(
                'image' => $request->image,
                'description'=>$request->description,
        'recieved_quantity'=>$request->delivered_quantity,
        'order_id'=>$request->order_id,
        'delivery1_id'=>$request->delivery1_id,
        'subtotal'=>$request->price*$request->quantity,
            )
        ]);
        Alert::toast('product added to delivery cart', 'success');
        

        return redirect()->route('delivery2Cart.list');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('delivery2cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        Alert::toast('Item removed', 'success');
        return redirect()->route('delivery2Cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        Alert::toast('All Items Removed', 'success');


        return redirect()->route('delivery2Cart.list');
    }


}
