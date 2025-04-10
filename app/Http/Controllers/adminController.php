<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\client;
use App\Models\user;
use App\Models\key_distro;
use App\Models\businessType;
use App\Models\order;
use App\Models\ProductCatagory;
use App\Models\product;
use App\Models\orderedProducts;
use App\Models\undeliveredOrders;
use App\Models\delivery1Products;
use App\Models\undelivered1Products;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class adminController extends Controller
{

    public function index()
    {
        $client= client::count();
        $users= user::count();
        $kds= key_distro::count();
        $userList= user::get();
        $todaysOrders= order::where('createdDate',today())->count();
        $totalOrders= order::count();

        return view('dashboard.adminDashboard',compact('client','kds','users','todaysOrders','totalOrders'));
    }
    public function newUserList()
    {
        $userList=user::get();
        return view('admin.userList',compact('userList'));
    }


    public function create_client()
    {
        $businessType=businessType::all();
        $key_distro=key_distro::join('users','users.id','=','key_distros.user_id')->get();
        return view('admin.registerClient',compact('businessType','key_distro'));
    }

    public function store_client(Request $request)
    {
        $user = user::create([

            'firstName'=>$request->firstName,
            'middleName'=>$request->middleName,
            'lastName'=> $request->lastName,
            'userName'=> $request->userName,
            'password'=>Hash::make($request['password']),
            'userType'=>$request->userType,
        ]);

           $client= client::create([
            'user_id'=>$user->id,
            'client_address'=> $request->address,
            'client_mobile'=>$request->mobile,
            'client_businessName'=> $request->businessName,
            'client_businessType'=> $request->businessType,
            'client_BusinessRegisteration'=> $request->businessRegisteration,
            'client_mobile'=>$request->mobile,
            'client_latitude'=> $request->lat,
            'client_longtude'=> $request->lng,
            'distro_id'=> $request->kd,
            'client_yearsInBusiness'=>$request->businessEstablishmentYear,
            ]);


        Alert::toast('successfully Registered', 'success');

        return redirect('/adminDashboard');
    }
    public function create_user()
    {

        return view('admin.registerUser');

    }
    public function store_user(Request $request){
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'middleName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'userName' => ['required', 'string', 'max:255','unique:users'],
            'email' => [ 'string', 'email', 'max:255', 'unique:users'],
            'userType' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

         $user = user::create([
            'firstName'=>$request->firstName,
            'middleName'=>$request->middleName,
            'lastName'=> $request->lastName,
            'userName'=> $request->userName,
            'email' => $request->email,
            'password'=>Hash::make($request['password']),
            'userType'=>$request->userType,
            'status'=>$request->status,
        ]);
        Alert::toast('successfully Registered', 'success');

        return redirect('/adminDashboard');
    }
    public function view_clients()
    {
        $client = client::join('users','users.id', '=','clients.user_id')->get();
        $key_distro=key_distro::join('users','users.id','=','key_distros.user_id')->get();
        return view('admin.showClients',compact('client','key_distro'));

    }

    public function orderIndex()
    {
        $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')->where('orders.createdDate',today())->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);
        $kd=order::join('users','users.id','=','orders.KD_id')->
        join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->where('orders.createdBy',auth()->user()->id)->get();

        return view('admin.showOrders',compact('client','kd'));

    }
    public function orderHistory()
    {
        $client=order::join('users','users.id','=','orders.client_id')
        ->join('clients','clients.user_id','=','orders.client_id')->get(['users.firstName','users.middleName'
        ,'users.lastName','orders.id','orders.createdDate','orders.deliveryStatus']);

        $kd=order::join('users','users.id','=','orders.KD_id')->
        join('key_distros','key_distros.user_id','=','orders.KD_id')
        ->where('orders.createdBy',auth()->user()->id)->get();

        return view('admin.showOrders',compact('client','kd'));

    }
    public function undeliveredIndex( )
    {
       $rom=undeliveredOrders::join('users','users.id','=','undelivered_orders.rom_id')
        ->join('roms','roms.user_id','=','undelivered_orders.rom_id')->get(['users.firstName','users.middleName'
        ,'users.lastName','undelivered_orders.*'])->sortDesc();

        $deliveredProducts=delivery1Products::join('delivery1s','delivery1s.id','=','delivery1_products.delivery1_id')
        ->join('products','products.id','=','delivery1_products.product_id')
        ->where('delivery1s.kd_id',auth()->user()->id)->get();
        return view('admin.undeliveredOrders',compact('deliveredProducts','rom'));

    }
    public function undeliveredDetails(Request $request)
    {
        $rom_id=$request->delivery1_id;
        $deliveredProducts=undelivered1Products::join('undelivered_orders','undelivered_orders.id','=','undelivered1_products.undelivered1_id')
        ->join('products','products.id','=','undelivered1_products.product_id')
        ->where('undelivered1_products.undelivered1_id',$rom_id)->get();
        return view('admin.undeliveredDetails',compact('deliveredProducts'));

    }
    //view category
    public function ViewCatagory(Request $request)
    {
        $product_catagorey = ProductCatagory::all();
        return view('admin.viewCatagories',compact('product_catagorey'));
    }
    //edit category
    public function editCatagory(Request $request,$id)
    {
        $product_catagorey = ProductCatagory::find($id);
        return view('admin.editProductCatagory',compact('product_catagorey'));
    }
    //store category
    public function storeEditedCatagory(Request $request, $id)
    {
        $product_catagorey = ProductCatagory::find($id);
        $product_catagorey->catagoryName = $request->product_catagory_name;
        $product_catagorey->category_image = $request->category_image;
        $product_catagorey->description = $request->description;
        $product_catagorey->save();
    }
    //new category
    public function newCategory()
    {
        return view('admin.addCatagory');

    }
    //store category
    public function storeCategory(Request $request)
    {
        $product_catagorey = ProductCatagory::create
        ([
        'catagoryName' => $request->product_catagory_name,
        'category_image' => $request->category_image,
        'description' => $request->description,

        ]);
    }
    //view products per each category
    public function viewProducts(Request $request, $id)
    {
        $products = product::where('catagory_id',$id);
        return view('',compact('products'));
    }
    //add products
    public function addProducts(Request $request,$id)
    {
        $key_distro = key_distro::join('users','users.id','=','key_distros.user_id')->get();
        $product_catagorey = ProductCatagory::find($id);
        return view('admin.addProducts',compact('product_catagorey','key_distro'));
    }
    //store products
    public function storeProducts(Request $request,$id)
    {
        $products = product::create([
            'catagory_id' => $id,
            'keyDis_id' => $request->key_dist,
            'name' => $request->product_name,
            'description' => $request->description,
            'image' => $request->product_image,
            ]);
    }

}
