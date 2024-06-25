<div class="modal fade" id="editTransactionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('updateTransactionModal', $data->id)}}" enctype="multipart/form-data" method="POST">
                @method('PUT')
                @csrf
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
                        <label for="price-total" class="col-sm-5 col-form-label">Total Price</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="price-total" name="priceTotal" value="{{$data->price_total}}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="bank" class="col-sm-5 col-form-label">Bank</label>
                        <div class="col-sm-7">
                            <select type="text" class="form-control" name="bankName" id="bank-name">
                                <option value="">==Choose Bank==</option>
                                <option value="bca" {{$data->bank_name === 'bca' ? 'selected' : '' }}>BCA</option>
                                <option value="bri" {{$data->bank_name === 'bri' ? 'selected' : '' }}>BRI</option>
                                <option value="bni" {{$data->bank_name === 'bni' ? 'selected' : '' }}>BNI</option>
                                <option value="mandiri" {{$data->bank_name === 'mandiri' ? 'selected' : '' }}>Mandiri</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="payment-proof" class="col-sm-5 col-form-label">Payment Proof</label>
                        <div class="col-sm-7">
                            <input type="hidden" name="paymentProof" value="{{$data->payment_proof}}">
                            <input type="file" class="form-control" accept=".png, .jpg, .jpeg" id="payment-proof" name="paymentProof" value="{{$data->payment_proof}}">
                        </div>
                    </div>              
                    <div class="mb-3 row">
                        <label for="payment-total" class="col-sm-5 col-form-label">Total Payment</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="payment-total" name="paymentTotal" value="{{$data->payment_total}}" autofocus>
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
    $('#editTransactionModal').on('shown.bs.modal', function () {
    $('#payment-total').focus()
    })
</script>