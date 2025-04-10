<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\product;
use App\Models\ProductCatagory;
use Illuminate\Support\Facades\Auth;

class newProduct extends Controller
{
    //the form for the create product goes here
    public function index(){
        $product_category = ProductCatagory::all();
        return view('',compact('product_category'));
    }
    //create product //performed by each key distrbutor
    public function createProudct()
    {
        return view('');

    }
    public function storeProduct(Request $request,$id)
    {
        $products = product::create([
            'catagory_id' => $id,
            'keyDis_id' => auth()->user()->id,
            'name' => $request->product_name,
            'description' => $request->description,
            'image' => $request->product_image,
        ]);

    }
    //view product foreach key disturbutor
    public function viewProudct(Request $request,$id){
         $products = product::all()->where('keyDis_id',Auth::user()->id())->where('catagory_id',$id);
         return view('',compact('products'));

    }
    //the form for create catagorey goes here
    public function Createcategory(Request $request)
    {
        return view('');
    }
    //the post to create category goes here
    //for image about the category we can use a default image whenever a category is given
    public function StoreCategory(Request $request)
    {
        $prductCatagorey = ProductCatagory::create([
        'categoryName' => $request->catagory_name,
        'description' => $request->description,
        'category_image'=> $request->category_image,
        ]);

    }

}
