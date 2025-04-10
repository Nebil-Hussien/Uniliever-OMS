<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\deliverycartController;
use App\Http\Controllers\delivery2cartController;
use App\Http\Controllers\newProduct;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('/', function () {
  //  return redirect('/en');
//});


  Route::get('/', function () {
    return view('welcome');
      });
 Auth::routes();

  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



/*
Route::get('/client_dash', function (){
    return view('dashboard.clientDashboard');
});
Route::get('/kd_dash', function (){
    return view('dashboard.kdDashboard');
});
Route::get('/rsp_dash', function (){
    return view('dashboard.rspDashboard');
});
Route::get('/rom_dash', function (){
    return view('dashboard.romDashboard');
});
Route::get('/agent_dash', function (){
    return view('dashboard.agentDashboard');
});

Route::get('/showOrders', function (){
    return view('KD.showOrders');
});
*/

//Route::resource('/restorePage',[\App\Http\Controllers\clientController::class, 'restore']);

Route::middleware(['auth','verified'])->group(function(){

  //admin controler
  Route::get('/adminDashboard', [\App\Http\Controllers\adminController::class, 'index']);
  Route::get('/admin/create/clients', [\App\Http\Controllers\adminController::class, 'create_client']);
  Route::post('/admin/create/posts', [\App\Http\Controllers\adminController::class, 'store_client']);
  Route::get('/admin/view/clients', [\App\Http\Controllers\adminController::class, 'view_clients']);
  Route::get('/newUserList', [\App\Http\Controllers\adminController::class, 'newUserList']);
  Route::get('/admin/create/user',[\App\Http\Controllers\adminController::class, 'create_user']);
  Route::post('/admin/create/user/post',[\App\Http\Controllers\adminController::class, 'store_user']);
  Route::get('/todaysOrders', [\App\Http\Controllers\adminController::class, 'orderIndex']);
  Route::get('/adminOrderHistory', [\App\Http\Controllers\adminController::class, 'orderHistory']);
  Route::get('/adminUndeliveredOrders', [\App\Http\Controllers\adminController::class, 'undeliveredIndex']);
  Route::post('/adminUndeliveredDetails', [\App\Http\Controllers\adminController::class, 'undeliveredDetails']);
  Route::get('/admin/viewCategory', [\App\Http\Controllers\adminController::class, 'ViewCatagory']);
  Route::get('/admin/editCategory', [\App\Http\Controllers\adminController::class , 'editCatagory']);
  Route::post('/admin/editCategory/store', [\App\Http\Controllers\adminController::class , 'storeEditedCatagory']);
  Route::get('/admin/new/category',[\App\Http\Controllers\adminController::class , 'newCategory']);
  Route::post('/admin/StoreCategory', [\App\Http\Controllers\adminController::class, 'storeCategory']);
  Route::get(('/admin/{$id}/view/products'), [\App\Http\Controllers\adminController::class, 'viewProducts']);
  Route::get('/admin/{$id}/add/products', [\App\Http\Controllers\adminController::class, 'addProducts']);
  Route::post(('/admin/store/products'), [\App\Http\Controllers\adminController::class, 'storeProducts']);





/*
//client and clientProfile controller routes
Route::get('/client/create/post', [\App\Http\Controllers\clientController::class, 'create']);
Route::post('/client/create/posts', [\App\Http\Controllers\clientController::class, 'store']);
Route::get('/client/update/edit', [\App\Http\Controllers\clientProfileController::class, 'edit']); //shows edit post form
Route::put('/client/update/edits', [\App\Http\Controllers\clientProfileController::class, 'update']);
Route::get('/clientProfile/{client}', [\App\Http\Controllers\clientProfileController::class, 'show']);
*/
//key distributor profile controller routes
Route::get('/key_distroDashboard', [\App\Http\Controllers\key_distroDashboardController::class, 'index']);
Route::get('/key_distro/create/post', [\App\Http\Controllers\key_distroProfileController::class, 'create']);
Route::post('/key_distros/create/posts', [\App\Http\Controllers\key_distroProfileController::class, 'store']);
Route::get('/key_distro/update/edit', [\App\Http\Controllers\key_distroProfileController::class, 'edit']); //shows edit post form
Route::put('/key_distro/update/edits', [\App\Http\Controllers\key_distroProfileController::class, 'update']);
Route::get('/key_distroProfile/{key_distro}', [\App\Http\Controllers\key_distroProfileController::class, 'show']);
Route::get('/kdshowOrders', [\App\Http\Controllers\orderedProductsController::class, 'kdView']);
Route::get('/orderHistory', [\App\Http\Controllers\orderedProductsController::class, 'orderHistory']);
Route::get('/handoverHistory', [\App\Http\Controllers\handoverController::class, 'kdHandoverIndex']);
Route::post('/handoverDetails', [\App\Http\Controllers\handoverController::class, 'kdHandoverDetails']);
Route::get('/undeliveredOrders', [\App\Http\Controllers\handoverController::class, 'kdUndeliveredIndex']);
Route::post('/undeliveredDetails', [\App\Http\Controllers\handoverController::class, 'kdUndeliveredDetails']);


//rom profile controller routes
Route::get('/romDashboard', [\App\Http\Controllers\romProfileController::class, 'index']);
Route::get('/rom/create/post', [\App\Http\Controllers\romProfileController::class, 'create']);
Route::post('/rom/create/posts', [\App\Http\Controllers\romprofileController::class, 'store']);
Route::get('/romProfile/{rom}', [\App\Http\Controllers\romProfileController::class, 'show']);
Route::get('/rom/update/edit', [\App\Http\Controllers\romProfileController::class, 'edit']); //shows edit post form
Route::put('/rom/update/edits', [\App\Http\Controllers\romProfileController::class, 'update']);
Route::get('/handover2History', [\App\Http\Controllers\handover2Controller::class, 'romHandoverIndex']);
Route::post('/handover2Details', [\App\Http\Controllers\handover2Controller::class, 'romHandoverDetails']);
Route::get('/romUndeliveredOrders', [\App\Http\Controllers\handover2Controller::class, 'romUndeliveredIndex']);
Route::post('/romUndeliveredDetails', [\App\Http\Controllers\handover2Controller::class, 'romUndeliveredDetails']);




Route::get('/newDeliveries', [\App\Http\Controllers\handoverController::class, 'romDeliveryIndex']);
Route::post('/romDeliveryDetails', [\App\Http\Controllers\handoverController::class, 'romDeliveryDetails']);
Route::get('/DeliveryHistory', [\App\Http\Controllers\handoverController::class, 'romDeliveryHistoryIndex']);
//rsp profile controller routes
Route::get('/rspDashboard', [\App\Http\Controllers\rspProfileController::class, 'index']);
Route::get('/rsp/create/post', [\App\Http\Controllers\rspProfileController::class, 'create']);
Route::post('/rsp/create/posts', [\App\Http\Controllers\rspprofileController::class, 'store']);
Route::get('/rspProfile/{rom}', [\App\Http\Controllers\rspProfileController::class, 'show']);
Route::get('/rsp/update/edit', [\App\Http\Controllers\rspProfileController::class, 'edit']); //shows edit post form
Route::put('/rsp/update/edits', [\App\Http\Controllers\rspProfileController::class, 'update']);

Route::get('/rspnewDeliveries', [\App\Http\Controllers\handover2Controller::class, 'rspDeliveryIndex']);
Route::post('/rspDeliveryDetails', [\App\Http\Controllers\handover2Controller::class, 'rspDeliveryDetails']);




//agent profile controller routes
Route::get('/agentDashboard', [\App\Http\Controllers\agentProfileController::class, 'index']);
Route::get('/agent/create/post', [\App\Http\Controllers\agentProfileController::class, 'create']);
Route::post('/agent/create/posts', [\App\Http\Controllers\agentprofileController::class, 'store']);
Route::get('/agentProfile/{rom}', [\App\Http\Controllers\agentProfileController::class, 'show']);
Route::get('/agent/update/edit', [\App\Http\Controllers\agentProfileController::class, 'edit']); //shows edit post form
Route::put('/agent/update/edits', [\App\Http\Controllers\agentProfileController::class, 'update']);

Route::get('/delivery3', [\App\Http\Controllers\delivery3Controller::class, 'deliveryToClient']);

//order controller routes routes
Route::get('/productList', [CartController::class, 'productList'])->name('products.list');
Route::get('/productCatagoryList', [CartController::class, 'ProductCatagoryList'])->name('productsCatagory.list');

Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/orderRemove', [\App\Http\Controllers\CartController::class, 'removeCart']);
Route::post('/orderClear', [\App\Http\Controllers\CartController::class, 'clearAllCart']);

/*
Route::post('clear', [CartController::class, 'clearAllCart'])->name('orderCart.clear');

Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
*/
Route::post('/order/post/create', [\App\Http\Controllers\orderedProductsController::class, 'store']);
Route::get('/showOrders', [\App\Http\Controllers\orderedProductsController::class, 'index']);

Route::post('/orderDetails', [\App\Http\Controllers\orderedProductsController::class, 'orderDetails']);
Route::put('/confirmOrder/update/edit', [\App\Http\Controllers\orderedProductsController::class, 'update']);

Route::put('/confirmDelivery/update/edit', [\App\Http\Controllers\handoverController::class, 'update']);
Route::put('/confirmDelivery2/update/edit', [\App\Http\Controllers\handover2Controller::class, 'update']);

//handover controller
Route::post('/handover1', [\App\Http\Controllers\handoverController::class, 'handover1']);
Route::post('/handover1/post/create', [\App\Http\Controllers\handoverController::class, 'store']);
Route::post('/handover2', [\App\Http\Controllers\handover2Controller::class, 'handover2']);
Route::post('/handover2/post/create', [\App\Http\Controllers\handover2Controller::class, 'store']);

Route::get('deliveryCartList', [deliverycartController::class, 'cartList'])->name('deliveryCart.list');
Route::post('deliveryCartCreate', [deliverycartController::class, 'addToCart'])->name('deliveryCart.store');
Route::get('delivery2CartList', [delivery2cartController::class, 'cartList'])->name('delivery2Cart.list');
Route::post('delivery2CartCreate', [delivery2cartController::class, 'addToCart'])->name('delivery2Cart.store');


Route::post('update-cart', [deliverycartController::class, 'updateCart'])->name('deliveryCart.update');
Route::post('/delivery1Remove', [\App\Http\Controllers\deliverycartController::class, 'removeCart']);
Route::post('/delivery1clear', [\App\Http\Controllers\deliverycartartController::class, 'clearAllCart']);
Route::post('clear', [deliverycartController::class, 'clearAllCart'])->name('deliveryCart.clear');
Route::post('remove', [delivery2cartController::class, 'removeCart'])->name('delivery2Cart.remove');
Route::post('clear', [delivery2cartController::class, 'clearAllCart'])->name('delivery2Cart.clear');

Route::post('/order/post/create', [\App\Http\Controllers\orderedProductsController::class, 'store']);
Route::get('/showOrders', [\App\Http\Controllers\orderedProductsController::class, 'index']);

Route::get('/view/category', [\App\Http\Controllers\orderedProductsController::class, 'index']);
Route::get('/create/Category',[\App\Http\Controllers\newProduct::class, 'Createcategory']);
Route::post('/create/categorey/post', [\App\Http\Controllers\newProduct::class, 'StoreCategory']);
Route::get('/view/{$id}/proudcts', [\App\Http\Controllers\newProduct::class, 'viewProudct']);
Route::get('products/add',[\App\Http\Controllers\newProduct::class, 'createProudct']);
Route::post('products/add/post',[\App\Http\Controllers\newProduct::class, 'storeProduct']);
});



