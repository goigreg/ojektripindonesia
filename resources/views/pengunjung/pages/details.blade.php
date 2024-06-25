@extends('pengunjung.layout.index')

@section('contents')
        <div class="container p-0 mb-4">
            <div class="col-lg-12 position-relative">
                <img src="{{asset('storage/product/' . $data->package_photo1)}}" class="desc-img m-0" alt="Package image">
                <div class="row col-lg-12 m-0 justify-content-center mb-4 position-absolute text-overimg">
                    <div class="row col-lg-9 item-left position-relative">
                        <h1>{{$data->package_name}}</h1>
                        <h3><span>IDR </span>{{ number_format($data->price)}}<span>/person</span></h3>
                        <h5><span>IDR </span>{{ number_format($data->child_price)}}<span>/person for child</span></h5>
                        @if ($data->people_min == 1)
                        <p>Min: - <i class="fa-solid fa-person"></i></p>
                        @else
                        <p>Min: {{$data->people_min}} <i class="fa-solid fa-person"></i></p>
                        @endif
                    </div>
                    <div class="row col-lg-3 justify-content-center position-relative book-now">
                        <a href="book/{{$data->id}}/#booking-form" class="btn btn-warning position-absolute">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row col-lg-12 btn-book-custom mb-4">
                <div class="row col-lg-3 justify-content-center position-relative contact-us">
                    <button class="btn btn-success customTour" id="custom-tour">Custom Tour</button>
                </div>
            </div>
            <div class="row col-lg-12 btn-book-custom-2 mb-4">
                <div class="row col-lg-3 justify-content-center position-relative contact-us">
                    <a href="book/{{$data->id}}/#booking-form" class="btn btn-warning book-now-2">Book Now</a>
                    <button class="btn btn-success customTour" id="custom-tour-2">Custom Tour</button>
                </div>
            </div>
            <div class="row col-lg-12 m-0 justify-content-between mb-4">
                <div class="row col-lg-9 short-desc mb-4">
                    <h3 class="text-center">About The Package</h3>
                    <hr>
                    <p>{!! $data->package_desc!!}</p>
                </div>
                <div class="row col-lg-3 p-0 m-0">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner carousel-images">
                            <div class="carousel-item active">
                                <img src="{{asset('storage/product/' . $data->package_photo1)}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('storage/product/' . $data->package_photo2)}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('storage/product/' . $data->package_photo3)}}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <div class="prev-next">
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-lg-12 m-0 justify-content-between">
                <div class="row col-lg-9">
                    <div class="col">
                        <h3 class="text-center">Itinerary</h3>
                        <hr>
                        <div class="tb-itinerary">
                            <table class="table">
                                <thead class="bg-transparent">
                                    <tr class="text-center">
                                        <th>Location</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @if ($data->itin_loc1 === 'none')
                                        <div></div>
                                        @else
                                        <td>{{$data->itin_loc1}}</td>
                                        <td>{{$data->itin_desc1}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        @if ($data->itin_loc2 === 'none')
                                        <div></div>
                                        @else
                                        <td>{{$data->itin_loc2}}</td>
                                        <td>{{$data->itin_desc2}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        @if ($data->itin_loc3 === 'none')
                                        <div></div>
                                        @else
                                        <td>{{$data->itin_loc3}}</td>
                                        <td>{{$data->itin_desc3}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        @if ($data->itin_loc4 === 'none')
                                        <div></div>
                                        @else
                                        <td>{{$data->itin_loc4}}</td>
                                        <td>{{$data->itin_desc4}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        @if ($data->itin_loc5 === 'none')
                                        <div></div>
                                        @else
                                        <td>{{$data->itin_loc5}}</td>
                                        <td>{{$data->itin_desc5}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        @if ($data->itin_loc6 === 'none')
                                        <div></div>
                                        @else
                                        <td>{{$data->itin_loc6}}</td>
                                        <td>{{$data->itin_desc6}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        @if ($data->itin_loc7 === 'none')
                                        <div></div>
                                        @else
                                        <td>{{$data->itin_loc7}}</td>
                                        <td>{{$data->itin_desc7}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        @if ($data->itin_loc8 === 'none')
                                        <div></div>
                                        @else
                                        <td>{{$data->itin_loc8}}</td>
                                        <td>{{$data->itin_desc8}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        @if ($data->itin_loc9 === 'none')
                                        <div></div>
                                        @else
                                        <td>{{$data->itin_loc9}}</td>
                                        <td>{{$data->itin_desc9}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        @if ($data->itin_loc10 === 'none')
                                        <div></div>
                                        @else
                                        <td>{{$data->itin_loc10}}</td>
                                        <td>{{$data->itin_desc10}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row col-lg-3">
                    <div>
                        <h3 class="text-center">Inclusions</h3>
                        <hr>
                        <div class="inclusions">
                            <p>{!! $data->inclusion !!}</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-center">Exclusions</h3>
                        <hr>
                        <div class="exclusions">
                            <p>{!! $data->exclusion !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-lg-12 m-0 justify-content-between">
                <div class="row col-lg-9">
                    <p><strong>Note:</strong><br>{!! $data->note !!}</p>
                </div>
            </div>
        </div>       
        <div class="showModal" style="display: none"></div>
        <div class="showModal-2" style="display: none"></div>
    <script>
        $('.customTour').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{route('customTourModal')}}',
                success: function (response) {
                    $('.showModal').html(response).show();
                    $('#customTourModal').modal('show');
                }
            });
        });
    </script>

@endsection