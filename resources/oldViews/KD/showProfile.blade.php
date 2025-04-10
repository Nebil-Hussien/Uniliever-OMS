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
<link href="css/styles.css" rel="stylesheet" />
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
    </head>
   
    <body class="sb-nav-fixed">
    
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/key_distroDashboard">{{ Auth::user()->firstName }} {{ Auth::user()->middleName }}</a>
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
                                  @if (auth()->user()->key_distro == Null)
                                  <a class="dropdown-item" href="/key_distro/create/post"><i
                                    class="mdi mdi-settings me-1 ms-1"></i> Set-Up Account</a>
                                  @else
                                  
                                    <a class="dropdown-item" href="/key_distroProfile/show"><i
                                        class="mdi mdi-account me-1 ms-1"></i> My Profile</a>
                                  @endif
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
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="/key_distroDashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                               Profile
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/key_distroProfile/show">show profile</a>
                                    <a class="nav-link" href="/key_distro/update/edit">update profile</a>
                                    
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#"  aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              clients
                                
                            </a>
                            
                            
                            
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                              orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="/kdshowOrders">New Orders</a>
                                    <a class="nav-link" href="/orderHistory">order histroy</a>
                                    
                                    
                                </nav>
                                
                            </div>
                            <a class="nav-link collapsed" href="/handoverHistory"  aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Handover List
                        
                            </a>
                            <div class="sb-sidenav-menu-heading">Product Stocks</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                               Add new Product stock
                            </a>
                            <a class="nav-link" href="products/view">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                              view Product stocks
                            </a>
                       </div>
                    </div>
                   
                </nav>
            </div>
           
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">My Profile</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               
                            </div>
                            <div class="card-body">
                            <div class="container rounded bg-white mt-5 mb-5">
                                
                    <div class="row mt-2">
                    @foreach($kdProfile as $profile)
                    <div class="col-md-6"><label class="labels">First Name</label>
                        <p class="form-control">{{ $profile->firstName }}</p></div>
                        <div class="col-md-6"><label class="labels">Middle Name</label>
                        <p class="form-control" >{{$profile->middleName}}</p></div>
                        <div class="col-md-6"><label class="labels">Last Name</label>
                        <p class="form-control">{{$profile->lastName}}</p></div>
                        <div class="col-md-6"><label class="labels">User Name</label>
                        <p class="form-control" >{{$profile->userName}}</p></div>
                        

                        <div class="col-md-6"><label class="labels">Email</label>
                        <p class="form-control">{{$profile->email}}</p></div>
                        <div class="col-md-6"><label class="labels">Resident Address</label>
                        <p class="form-control" >{{$profile->address}}</p></div>
                        

                        <div class="col-md-6"><label class="labels">Phone Number</label>
                        <p class="form-control">{{$profile->mobile}}</p></div>
                        <div class="col-md-6"><label class="labels">ID type</label>
                        <p class="form-control" >{{$profile->ID_type}}</p></div>
                        

                        <div class="col-md-6"><label class="labels">ID number</label>
                        <p class="form-control">{{$profile->ID_number}}</p></div>
                        <div class="col-md-6"><label class="labels">ID issue date</label>
                        <p class="form-control" >{{$profile->ID_issue_date}}</p></div>
                        <div class="col-md-6"><label class="labels">ID expiry date</label>
                        <p class="form-control">{{$profile->ID_expiry_date}}</p></div>
                        <div class="col-md-6"><label class="labels">Business Name</label>
                        <p class="form-control" >{{$profile->businessName}}</p></div>
                        

                        <div class="col-md-6"><label class="labels">Buisness Type</label>
                        <p class="form-control">{{$profile->businessType}}</p></div>
                        <div class="col-md-6"><label class="labels">Busienss Address</label>
                        <p class="form-control" >{{$profile->businessAddress}}</p></div>
                        

                        <div class="col-md-6"><label class="labels">Buisness Licence Number</label>
                        <p class="form-control">{{$profile->licenceNumber}}</p></div>
                        <div class="col-md-6"><label class="labels">issue date</label>
                        <p class="form-control" >{{$profile->issueDate}}</p></div>
                        <div class="col-md-6"><label class="labels">expiry date</label>
                        <p class="form-control">{{$profile->expiryDate}}</p></div>
                        <div class="col-md-6"><label class="labels">Tin Number</label>
                        <p class="form-control" >{{$profile->tinNumber}}</p></div>
                        <div class="col-md-6"><label class="labels">Business establishment year</label>
                        <p class="form-control" >{{$profile->businessEstablishmentYear}}</p></div>
                        @endforeach
                        

                        

                        



                

                    

                    
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
