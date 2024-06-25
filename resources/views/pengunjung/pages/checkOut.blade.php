@extends('pengunjung.layout.index')

@section('contents')    
    @if ($data->isEmpty())
        @if ($ticket >= 1)
            <div class="justify-content-center">
                <div class="">
                    <p class="text-center">Click <a href="/profile/#my-tickets" class="text-primary">here</a> to see your ticket!</p>
                </div>
            </div>
        @else
            <div>
                
            </div>
        @endif
    @else
        @if ($ticket >= 1)
            <div class="justify-content-center">
                <div class="">
                    <p class="text-center">Click <a href="/profile/#my-tickets" class="text-primary">here</a> to see your ticket!</p>
                </div>
            </div>
        @else
            <div>

            </div>
        @endif
        <div class="cart-warning justify-content-between p-2 mb-3" id="cart-warning" style="display: flex">
            <div class="d-inline-block">
                <p class="d-block"><strong>Note:</strong> Please complete your payment or <a href="https://wa.link/63mhnd" class="text-primary" target="_blank">contact us
                    <i class="fa-brands fa-whatsapp"></i></a> to get your e-ticket!</p>
            </div>
            <div class="d-inline-block">
                <button type="button" class="btn close-warning" id="close-warning" onclick="hide(0)"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
        <div class="row cart-container d-flex justify-content-between gap-3">
            @foreach($data as $x)
                <div class="card p-3 card-cart">
                    <div class="d-flex justify-content-between mb-4">
                        <div class="col-sm-8">
                            <h5>{{$x->package_name}}</h5>
                        </div>
                        <div class="col-sm-4 price-cart">
                            <h5>IDR {{number_format($x->remaining_payment)}}</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="col-sm-8">
                            <h6>{{$x->name}}</h6>
                        </div>
                        <div class="col-sm-4 justify-content-end">
                            <button type="button" class="btn btn-info viewData" style="color: white" data-id="{{$x->id}}">View</button>
                            <button type="button" class="btn btn-primary payNow" id="pay-button" data-id="{{$x->id}}">Pay Now</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="showViewData" style="display: none"></div>
    <div class="showPayNow" style="display: none"></div>
    <script type="text/javascript">
        function hide(x){
        if (x == 0) document.getElementById("cart-warning").style.display = "none";
        else document.getElementById("cart-warning").style.display = "flex";
        return;
        }

        $('.viewData').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('viewBookData', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showViewData').html(response).show();
                    $('#viewBookDataModal').modal('show');
                }
            });
        })
        $('.payNow').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('payNow', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showPayNow').html(response).show();
                    $('#payNowModal').modal('show');
                }
            });
        })
    </script>
@endsection