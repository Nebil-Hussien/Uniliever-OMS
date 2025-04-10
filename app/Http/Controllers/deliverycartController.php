<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderedProducts;
use App\Models\user;
use App\Models\client;
use App\Models\rom;
use RealRashid\SweetAlert\Facades\Alert;
class deliverycartController extends Controller
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
        $rom=rom::join('users','users.id','=','roms.user_id')
        ->get(['users.firstName','users.middleName'
        ,'users.lastName','roms.user_id']);
        
        return view('KD.deliveryCartList', compact('cartItems','rom'));
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
        'ordered_quantity'=>$request->ordered_quantity,
        'order_id'=>$request->order_id,
        'subtotal'=>$request->price*$request->quantity,
            )
        ]);
        Alert::toast('product added to delivery cart', 'success');
        

        return redirect()->route('deliveryCart.list');
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

        return redirect()->route('deliverycart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        Alert::toast('Item removed', 'success');
        return redirect()->route('deliveryCart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        Alert::toast('All Items Removed', 'success');


        return redirect()->route('deliveryCart.list');
    }



  
}
