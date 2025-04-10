
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Order Tracking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
 $(function(){
  $("#client").select2();
 });
</script>
</head>
<body>
@extends('layout.cartHeader')
@include('sweetalert::alert')
@section('content')
@include('sweetalert::alert')
<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h1>Cart List </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                  <tr>

                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Unit Price</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">sub-Total </th>
                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($cartItems as $item)
                  <tr>
                    <td class="p-4">
                      <div class="media align-items-center">
                        <img src="" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                        <div class="media-body">
                          <a href="#" class="d-block text-dark">{{$item->name}}</a>
                          <small>


                            <span class="text-muted">description: </span> {{$item->attributes->description}}
                          </small>
                        </div>
                      </div>
                    </td>
                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->price}} br</td>
                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->quantity}}"></td>
                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->attributes->subtotal}} birr</td>
                    <td class="hidden text-right md:table-cell">
                                <form action="{{ '/orderRemove'}}" method="POST">
                                  @csrf
                                  <input type="hidden" value="{{ $item->id }}" name="id">
                                  <button class="px-4 py-2 text-white bg-red-600">x</button>
                              </form>

                              </td>
                </tr>

                 @endforeach
                </tbody>
              </table>
            </div>
            <!-- / Shopping cart table -->

            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="mt-4">
                             </div>
              <div class="d-flex">





                <div class="text-right mt-4">

                  <div class="text-large"><strong>Total Price: {{ Cart::getTotal() }} br</strong></div>
                </div>
              </div>
            </div>

            <div class="float-right">
            <br>
              <form action="{{ ('/order/post/create') }}" method="POST">
                            @csrf

                            <input type="hidden" value="{{ Cart::getTotal() }}" name="total">

                            <label>Who are you ordering for:</label> <br>
                            <select id="client" name="client"  class="form-control">

                            @foreach ( $clients as $client)
                            <option value="{{ $client->user_id}}|{{$client->distro_id}}" > {{ $client->firstName }} {{ $client->middleName }} {{ $client->lastName }}
                            </option>      @endforeach




                               </select><br>


              <button type="submit" class="btn btn-lg btn-primary mt-2">Checkout</button>
                </form>
                <form action="{{'/orderClear'}}" method="POST">
                            @csrf
              <button type="submit" class="btn btn-lg btn-primary mt-2">clear all</button>
              </form>

            </div>

          </div>
      </div>
  </div>
  @endsection
<style type="text/css">
body{
    margin-top:20px;
    background:#eee;
}
.ui-w-40 {
    width: 40px !important;
    height: auto;
}

.card{
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
}

.ui-product-color {
    display: inline-block;
    overflow: hidden;
    margin: .144em;
    width: .875rem;
    height: .875rem;
    border-radius: 10rem;
    -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    vertical-align: middle;
}
</style>

<script type="text/javascript">

</script>
</body>
</html>
