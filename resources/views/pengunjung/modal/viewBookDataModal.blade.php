<div class="modal fade" id="viewBookDataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('updateBookData', $data->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-warning btn-editData"><i class="fa-solid fa-pen-to-square"></i></button></div>
                        </div>
                    <div class="mb-3 row">
                        <label for="booking-code" class="col-sm-5 col-form-label">Booking Code</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="booking-code" name="bookingCode" value="{{$data->booking_code}}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="departure-date" class="col-sm-5 col-form-label">Departure Date</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control departure-date" id="departure-date" name="departureDate" value="{{$data->departure_date}}" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-5 col-form-label">Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control name" id="name" name="name" value="{{$data->name}}" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-5 col-form-label">Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control email" id="email" name="email" value="{{$data->email}}" disabled autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone" class="col-sm-5 col-form-label">Phone</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control phone" id="phone" name="phone" value="{{$data->phone}}" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="number-of-people" class="col-sm-3 col-form-label">Number Of</label>
                        <div class="col-sm-9 row d-flex justify-content-between">
                            @foreach($product as $p)
                                <input type="hidden" name="minPeople" id="min-people" class="form-control text-center" value="{{$p->people_min}}">
                                <input type="hidden" name="priceAdult" id="price-adult" class="form-control text-center" value="{{$p->price}}">
                                <input type="hidden" name="priceChild" id="price-child" class="form-control text-center" value="{{$p->child_price}}">
                            @endforeach
                            <div class="col col-sm-4">
                                <label for="total-adult" class="col-form-label d-block text-center">Adult</label>
                                <div class="d-flex">
                                    <button class="rounded-start bg-secondary p-1 border border-0 minusAdult" id="minus" disabled>-</button>                                        
                                    <input type="hidden" name="totalPriceAdult" id="total-priceAdult" class="form-control text-center">
                                    <input type="number" name="adult" id="adult" class="form-control text-center" min="0" max="9999" value="{{$data->number_of_adult}}" readonly>
                                    <button class="rounded-end bg-secondary p-1 border border-0 plusAdult" id="plus">+</button>
                                </div>
                            </div>
                            <div class="col col-sm-4">
                                <label for="child" class="col-form-label d-block text-center">Child</label>
                                <div class="d-flex">
                                    <button class="rounded-start bg-secondary p-1 border border-0 minusChild" id="minus" disabled>-</button>
                                    <input type="hidden" name="totalPriceChild" id="total-priceChild" class="form-control text-center totalPriceChild">
                                    <input type="number" name="child" id="child" class="form-control text-center" min="0" max="9999" value="{{$data->number_of_child}}" readonly>
                                    <button class="rounded-end bg-secondary p-1 border border-0 plusChild" id="plus">+</button>
                                </div>
                            </div>
                            <div class="col col-sm-4">
                                <label for="infant" class="col-form-label d-block text-center">Infant</label>
                                <div class="d-flex">
                                    <button class="rounded-start bg-secondary p-1 border border-0 minusInfant" id="minus" disabled>-</button>
                                    <input type="number" name="infant" id="infant" class="form-control text-center" min="0" max="9999" value="{{$data->number_of_infant}}" readonly>
                                    <button class="rounded-end bg-secondary p-1 border border-0 plusInfant" id="plus">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb3 row">
                        <label for="total-price" class="col-md-4 col-form-label" style="font-weight: 900">Price Total: IDR</label>
                        <div class="col-md-6 d-flex">
                            <input type="number" class="form-control-plaintext" name="totalPrice" id="total-price" value="0" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="d-inline-block">
                        <button type="button" class="btn btn-danger btn-cancelBooking" data-id="{{$data->id}}">Cancel</button>
                    </div>
                    <div class="d-inline-block">
                        <button type="submit" class="btn btn-primary save" disabled>Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.btn-cancelBooking').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Cancel your booking?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "Quit!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url : "{{route('cancelBooking', ['id'=> ':id'])}}".replace(':id',id),
                    success: function (response) {
                        location.reload();
                    }

                });
                }
            });
        })

    $(".btn-editData").on('click', function(){
        $(".departure-date").prop("disabled", false),
        $(".name").prop("disabled", false),
        $(".email").prop("disabled", false),
        $(".phone").prop("disabled", false),
        $(".save").prop("disabled", false);
    })
    $(".plusAdult").on('click', function(){   
        $(".departure-date").prop("disabled", false),
        $(".name").prop("disabled", false),
        $(".email").prop("disabled", false),
        $(".phone").prop("disabled", false),     
        $(".save").prop("disabled", false);
    })
    $(".minusAdult").on('click', function(){ 
        $(".departure-date").prop("disabled", false),
        $(".name").prop("disabled", false),
        $(".email").prop("disabled", false),
        $(".phone").prop("disabled", false),       
        $(".save").prop("disabled", false);
    })
    $(".plusChild").on('click', function(){ 
        $(".departure-date").prop("disabled", false),
        $(".name").prop("disabled", false),
        $(".email").prop("disabled", false),
        $(".phone").prop("disabled", false),       
        $(".save").prop("disabled", false);
    })
    $(".minusChild").on('click', function(){  
        $(".departure-date").prop("disabled", false),
        $(".name").prop("disabled", false),
        $(".email").prop("disabled", false),
        $(".phone").prop("disabled", false),      
        $(".save").prop("disabled", false);
    })
    $(".plusInfant").on('click', function(){ 
        $(".departure-date").prop("disabled", false),
        $(".name").prop("disabled", false),
        $(".email").prop("disabled", false),
        $(".phone").prop("disabled", false),       
        $(".save").prop("disabled", false);
    })
    $(".minusInfant").on('click', function(){ 
        $(".departure-date").prop("disabled", false),
        $(".name").prop("disabled", false),
        $(".email").prop("disabled", false),
        $(".phone").prop("disabled", false),       
        $(".save").prop("disabled", false);
    })

    $(Document).ready(function () {
    $('.modal-body').each(function(){
        var card = $(this);
        var adult = card.find('#adult').val();
        var child = card.find('#child').val();
        var infant = card.find('#infant').val();
        var minPeople = card.find('#min-people').val();

        if(adult > minPeople){
            card.find('.minusAdult').prop("disabled", false);
        }
        if(child > 0){
            card.find('.minusChild').prop("disabled", false);
        }
        if(infant > 0){
            card.find('.minusInfant').prop("disabled", false);
        }

        var totalPriceAdult = card.find('#total-priceAdult').val();
        var totalPriceChild = card.find('#total-priceChild').val();
        var totalPrice = parseInt(totalPriceAdult) + parseInt(totalPriceChild);
        card.find('#total-price').val(totalPrice);
    });
    $('.plusAdult').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.modal-body');
        var price = card.find('#price-adult').val();
        var minPeople = card.find('#min-people').val();
        var adult = card.find('#adult').val();

        var plusAdult = parseInt(adult) + 1;
        card.find('#adult').val(plusAdult);

        var subtotal = parseInt(price) * parseInt(plusAdult);
        card.find('#total-priceAdult').val(subtotal);
        var totalPriceAdult = card.find('#total-priceAdult').val();
        var totalPriceChild = card.find('#total-priceChild').val();
        var totalPrice = parseInt(totalPriceAdult) + parseInt(totalPriceChild);
        card.find('#total-price').val(totalPrice);

        if(plusAdult > minPeople){
            card.find('.minusAdult').prop("disabled", false);
        }
    })
    $('.minusAdult').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.modal-body');
        var price = card.find('#price-adult').val();
        var minPeople = card.find('#min-people').val();
        var adult = card.find('#adult').val();

        var minusAdult = parseInt(adult) - 1;
        card.find('#adult').val(minusAdult);

        var subtotal = parseInt(price) * parseInt(minusAdult);
        card.find('#total-priceAdult').val(subtotal);
        var totalPriceAdult = card.find('#total-priceAdult').val();
        var totalPriceChild = card.find('#total-priceChild').val();
        var totalPrice = parseInt(totalPriceAdult) + parseInt(totalPriceChild);
        card.find('#total-price').val(totalPrice);

        if(minusAdult <= minPeople){
            card.find('.minusAdult').prop("disabled", true);
        }
    })

    $('.modal-body').each(function(){
        var card = $(this);
        var price = card.find('#price-adult').val();
        var adult = card.find('#adult').val();
        var adultTotal = parseInt(price) * parseInt(adult);
        card.find('#total-priceAdult').val(adultTotal);
        var priceChild = card.find('#price-child').val();
        var child = card.find('#child').val();
        var childTotal = parseInt(priceChild) * parseInt(child);
        var total = adultTotal + childTotal;
        card.find('#total-price').val(total);
    });
    // =========Number of Child========= //
    $('.plusChild').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.modal-body');
        var price = card.find('#price-child').val();
        var quantity = card.find('#child').val();

        var plusChild = parseInt(quantity) + 1;
        card.find('#child').val(plusChild);

        var subtotal = parseInt(price) * parseInt(plusChild);
        card.find('.totalPriceChild').val(subtotal);
        var totalPriceAdult = card.find('#total-priceAdult').val();
        var totalPriceChild = card.find('#total-priceChild').val();
        var totalPrice = parseInt(totalPriceAdult) + parseInt(totalPriceChild);
        card.find('#total-price').val(totalPrice);

        if(plusChild > 0){
            card.find('.minusChild').prop("disabled", false);
        }
    })
    $('.minusChild').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.modal-body');
        var price = card.find('#price-child').val();
        var quantity = card.find('#child').val();

        var minusChild = parseInt(quantity) - 1;
        card.find('#child').val(minusChild);

        var subtotal = parseInt(price) * parseInt(minusChild);
        card.find('.totalPriceChild').val(subtotal);
        var totalPriceAdult = card.find('#total-priceAdult').val();
        var totalPriceChild = card.find('#total-priceChild').val();
        var totalPrice = parseInt(totalPriceAdult) + parseInt(totalPriceChild);
        card.find('#total-price').val(totalPrice);

        if(minusChild <= 0){
            card.find('.minusChild').prop("disabled", true);
        }
    })

    $('.modal-body').each(function(){
        var card = $(this);
        var price = card.find('#price-child').val();
        var quantity = card.find('#child').val();
        var total = parseInt(price) * parseInt(quantity);
        card.find('.totalPriceChild').val(total);
    });
    // =========Number of Infant========= //
    $('.plusInfant').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.modal-body');
        var price = card.find('#price').val();
        var quantity = card.find('#infant').val();

        var plusInfant = parseInt(quantity) + 1;
        card.find('#infant').val(plusInfant);

        var subtotal = parseInt(price) * parseInt(plusInfant);
        card.find('.totalprice').val(subtotal);

        if(plusInfant > 0){
            card.find('.minusInfant').prop("disabled", false);
        }
    })
    $('.minusInfant').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.modal-body');
        var price = card.find('#price').val();
        var quantity = card.find('#infant').val();

        var minusInfant = parseInt(quantity) - 1;
        card.find('#infant').val(minusInfant);

        var subtotal = parseInt(price) * parseInt(minusInfant);
        card.find('.totalprice').val(subtotal);

        if(minusInfant <= 0){
            card.find('.minusInfant').prop("disabled", true);
        }
    })

    $('.modal-body').each(function(){
        var card = $(this);
        var price = card.find('#price').val();
        var quantity = card.find('#infant').val();
        var total = parseInt(price) * parseInt(quantity);
        card.find('#totalprice').val(total);
    });
})
</script>