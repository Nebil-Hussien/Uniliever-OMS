
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Order Tracking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
@include('sweetalert::alert')
<div  class="bg-white">
        <header>
            <div class="container px-6 py-3 mx-auto">
                <div class="flex items-center justify-between">


                    <div class="flex items-center justify-end w-full">
                        <button" class="mx-4 text-gray-600 focus:outline-none sm:mx-0">

                        </button>
                    </div>
                </div>
                <nav  class="p-6 mt-4 text-white bg-black sm:flex sm:justify-center sm:items-center">
                    <div class="flex flex-col sm:flex-row">
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="/romDashboard">Home</a>

                        <form action="/handover2" method="POST">
              @csrf

              @foreach ($cartItems as $item)
                            <input type="hidden" value="{{ $item->attributes->delivery1_id}}" name="delivery1_id">
                            @endforeach
              <button type="submit" class="mt-3 hover:underline sm:mx-3 sm:mt-0">Rom handover List</button>
                </form>


                        <a href="{{ route('delivery2Cart.list') }}" class="flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ Cart::getTotalQuantity()}}
                        </a>

                    </div>
                </nav>
            </div>
        </header>

        <main class="my-8">
            @yield('content')
        </main>

    </div>
<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h1>Delivery List </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Unit Price</th>

                    <th class="text-center py-3 px-4" style="width: 120px;">Recieved Quantity</th>

                    <th class="text-right py-3 px-4" style="width: 100px;"> Delivery Quantity</th>
                    <th class="text-right py-3 px-4" style="width: 100px;"> Delivered sub-total</th>
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
                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->attributes->recieved_quantity}} </td>

                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->quantity}}" readonly></td>
                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->attributes->subtotal}} birr</td>

                    <td class="hidden text-right md:table-cell">
                                <form action="{{ route('delivery2Cart.remove') }}" method="POST">
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
                           <form action="{{ ('/handover2/post/create') }}" method="POST">
                            @csrf

                            <input type="text" value="{{ Cart::getTotal() }}" name="total">
                            @foreach ($cartItems as $item)
                            <input type="hidden" value="{{ $item->attributes->order_id}}" name="order_id">
                            @endforeach

                            <label>Select RSP:</label>
                            <select id="rsp" name="rsp"  class="form-control">

                            @foreach ( $rsp as $rsp)
                            <option value="{{ $rsp->user_id }}" > {{ $rsp->firstName }} {{ $rsp->middleName }} {{ $rsp->lastName }}
                            </option>      @endforeach




                               </select>






                                  <button type="submit" class="btn btn-lg btn-primary mt-2">confirm handover</button>
                                </form>


            </div>

          </div>
      </div>
  </div>

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
