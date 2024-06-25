<div class="sidebar" id="side-nav">
    <div class="sidebar-items">
        <div class="header-box logo-box pl-2 pt-3 pb-4 d-flex justify-content-between">
            @foreach ($sideLogo as $s)
                <div class="sidebar-logo">
                    <img src="{{asset('storage/company/'. $s->primary_logo)}}" alt="">
                </div>
            @endforeach
            <div class="d-inline-block compName">
                <h1 class="fs-4 text-white">OJEK TRIP INDONESIA</h1>
            </div>
            <div>
                <button class="btn d-md-none d-block close-btn px-1 pt-0 pl-2 text-white"><li class="fa-solid fa-xmark"></li></button>
            </div>
        </div>
        <ul class="list-unstyled px-2 side-menu">
            <li class="mb-2 {{Request::path() == 'admin/dashboard' ? 'bg-info' : '';}}">
                <a href="/admin/dashboard" class="text-decoration-none px-3 py-2 d-block d-flex gap-3">
                    <span class="material-icons">dashboard</span>Dashboard
                    @if ($dashNotif)
                        <span class="py-0 px-2 text-center" style="width:35px; border-radius: 20px; background-color: red;">{{$dashNotif}}</span>
                    @endif
                </a>
            </li>
            <li class="mb-2 {{Request::path() == 'admin/product' ? 'bg-info' : '';}}"><a href="/admin/product" class="text-decoration-none px-3 py-2 d-block d-flex gap-3"><span class="material-icons">inventory</span><span>Product</span></a></li>
            <li class="mb-2 {{Request::path() == 'admin/user' ? 'bg-info' : '';}}"><a href="/admin/user" class="text-decoration-none px-3 py-2 d-block d-flex gap-3"><span class="material-icons">people_alt</span>User</a></li>
            <li class="mb-2 {{Request::path() == 'admin/order' ? 'bg-info' : '';}}"><a href="/admin/order" class="text-decoration-none px-3 py-2 d-block d-flex gap-3"><span class="material-icons">list_alt</span>Order</a></li>
            <li class="mb-2 {{Request::path() == 'admin/transaction' ? 'bg-info' : '';}}"><a href="/admin/transaction" class="text-decoration-none px-3 py-2 d-block d-flex gap-3"><span class="material-icons">paid</span>Transaction</a></li>
            <li class="mb-2 {{Request::path() == 'admin/customTour' ? 'bg-info' : '';}}"><a href="/admin/customTour" class="text-decoration-none px-3 py-2 d-block d-flex gap-3"><span class="material-icons">mail</span>Custom Tour </a></li>
            <li class="mb-2 {{Request::path() == 'admin/message' ? 'bg-info' : '';}}">
                <a href="/admin/message" class="text-decoration-none px-3 py-2 d-block d-flex gap-3">
                    <span class="material-icons">comment</span>Message
                    @if ($messageNotif)
                        <span class="py-0 px-2 text-center" style="width:35px; border-radius: 20px; background-color: red;">{{$messageNotif}}</span>
                    @endif
                </a>
            </li>
            <li class="mb-2 {{Request::path() == 'admin/companyProfile' ? 'bg-info' : '';}}"><a href="/admin/companyProfile" class="text-decoration-none px-3 py-2 d-block d-flex gap-3"><span class="material-icons">apartment</span>Company Profile</a></li>
        </ul>
        <hr class="h-color mx-3">
        <ul class="list-unstyled px-2 side-menu">
            {{-- <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex gap-3"><i class="fas fa-gear"></i>Setting</a></li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex gap-3"><i class="fas fa-bell"></i>Notification</a></li> --}}
            <li class="mb-2"><button type="button" class="px-3 py-2 d-block d-flex gap-3 logOut"><span class="material-icons">logout</span>Logout</button></li>
        </ul>
    </div>
</div>

