<div class="modal fade" id="viewTransactionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="transaction-code" class="col-sm-5 col-form-label">Transaction Code</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control-plaintext" id="transaction-code" name="transactionCode" value="{{$data->transaction_code}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="transaction-date" class="col-sm-5 col-form-label">Transaction Date</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="transaction-date" name="transactionDate" value="{{$data->created_at}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="booking-code" class="col-sm-5 col-form-label">Booking Code</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="booking-code" name="bookingCode" value="{{$data->booking_code}}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-5 col-form-label">Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}" readonly>
                    </div>
                </div>               
                <div class="mb-3 row">
                    <label for="total-price" class="col-sm-5 col-form-label">Total Price</label>
                    <div class="col-sm-7">
                        <input type="number" class="form-control" id="total-price" name="totalPrice" value="{{$data->price_total}}" readonly>
                    </div>
                </div>               
                <div class="mb-3 row">
                    <label for="total-payment" class="col-sm-5 col-form-label">Total Payment</label>
                    <div class="col-sm-7">
                        <input type="number" class="form-control" id="total-payment" name="totalPayment" value="{{$data->payment_total}}" readonly>
                    </div>
                </div>               
                <div class="mb-3 row">
                    <label for="payment-method" class="col-sm-5 col-form-label">Payment Method</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="payment-method" name="paymentMethod" value="{{$data->payment_method}}" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>