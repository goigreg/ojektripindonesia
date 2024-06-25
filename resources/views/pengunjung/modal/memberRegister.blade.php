<div class="modal fade" id="memberRegisterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('memberRegister')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control-plaintext" id="user_code" name="userCode" value="{{$userCode}}" readonly>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-3 col-form-label">Name<span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}" placeholder="Name min 3 characters" autofocus required>
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                Please input name
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-3 col-form-label">Email<span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" placeholder="ex: myname@example.com" required>
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                Please input email
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone<span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Phone number" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-3 col-form-label">Password<span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password min 6 characters" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-sm-3 col-form-label">Password Confirmation<span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="passwordConfirmation" id="password_confirmation" placeholder="Confirm your password" required>
                        </div>
                    </div>
                    <hr>
                    <div class="justify-content-center col-sm-12 mb-2 text-center">
                        <button type="submit" class="btn btn-success"style="width: 150px;">Submit</button>
                    </div>
                </div>            
            </form>
        </div>
    </div>
</div>
<script>
    $('#memberRegisterModal').on('shown.bs.modal', function () {
    $('#name').focus()
    })
    $('.btn-close').click(function (e) {
            location.reload();
        });
</script>