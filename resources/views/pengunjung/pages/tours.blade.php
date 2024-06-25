@extends('pengunjung.layout.index')

@section('contents')
    {{--------------------------------------------------Category card--------------------------------------------------------}}
    <div class="container mb-5 cont-category">
        <div class="row row-category">
            <div class="col-lg-3 col-md-12 col-12 p-0">
                <div class="card" style="width: 14rem;">
                    <div class="card-header text-center">
                        Category
                    </div>
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Day Tours
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div style="font-size: 10px;" class="d-flex flex-column gap-4">
                                            @foreach ($daytour as $d)                                                
                                                <a href="details/{{$d->id}}" class="page-link" style="font-size: 14px">
                                                    {{$d->package_name}}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Fun Activities
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div style="font-size: 10px;" class="d-flex flex-column gap-4">
                                            @foreach ($funActivity as $f)                                                
                                                <a href="details/{{$f->id}}" class="page-link" style="font-size: 14px">
                                                    {{$f->package_name}}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        Packages
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div style="font-size: 10px;" class="d-flex flex-column gap-4">
                                            @foreach ($package as $p)                                                
                                                <a href="details/{{$p->id}}" class="page-link" style="font-size: 14px">
                                                    {{$p->package_name}}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    {{----------------------------------------------------Package card--------------------------------------------------}}           
    <div class="row search-bar mb-3">
        <div class="row col-md-9 justify-content-between">
            <div class="col-md-4 p-0 btn-all">
                <a href="/tours" class="btn btn-outline-success btn-search-tour me-2  {{Request::path() == '/tours' ? 'collapse' : '';}}">All</a>
            </div>
            <div class="col-md-6 mb-3 p-0">
                <form class="d-flex" role="search" action="/tours/search" method="GET">
                    <input class="form-control me-2 search-tour" type="search" name="search" placeholder="Search" aria-label="Search"
                    value="{{ isset($search) ? $search : ''}}" required>
                    <button class="btn btn-outline-success btn-search-tour" type="submit">Search</button>
                </form>
            </div>
            <hr>
        </div>      
    </div>
    @if ($data->isEmpty())
        <div class="card col-sm-12 text-lg-center pt-4 border-0 bg-transparent">

        </div>            
    @else
        <div class="container cont-morecard mt-5" id="day-tour">
            <div class="row card-tours mb-4">
                @foreach ($data as $p)
                    <div class="row package-row col-lg-9 col-md-12 col-12 mb-4">
                        <div class="col-md-4 col-12 img-frame">
                            <div class="morecard-img">
                                <img src="{{asset('storage/product/' . $p->package_photo1)}}" class="img-tours" alt="Package imge">
                            </div>
                        </div>
                        <div class="col-md-8 col-12 about-package-tours mt-md-5">
                            <div class="morecard-text">
                                <h5>{{$p->package_name}}</h5>
                                <div class="desc-tour">
                                    <p>{!! $p->package_desc!!}</p>
                                </div>
                                <a href="details/{{$p->id}}">More details <i class="fa-solid fa-arrow-right"></i></a>
                                <div class="d-flex justify-content-between prc-btn">
                                    <h3><span>IDR </span>{{ number_format($p->price)}}<span>/pax</span></h3>
                                    <a href="book/{{$p->id}}/#booking-form" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if ($daytour->isEmpty())
        <div class="card col-sm-12 text-lg-center pt-4 border-0 bg-transparent">

        </div>            
    @else
        <div class="container cont-morecard" id="day-tour">
            <div class="row card-tours mb-4">
                <div class="col-lg-9 package-title position-relative mb-5">
                    <h2 class="text-center">Day Tours</h2>
                </div>
                @foreach ($daytour as $p)
                    <div class="row package-row col-lg-9 col-md-12 col-12 mb-4">
                        <div class="col-md-4 col-12 img-frame">
                            <div class="morecard-img">
                                <img src="{{asset('storage/product/' . $p->package_photo1)}}" class="img-tours" alt="Package imge">
                            </div>
                        </div>
                        <div class="col-md-8 col-12 about-package-tours mt-md-5">
                            <div class="morecard-text">
                                <h5>{{$p->package_name}}</h5>
                                <div class="desc-tour">
                                    <p>{!! $p->package_desc!!}</p>
                                </div>
                                <a href="details/{{$p->id}}">More details <i class="fa-solid fa-arrow-right"></i></a>
                                <div class="d-flex justify-content-between prc-btn">
                                    <h3><span>IDR </span>{{ number_format($p->price)}}<span>/pax</span></h3>
                                    <a href="book/{{$p->id}}/#booking-form" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if ($funActivity->isEmpty())
        <div class="card col-sm-12 text-lg-center pt-4 border-0 bg-transparent">

        </div>            
    @else
    <div class="container cont-morecard" id="fun-activity" style="margin-top: 30px">
        <div class="row card-tours mb-4">
            <div class="col-lg-9 package-title position-relative mb-5">
                <h2 class="text-center">Fun Activities</h2>
            </div>
            @foreach ($funActivity as $p)
                <div class="row package-row col-lg-9 col-md-12 col-12 mb-4">
                    <div class="col-md-4 col-12 img-frame">
                        <div class="morecard-img">
                            <img src="{{asset('storage/product/' . $p->package_photo1)}}" class="img-tours" alt="Package imge">
                        </div>
                    </div>
                    <div class="col-md-8 col-12 about-package-tours mt-md-5">
                        <div class="morecard-text">
                            <h5>{{$p->package_name}}</h5>
                            <div class="desc-tour">
                                <p>{!! $p->package_desc!!}</p>
                            </div>
                            <a href="details/{{$p->id}}">More details <i class="fa-solid fa-arrow-right"></i></a>
                            <div class="d-flex justify-content-between prc-btn">
                                <h3><span>IDR </span>{{ number_format($p->price)}}<span>/pax</span></h3>
                                <a href="book/{{$p->id}}/#booking-form" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    @if ($package->isEmpty())
        <div class="card col-sm-12 text-lg-center pt-4 border-0 bg-transparent">

        </div>            
    @else
        <div class="container cont-morecard" id="package" style="margin-top: 30px">
            <div class="row card-tours mb-4">
                <div class="col-lg-9 package-title position-relative mb-5">
                    <h2 class="text-center">Packages</h2>
                </div>
                @foreach ($package as $p)
                    <div class="row package-row col-lg-9 col-md-12 col-12 mb-4">
                        <div class="col-md-4 col-12 img-frame">
                            <div class="morecard-img">
                                <img src="{{asset('storage/product/' . $p->package_photo1)}}" class="img-tours" alt="Package imge">
                            </div>
                        </div>
                        <div class="col-md-8 col-12 about-package-tours mt-md-5">
                            <div class="morecard-text">
                                <h5>{{$p->package_name}}</h5>
                                <div class="desc-tour">
                                    <p>{!! $p->package_desc!!}</p>
                                </div>
                                <a href="details/{{$p->id}}">More details <i class="fa-solid fa-arrow-right"></i></a>
                                <div class="d-flex justify-content-between prc-btn">
                                    <h3><span>IDR </span>{{ number_format($p->price)}}<span>/pax</span></h3>
                                    <a href="book/{{$p->id}}/#booking-form" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection