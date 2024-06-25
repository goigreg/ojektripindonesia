@extends('pengunjung.layout.index')

@section('contents')
    @foreach ($data as $x)
    <div class="row mt-4 align-items-center bgBlue">
        <div class="col-md-6 p-4">
            <div class="content-text text-white" style="text-align: justify">
                <p>{!! $x->about_company !!}</p>
                <p>{!! $x->vision !!}</p>
                <p>{!! $x->mission !!}</p>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <div class="about-us-logo">
                <img src="{{asset('storage/company/'. $x->primary_logo)}}" alt="Foto perusahan">
            </div>
        </div>
    </div>

    <h4 class="text-center mt-md-5 mb-md-2">Get in touch with us through our contacts bellow</h4>
    <hr class="mb-5">
    <div class="row justify-content-around">
        <div class="col-md-5 mb-3">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Our Email</h4>
                </div>
                <div class="card-body">
                    <p><strong>Main email  : </strong>{{$x->main_email}}</p>
                    <p><strong>Other email : </strong>{!! $x->other_email !!}</p>                        
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-3">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Our Phone</h4>
                </div>
                <div class="card-body">
                    <p><strong>Main phone  : </strong>{{$x->main_phone}}</p>
                    <p><strong>Other phone : </strong>{!! $x->other_phone !!}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="blank-space"></div>
@endsection