<div class="modal fade" id="addTransactionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('addTransaction')}}" enctype="multipart/form-data" method="POST">
                @csrf
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
                        <label for="name" class="col-sm-5 col-form-label">Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}" readonly>
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
                        <label for="booking-date" class="col-sm-5 col-form-label">Booking Date</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="booking-date" name="bookingDate" value="{{$data->created_at}}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="price-total" class="col-sm-5 col-form-label">Price Total</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="price-total" name="priceTotal" value="{{$data->price_total}}" readonly>
                        </div>
                    </div>    
                    <hr>                
                    <div class="mb-3 row">
                        <label for="bank" class="col-sm-5 col-form-label">Bank</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="bankName" id="bank-name" required>
                                <option value="">==Choose Bank==</option>
                                <option value="bca" onclick="bca(0)">BCA</option>
                                <option value="bri">BRI</option>
                                <option value="bni">BNI</option>
                                <option value="mandiri">Mandiri</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="payment-proof" class="col-sm-5 col-form-label">Payment Proof</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" accept=".png, .jpg, .jpeg" id="payment-proof" name="paymentProof" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="payment-total" class="col-sm-5 col-form-label">Total Payment</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="payment-total" name="paymentTotal" value="" placeholder="Input total payment" autofocus required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#addTransactionModal').on('shown.bs.modal', function () {
    $('#payment-total').focus()
    })
</script>