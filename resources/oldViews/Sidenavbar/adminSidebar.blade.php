<div id="layoutSidenav_nav">
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="/adminDashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                             Clients
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/admin/create/clients">Register Clients</a>
                                    <a class="nav-link" href="/admin/view/clients">Client List</a>

                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                          Users
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="/admin/create/user">New users</a>
                                    <a class="nav-link" href="/newUserList">User List</a>


                                </nav>
                            </div>
                        <div class="sb-sidenav-menu-heading">Orders</div>
                            <a class="nav-link" href="/todaysOrders">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                               Today's Orders
                            </a>
                            <a class="nav-link" href="/adminOrderHistory">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                             Order History
                            </a>
                            <a class="nav-link" href="/adminUndeliveredOrders">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                              Undelivered Orders
                            </a>
                            <div class="sb-sidenav-menu-heading">Products</div>
                                <a class="nav-link" href="/admin/new/category">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Create Category
                            </a>
                            <a class="nav-link" href="/admin/viewCategory">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            view Category
                            </a>



                        </div>
                    </div>

                </nav>
            </div>
