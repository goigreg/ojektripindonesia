@extends('pengunjung.layout.index')

@section('contents')
    <div class="crousels">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-1">
                        <img src="assets/images/carousel1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-caption d-md-block">
                        <h4>Let's get around Bali island with<br>Ojek Trip on the day tours!</h4>
                        <p><a href="/tours/#day-tour" class="btn btn-warning mt-3 btn-view-packages">View Packages</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-2">
                        <img src="assets/images/carousel2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-caption d-md-block">
                        <h4>Pick any activity you love,<br>have fun on it!</h4>
                        <p><a href="/tours/#fun-activity" class="btn btn-warning mt-3 btn-view-packages">View Packages</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-3">
                        <img src="assets/images/carousel3.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-caption d-md-block">
                        <h4>Tour packages to be explored in several days</h4>
                        <p><a href="/tours/#package" class="btn btn-warning mt-3 btn-view-packages">View Packages</a></p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    
     {{--------------------------------------------- Day Tour --------------------------------------------}}

     @if ($daytour->isEmpty())
        <div class="card col-sm-12 text-lg-center pt-4 border-0 bg-transparent">
            
        </div>
    @else    
        <div class="package-container">
            <div class="package-title position-relative">
                <h2 class="text-center">Day Tours</h2>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-2 mt-4">
                @foreach ($daytour as $p)                  
                    <div class="col">
                        <div class="card package-card">
                            <div class="package-img-path">
                                <img src="{{asset('storage/product/' . $p->package_photo1)}}" class="card-img-top package-img" alt="Package photo">
                            </div>
                            <div class="card-body package-cbody">
                                <div class="package-name-home">
                                    <h5>{{$p->package_name}}</h5>
                                </div>
                                <div class="desc-home">
                                    <p>{!! $p->package_desc!!}</p>
                                </div>
                                <a href="details/{{$p->id}}">More details<i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="d-flex justify-content-around mb-5">                                
                                <h3>IDR {{ number_format($p->price) }}<span>/pax</span></h3>
                                <a href="book/{{$p->id}}/#booking-form" class="btn btn-primary btn-book">Book Now</a>                               
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="d-inline-block">
                    <div class="showData">
                        Displayed {{$daytour->count()}} of {{$daytour->total()}}
                    </div>
                </div>
                <div class="d-inline-block">
                    @if ($countDaytour > 3)                
                        <div class="btn-vmore mt-2">
                            <a href="/tours/#day-tour">View more<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    @endif
                </div>
            </div>            
        </div>
    @endif
     {{--------------------------------------------- Fun actifity --------------------------------------------}}

    @if ($funActivity->isEmpty())
        <div class="card col-sm-12 text-lg-center pt-4 border-0 bg-transparent">
            
        </div>
    @else    
        <div class="package-container" style="margin-top: -50px">
            <div class="package-title position-relative">
                <h2 class="text-center">Fun Activities</h2>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-2 mt-4">
                @foreach ($funActivity as $p)                    
                    <div class="col">
                        <div class="card package-card">
                            <div class="package-img-path">
                                <img src="{{asset('storage/product/' . $p->package_photo1)}}" class="card-img-top package-img" alt="Package photo">
                            </div>
                            <div class="card-body package-cbody">
                                <div class="package-name-home">
                                    <h5>{{$p->package_name}}</h5>
                                </div>
                                <div class="desc-home">
                                    <p>{!! $p->package_desc!!}</p>
                                </div>
                                <a href="details/{{$p->id}}">More details<i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="d-flex justify-content-around mb-5">                                
                                <h3>IDR {{ number_format($p->price)}}<span>/pax</span></h3>
                                <a href="book/{{$p->id}}/#booking-form" class="btn btn-primary btn-book">Book Now</a>                        
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="d-inline-block">
                    <div class="showData">
                        Displayed {{$funActivity->count()}} of {{$funActivity->total()}}
                    </div>
                </div>
                <div class="d-inline-block">
                    @if ($countFunActivity > 3)                
                        <div class="btn-vmore mt-2">
                            <a href="/tours/#fun-activity">View more<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    @endif
                </div>
            </div>            
        </div>
    @endif

       {{--------------------------------------------- Package --------------------------------------------}}

    @if ($package->isEmpty())
        <div class="card col-sm-12 text-lg-center pt-4 border-0 bg-transparent">
            
        </div>
    @else         
        <div class="package-container" style="margin-top: -50px">
            <div class="package-title position-relative">
                <h2 class="text-center">Packages</h2>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-2 mt-4">
                @foreach ($package as $p)                    
                    <div class="col">
                        <div class="card package-card">
                            <div class="package-img-path">
                                <img src="{{asset('storage/product/' . $p->package_photo1)}}" class="card-img-top package-img" alt="Package photo">
                            </div>
                            <div class="card-body package-cbody">
                                <div class="package-name-home">
                                    <h5>{{$p->package_name}}</h5>
                                </div>
                                <div class="desc-home">
                                    <p>{!! $p->package_desc!!}</p>
                                </div>
                                <a href="details/{{$p->id}}">More details<i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="d-flex justify-content-around mb-5">                                
                                <h3>IDR {{ number_format($p->price)}}<span>/pax</span></h3>
                                <a href="book/{{$p->id}}/#booking-form" class="btn btn-primary btn-book">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="d-inline-block">
                    <div class="showData">
                        Displayed {{$package->count()}} of {{$package->total()}}
                    </div>
                </div>
                <div class="d-inline-block">
                    @if ($countPackage > 3)                
                        <div class="btn-vmore mt-2">
                            <a href="/tours/#package">View more<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    @endif
                </div>
            </div>                    
        </div> 
    @endif
@endsection