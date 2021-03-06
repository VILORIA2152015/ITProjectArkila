<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
      <span class="logo-lg"><b>Ban Trans</b></span>
      <span class="logo-sm"><b>BT</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                </li>
                                <li>
                                    <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                </li>
                                <li>
                                    <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                </li>
                                <li>
                                    <a href="#">
                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                            </a>
                                </li>
                                <li>
                                    <a href="#">
                                                <i class="fa fa-user text-red"></i> You changed your username
                                            </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="{{route('drivermodule.notifications')}}">View all</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
