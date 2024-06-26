<nav class="navbar cust-nav navbar-expand-lg fixed-top position-relative">
    <div class="container-fluid items-path">
        @foreach ($navLogo as $x)
            <div class="logo-path position-absolute">
                <img src="{{asset('storage/company/'. $x->secondary_logo)}}" alt="">
            </div>
        @endforeach
        <div class="triangle-right"></div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">OJEK TRIP INDONESIA</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                    @auth
                        <li class="nav-item nav-user-icon1">                            
                            <div class="dropdown">
                                <button class="btn dropdown-toggle user-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i><img src="{{asset('storage/user/'. Auth::user()->profile_photo)}}" class="rounded-circle" alt=""></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <button class="dropdown-item" type="button">
                                        <a href="/profile" class="profile"><i class="fa-solid fa-user"></i> Profile</a>                        
                                    </button>
                                    <form action="/memberLogout" method="GET">
                                        @csrf
                                        <button type="submit" class="dropdown-item memberLogout" type="button">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                            Logout
                                        </button>
                                    </form>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item  log-reg-button1">                            
                            <button type="button" class="login-button" id="loginModal">Login</button>
                            <button type="button" class="register-button" id="registerModal">Register</button>
                        </li>
                    @endauth
                    @auth
                        <li class="nav-item">
                            <a class="nav-link user-nav mx-lg-2 {{Request::path() == '/home' ? 'active' : '';}}" aria-current="page" href="/home">Home</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link user-nav mx-lg-2 {{Request::path() == '/' ? 'active' : '';}}" aria-current="page" href="/">Home</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link user-nav mx-lg-2 {{Request::path() == 'tours' ? 'active' : '';}}" href="/tours">Tours</a>
                    </li>            
                    <li class="nav-item">
                        <a class="nav-link user-nav mx-lg-2 {{Request::path() == 'contacts' ? 'active' : '';}}" href="/contacts">Contact Us</a>
                    </li>            
                    {{-- <li class="nav-item">
                        <a class="nav-link user-nav mx-lg-2 {{Request::path() == 'rentals' ? 'active' : '';}}" href="/rentals">Rentals</a>
                    </li>             --}}
                    <li class="nav-item">
                        <a class="nav-link user-nav mx-lg-2 {{Request::path() == 'about_us' ? 'active' : '';}}" href="/about_us">About Us</a>
                    </li>
                    <li class="nav-item">
                        <div class="notif">
                            @auth                                
                                <a href="/checkOut" class="fs-5 nav-link user-nav mx-lg-2 checkOut {{Request::path() == 'checkOut' ? 'active' : '';}}">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>                                
                                @if ($count)
                                    <div class="circle">{{$count}}</div>
                                @endif
                            @endauth
                        </div>
                    </li>
                </ul>            
            </div>
        </div>
        @auth
            <div class="dropdown nav-user-icon2">
                <button class="btn dropdown-toggle user-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i><img src="{{asset('storage/user/'. Auth::user()->profile_photo)}}" class="rounded-circle" alt=""></i>
                </button>
                <ul class="dropdown-menu">
                    <button class="dropdown-item" type="button">
                        <a href="/profile" class="profile"><i class="fa-solid fa-user"></i> Profile</a>                        
                    </button>
                    <form action="/memberLogout" method="GET">
                        @csrf
                        <button type="submit" class="dropdown-item memberLogout" type="button">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>
                </ul>
            </div>
        @else
            <div class="log-reg-button2">
                <button type="button" class="register-button" id="registerModal">Register</button>
                <button type="button" class="login-button" id="loginModal">Login</button>
            </div>
        @endauth
        <button class="navbar-toggler p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
    <div class="showRegisterModal" style="display: none"></div>
    <div class="showLoginModal" style="display: none"></div>

<script>
    $('.register-button').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{route('registerForm')}}',
                success: function (response) {
                    $('.showRegisterModal').html(response).show();
                    $('#memberRegisterModal').modal('show');
                }
            });
        });
    $('.login-button').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{route('loginForm')}}',
                success: function (response) {
                    $('.showLoginModal').html(response).show();
                    $('#memberLoginModal').modal('show');
                }
            });
        });
        $('.memberLogout').click(function(e) {
            e.preventDefault();            
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, logout!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url : '{{route('memberLogout')}}',
                    success: function (response) {
                        location.replace('/');
                    }
                });
                }
            });
        })
</script>