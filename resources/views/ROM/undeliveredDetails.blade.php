
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
</head>
<body>

@include('sweetalert::alert')

<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h1>Remaining Products Details </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>

                    <th class="text-center py-3 px-4" style="width: 120px;">Undelivered Quantity</th>

                    </tr>
                </thead>
                <tbody>
                @foreach ($undeliveredProducts as $item)
                  <tr>
                    <td class="p-4">
                      <div class="media align-items-center">
                        <img src="" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                        <div class="media-body">
                          <a href="#" class="d-block text-dark">{{$item->name}}</a>
                          <small>


                            <span class="text-muted">description: </span> {{$item->description}}
                          </small>
                        </div>
                      </div>
                    </td>

                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->undelivered_quantity}}" readonly></td>

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

                   </div>
              </div>
            </div>

            <div class="float-right">


                <form action="/handover1" method="POST">
              @csrf

                    <input type="hidden" value="{{$item->order_id}}" name="order_id">
                            <input type="hidden" value="confirmed" name="confirm">
              <button type="submit" class="btn btn-lg btn-primary mt-2">handover</button>
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
