<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand me-auto" href="#">Logo</a>        
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Logo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2 {{Request::path() == '/' ? 'active' : '';}}" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2 {{Request::path() == 'tours' ? 'active' : '';}}" href="/tours">Tours</a>
                    </li>            
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2 {{Request::path() == 'rentals' ? 'active' : '';}}" href="/rentals">Rentals</a>
                    </li>            
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2 {{Request::path() == 'about_us' ? 'active' : '';}}" href="/about_us">About Us</a>
                    </li>
                    <li class="nav-item">
                        <div class="notif">
                            <a href="/purchase" class="fs-5 nav-link mx-lg-2 {{Request::path() == 'purchase' ? 'active' : '';}}">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                            @if ($count)
                                <div class="circle">{{$count}}</div>
                            @endif
                        </div>
                    </li>
                </ul>            
            </div>
        </div>
        <a class="register-button" href="#">Register</a>
        <button type="button" class="login-button" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</button>
        <button class="navbar-toggler p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>