<div class="modal fade" id="payNowModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('submitPayment')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb3 row">
                        <label for="total-price" class="col-md-5 col-form-label" style="font-weight: 900">Price Total: IDR</label>
                        <div class="col-md-7 d-flex">
                            <input type="number" class="form-control"  name="totalPrice" id="total-price" value="{{$data->remaining_payment}}" readonly>
                            <input type="hidden" class="form-control"  name="bookingCode" id="booking-code" value="{{$data->booking_code}}" >
                            <input type="hidden" class="form-control"  name="name" id="name" value="{{$data->name}}" >
                            <input type="hidden" class="form-control"  name="priceTotal" id="name" value="{{$data->price_total}}" >
                        </div>
                    </div>
                    <hr>
                    <p class="text-success text-center" style="font-size: 14px"><span style="color: red;">*</span>Please make payment via one of the bank accounts below!</p>
                    <div class="col-sm-10 m-auto mb-3 row">
                        <label for="bank" class="col-sm-3 col-form-label">Bank</label>
                        <div class="col-sm-9">
                            <select type="text" class="form-control" name="bankName" id="bank-name" required>
                                <option value="">==Choose Bank==</option>
                                <option value="bca">BCA</option>
                                <option value="bri">BRI</option>
                                <option value="bni">BNI</option>
                                <option value="mandiri">Mandiri</option>
                            </select>
                        </div>
                    </div>
                    @foreach ($bca as $b)
                    <div class="col-sm-10 m-auto mb-3 row choosen-bank" id="bca" style="display: none">
                        <div class="col-sm-3 bank-logo align-content-center">
                            <img src="{{asset('storage/bank_account/'.$b->bank_logo)}}" alt="">
                        </div>
                        <div class="col-sm-9 bank-account">
                            <p>{{$b->account_name}}</p>
                            <P>{{$b->account_number}}</P>
                        </div>
                    </div>
                    @endforeach
                    @foreach ($bri as $b)
                    <div class="col-sm-10 m-auto mb-3 row choosen-bank" id="bri" style="display: none">
                        <div class="col-sm-3 bank-logo align-content-center">
                            <img src="{{asset('storage/bank_account/'.$b->bank_logo)}}" alt="">
                        </div>
                        <div class="col-sm-9 bank-account">
                            <p>{{$b->account_name}}</p>
                            <P>{{$b->account_number}}</P>
                        </div>
                    </div>
                    @endforeach
                    @foreach ($bni as $b)
                    <div class="col-sm-10 m-auto mb-3 row choosen-bank" id="bni" style="display: none">
                        <div class="col-sm-3 bank-logo align-content-center">
                            <img src="{{asset('storage/bank_account/'.$b->bank_logo)}}" alt="">
                        </div>
                        <div class="col-sm-9 bank-account">
                            <p>{{$b->account_name}}</p>
                            <P>{{$b->account_number}}</P>
                        </div>
                    </div>
                    @endforeach
                    @foreach ($mandiri as $b)
                    <div class="col-sm-10 m-auto mb-3 row choosen-bank" id="mandiri" style="display: none">
                        <div class="col-sm-3 bank-logo align-content-center">
                            <img src="{{asset('storage/bank_account/'.$b->bank_logo)}}" alt="">
                        </div>
                        <div class="col-sm-9 bank-account">
                            <p>{{$b->account_name}}</p>
                            <P>{{$b->account_number}}</P>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <p class="text-success text-center" style="font-size: 14px"><span style="color: red;">*</span>Upload your payment proof bellow!</p>
                    <div class="col-sm-8 m-auto">
                        <input type="file" class="form-control" accept=".png, .jpg, .jpeg" id="payment-proof" name="paymentProof" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <div class="d-inline-block">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#bank-name").change(function () {
    if ($(this).val() == 'bca') {
        document.getElementById("bca").style.display = "flex";
    }else{
        document.getElementById("bca").style.display = "none";
    }
    });
    
    $("#bank-name").change(function () {
    if ($(this).val() == 'bri') {
        document.getElementById("bri").style.display = "flex";
    }else{
        document.getElementById("bri").style.display = "none";
    }
    });
    $("#bank-name").change(function () {
    if ($(this).val() == 'bni') {
        document.getElementById("bni").style.display = "flex";
    }else{
        document.getElementById("bni").style.display = "none";
    }
    });
    $("#bank-name").change(function () {
    if ($(this).val() == 'mandiri') {
        document.getElementById("mandiri").style.display = "flex";
    }else{
        document.getElementById("mandiri").style.display = "none";
    }
    });

</script>