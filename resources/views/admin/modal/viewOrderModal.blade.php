<div class="modal fade" id="viewOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="booking-code" class="col-sm-5 col-form-label">Booking Code</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control-plaintext" id="booking-code" name="bookingCode" value="{{$data->booking_code}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="departure-date" class="col-sm-5 col-form-label">Departure Date</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="departure-date" name="departureDate" value="{{$data->departure_date}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="package-name" class="col-sm-5 col-form-label">Package Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="package-name" name="packageName" value="{{$data->package_name}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="user-name" class="col-sm-5 col-form-label">User Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="user-name" name="userName" value="{{$data->name}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="guest-name" class="col-sm-5 col-form-label">Guest Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="guest-name" name="guestName" value="{{$data->name}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-5 col-form-label">Email</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="email" name="email" value="{{$data->email}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="phone" class="col-sm-5 col-form-label">Phone number</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$data->phone}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="total-price" class="col-sm-5 col-form-label">Total Price</label>
                    <div class="col-sm-7">
                        <input type="number" class="form-control" id="total-price" name="totalPrice" value="{{$data->price_total}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="booking-date" class="col-sm-5 col-form-label">Booking Date</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="booking-date" name="booking-date" value="{{$data->created_at}}" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>