<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\user;
use App\Models\client;
use App\Models\ProductCatagory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function ProductCatagoryList(Request $request)
    {
        $productsCatagories = ProductCatagory::all();
        return view('orderCart.product_catagory_list', compact('productsCatagories'));   
    }
    public function productList(Request $request)
    {
        $product_catagoryID = $request->prouductCatagory_id;
        $products = Product::all()->where('catagory_id',$product_catagoryID);
        $client_id=$request->client_id;
        return view('orderCart.productList', compact('products','client_id'));
    }
    public function cartList()
    {
        $clients=client::join('users','users.id','=','clients.user_id') ->where
        ('users.userType','client')->get(['firstName','middleName','lastName','user_id','distro_id']);
        
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('orderCart.cart', compact('cartItems','clients'));
    }


    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            
            'attributes' => array(
                'image' => $request->image,
           'subtotal'=>$request->price*$request->quantity,
        'description'=>$request->description,
         )
        ]);
        Alert::toast('product added to cart', 'success');

        return redirect('/productList');
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

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        Alert::toast('Item removed', 'success');
        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        Alert::toast('All Items Removed', 'success');


        return redirect()->route('cart.list');
    }



   
}



