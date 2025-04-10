<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ORDER TRACKING SYSTEM</title>
    <link href="{{ url('css/styles.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


<style>
body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6FjTNtaiuf3PGaAVvVFHYgc6M_tdM24k&callback=initMap&libraries=places&v=weekly"
      async></script>
   <script>
      function initMap() {
         const map = new google.maps.Map(document.getElementById("map"), {
           center: { lat: 40.749933, lng: -73.98633 },
           zoom: 13,
           mapTypeControl: false,
         });
         const card = document.getElementById("pac-card");
         const input = document.getElementById("pac-input");
         const input1 = document.getElementById("pac-role");
         const biasInputElement = document.getElementById("use-location-bias");
         const strictBoundsInputElement = document.getElementById("use-strict-bounds");

         const options = {
           fields: ["formatted_address", "geometry", "name"],
           strictBounds: false,
           types: ["establishment"],
         };

         map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

         const autocomplete = new google.maps.places.Autocomplete(input, options);

         autocomplete.bindTo("bounds", map);

         const infowindow = new google.maps.InfoWindow();
         const infowindowContent = document.getElementById("infowindow-content");

         infowindow.setContent(infowindowContent);

         const marker = new google.maps.Marker({
           map,
           anchorPoint: new google.maps.Point(0, -29),
         });

         autocomplete.addListener("place_changed", () => {
           infowindow.close();
           marker.setVisible(false);

           const place = autocomplete.getPlace();

           if (!place.geometry || !place.geometry.location) {

             window.alert("No details available for input: '" + place.name + "'");
             return;
           }

           // If the place has a geometry, then present it on a map.
           if (place.geometry.viewport) {
             map.fitBounds(place.geometry.viewport);
           } else {
             map.setCenter(place.geometry.location);
             map.setZoom(17);
           }
            $('#pac-role').val(place.geometry.location.lng());
            $('#pac-lan').val(place.geometry.location.lat());

           marker.setPosition(place.geometry.location);
           marker.setVisible(true);
           infowindowContent.children["place-name"].textContent = place.name;
           infowindowContent.children["place-address"].textContent =
             place.formatted_address;
           infowindow.open(map, marker);
         });



       }
       </script>

</head>

    <body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/adminDashboard">Welcome {{ Auth::user()->firstName }} {{ Auth::user()->middleName }}</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

            </form>
            <!-- Navbar-->
            @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <ul class="navbar-nav float-end ">
                          <!-- ============================================================== -->
                          <!-- Comment -->
                          <!-- ============================================================== -->




                          </li>
                          <!-- ============================================================== -->
                          <!-- End Comment -->
                          <!-- ============================================================== -->


                          <!-- ============================================================== -->
                          <!-- User profile and search -->
                          <!-- ============================================================== -->
                          <li class="nav-item dropdown">
                              <a class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  "
                                  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                  aria-expanded="false">
                                  <img src="" alt="{{ Auth::user()->userName }}"
                                      class="rounded-circle" width="31" />

                              </a>
                              <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                  aria-labelledby="navbarDropdown">

                                  <div class="ps-4 p-10">
                                      <li>
                                          <form action="{{ route('logout') }}" method="post">
                                              @csrf
                                              <input class="btn btn-sm btn-success btn-rounded text-white" type="submit"
                                                  value="Logout">
                                          </form>
                                      </li>
                                  </div>
                              </ul>
                          </li>
                          <!-- ============================================================== -->
                          <!-- User profile and search -->
                          <!-- ============================================================== -->
                      </ul>

                        @endguest
        </nav>
        @include('sweetalert::alert')
        <div id="layoutSidenav">
            @include('Sidenavbar.adminSidebar')
  <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Client Registeration</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Fill the form and click submit to complete Client Registeration
                            </div>
                            <div class="card-body">
                            <div class="container rounded bg-white mt-5 mb-5">

                    <div class="row mt-2">
                    <center>
                        <form action="/admin/create/posts" method= "POST" enctype="multipart/form-data"></center>
                    @csrf
                    <div class="col-md-6"><label class="labels">First Name </label>
                        <input type="text" class="form-control" value="" placeholder="" id="firstName" name="firstName"></div>
                        <div class="col-md-6"><label class="labels">Middle Name </label>
                        <input type="text" class="form-control" value="" placeholder="" id="middleName" name="middleName"></div>
                        <div class="col-md-6"><label class="labels">Last Name </label>
                        <input type="text" class="form-control" value="" placeholder="" id="lastName" name="lastName"></div>

                        <div class="col-md-6"><label class="labels">User Name </label>
                        <input type="text" class="form-control" value="" placeholder="e.g: kebede12" id="userName" name="userName"></div>
                        <div class="col-md-6"><label class="labels"> password</label>
                        <input type="password" class="form-control" value="" placeholder="*********" id="password" name="password"></div>
                        <div class="col-md-6">

                        <input type="hidden" class="form-control" value="client" placeholder="" id="userType" name="userType"></div>


                    <div class="col-md-6"> <label class="labels"> Address </label>
        <input type="text" class="form-control floating" name="address" id="pac-input" tabindex="10">
                                         <div id="map">
                                         </div>
                                         <div id="infowindow-content">
                                             <span id="place-name" class="title"></span><br />
                                             <span id="place-address"></span>
                                         </div>
                                         <input name="lng" id="pac-role" type="hidden">
                                         <input name="lat" id="pac-lan" type="hidden"> </div>
     <div class="col-md-6"><label class="labels">Mobile</label>
                        <input type="text" class="form-control" value="" placeholder="Phone number" id="mobile" name="mobile"></div>

                        <div class="col-md-6"><label class="labels">business Name </label>
                        <input type="text" class="form-control" value="" placeholder="business name" id="businessName" name="businessName"></div>
                        <div class="col-md-6"><label class="labels">business type</label>
                        <select id="businessType" name="businessType"  class="form-control">

                        @foreach ( $businessType as $businessType)
  <option value="{{ $businessType->businessName }}"> {{ $businessType->businessName }}
   </option>
    @endforeach
      </select> </div>
      <div class="col-md-6"><label class="labels">business Registeration </label>
                        <input type="text" class="form-control" value="" placeholder="" id="businessRegisteration" name="businessRegisteration"></div>

      <div class="col-md-6"><label class="labels">When was Your Buisness established </label>
                        <input type="text" class="form-control" value="" placeholder="eg: 2002" id="businessEstablishmentYear" name="businessEstablishmentYear"></div>
                        <div class="col-md-6"><label class="labels">Key Distributor</label>
                        <select id="kd" name="kd"  class="form-control">

                            @foreach ( $key_distro as $kd)
                            <option value="{{ $kd->user_id }}"> {{ $kd->firstName }} {{ $kd->middleName }} {{ $kd->lastName }}
                            </option>
                             @endforeach
                         </select>
                        </div>

                         <br>
                        <br><br>

                        <small><input type="submit" class="form-control" value="submit" ></small></div><br>
                        <input type="reset" class="form-control" value="clear" ></div>
                    </form>








                </div>
            </div>

    </div>



                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('js/scripts.js') }}"></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{url ('assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{url ('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{url ('js/datatables-simple-demo.js') }}"></script>
   </body>
</html>
