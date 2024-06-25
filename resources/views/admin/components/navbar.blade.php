<nav class="navbar navbar-expand-md navbar-light">
    <div class="container-fluid">
        <div class="d-flex">
            <div class="d-flex justify-content-between d-md-none d-block">
                <button class="btn px-1 py-0 open-btn me-2"><span class="navbar-toggler-icon"></span></button>
                <a class="navbar-brand fs-4" href="#">
                    @foreach ($navLogoAdmin as $x)
                        <img src="{{asset('storage/company/'. $x->primary_logo)}}" alt="">
                    @endforeach
                </a>
            </div>
            <div class="mt-2">
                <h3>
                    {{$name}}
                </h3>
            </div>
        </div>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="admin-icon-img">
                <img src="{{asset('storage/user/'. Auth::user()->profile_photo)}}" class="rounded-circle" alt="">
            </div>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <div class="d-flex gap-2">
                        <div class="admin-icon-img">
                            <img src="{{asset('storage/user/'. Auth::user()->profile_photo)}}" class="rounded-circle" alt="">
                        </div>
                        <div class="d-flex flex-column align-items-lg-start">
                            <p class="m-0 p-0" style="font-weight: 700; font-size: 14px">{{Auth::user()->name}}</p>              
                            <p class="m-0 p-0" style="font-size: 14px">{{Auth::user()->email}}</p>
                        </div>
                    </div> 
                </li>                     
            </ul>                    
        </div>                    
    </div>
</nav>
