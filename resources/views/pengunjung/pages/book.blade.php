@extends('pengunjung.layout.index')

@section('contents')
    <div class="container p-0 mb-4">
        <div class="col-lg-12 position-relative">
            <img src="{{asset('storage/product/' . $data->package_photo1)}}" class="desc-img m-0" alt="Package image">
            <div class="row col-lg-12 m-0 mb-4 position-absolute text-overimg">
                <div class="row col-lg-9 item-left position-relative">
                    <h1>{{$data->package_name}}</h1>
                    <h3><span>IDR </span>{{ number_format($data->price)}}<span>/person</span></h3>
                    <h5><span>IDR </span>{{ number_format($data->child_price)}}<span>/person for child</span></h5>
                    <p>Min: {{$data->people_min}} <i class="fa-solid fa-person"></i></p>
                </div>
            </div>
        </div>
    </div>
    {{----------------------------------------------- Booking form ------------------------------------------------------}}
    <form action="{{route('bookings', [$data->id])}}" method="post">
    @csrf
            <div class="col-md-12 mb-5" id="booking-form">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Booking Form</h3>
                        </div>
                        <div class="card-body">
                            <div class="row col-md-12 mb-2">
                                <input type="hidden" name="packageName" value="{{$data->package_name}}">
                                <div class="col-md-6">
                                    <label for="date" class="col-form-label">When are you planing to go?<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" name="date" id="date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="first_name" class="col-form-label col-md-12">Full Name<span style="color: red;">*</span></label>
                                    <div class="col-md-12 d-flex gap-4">
                                        <input type="text" class="form-control" name="firstName" id="first_name" placeholder="First name" required>
                                        <input type="text" class="form-control" name="lastName" id="last_name" placeholder="Last name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12 mb-2">
                                <div class="col-md-6">
                                    <label for="email" class="col-form-label">Email<span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="ex: myname@example.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="col-form-label">Phone<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone number" required>
                                </div>
                            </div>
                            <div class="row col-md-6 mb-2">
                                <div class="row col-md-12">
                                    <label for="total-adult" class="col-form-label">How many people are in the group?<span style="color: red;">*</span></label>
                                </div>
                                <div class="col col-md-4 people-number">
                                    <label for="total-adult" class="col-form-label d-block text-center">Adult (> 10y)</label>
                                    <div class="d-flex">
                                        <button class="rounded-start bg-secondary p-1 border border-0 minusAdult" id="minus" disabled>-</button>                                        
                                        <input type="hidden" name="counter" id="counter" class="form-control text-center" value="0">
                                        <input type="hidden" name="priceAdult" id="price-adult" class="form-control text-center" value="{{$data->price}}">
                                        <input type="hidden" name="totalPriceAdult" id="total-priceAdult" class="form-control text-center" readonly>
                                        <input type="number" name="adult" id="adult" class="form-control text-center" min="0" max="9999" value="{{$data->people_min}}" readonly>
                                        <button class="rounded-end bg-secondary p-1 border border-0 plusAdult" id="plus">+</button>
                                    </div>
                                </div>
                                <div class="col col-md-4 people-number">
                                    <label for="child" class="col-form-label d-block text-center">Child (2-10y)</label>
                                    <div class="d-flex">
                                        <button class="rounded-start bg-secondary p-1 border border-0 minusChild" id="minus" disabled>-</button>
                                        <input type="hidden" name="priceChild" id="price-child" class="form-control text-center" value="{{$data->child_price}}">
                                        <input type="hidden" name="totalPriceChild" id="total-priceChild" class="form-control text-center totalPriceChild" readonly>
                                        <input type="number" name="child" id="child" class="form-control text-center" min="0" max="9999" value="0" readonly>
                                        <button class="rounded-end bg-secondary p-1 border border-0 plusChild" id="plus">+</button>
                                    </div>
                                </div>
                                <div class="col col-md-4 people-number">
                                    <label for="infant" class="col-form-label d-block text-center">Infant (< 2y)</label>
                                    <div class="d-flex">
                                        <button class="rounded-start bg-secondary p-1 border border-0 minusInfant" id="minus" disabled>-</button>
                                        <input type="number" name="infant" id="infant" class="form-control text-center" min="0" max="9999" value="0" readonly>
                                        <button class="rounded-end bg-secondary p-1 border border-0 plusInfant" id="plus">+</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="book-price-total d-flex mb-4">
                                <label for="total-price" class="book-prctotal-label col-form-label" style="font-weight: 900">Price Total: IDR</label>
                                <div class="book-prctotal-input">
                                    <input type="number" class="form-control-plaintext" name="totalPrice" id="total-price" value="0" readonly>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success col-md-2 submitBook">Submit</button>
                        </div>
                    </div>                
            </div>
    </form>
    <script>
        $(function(){
            var dtToday = new Date();
        
            var month = dtToday.getMonth() + 1;

            var day = dtToday.getDate() + 1;

            var year = dtToday.getFullYear();

            if(month < 10)
                month = '0' + month.toString();

            if(day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#date').attr('min', maxDate);
        });
    </script>
@endsection