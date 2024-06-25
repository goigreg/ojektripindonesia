<!-- Modal -->
<div class="modal fade" id="memberLoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{$item}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('memberLogin')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3 col-sm-12">
                        <div class="col-sm-3">
                            <label for="email" class="col-form-label">Email</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email" 
                            value="{{Session::get('email')}}" placeholder="Your email here" autofocus required>
                        </div>
                    </div>
                    <div class="row col-sm-12 mb-5">
                        <div class="col-sm-3">
                            <label for="password" class="col-form-label">Password</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password here" required>
                        </div>
                    </div>
                    <div class="justify-content-center col-sm-12 mb-2 text-center">
                        <button type="submit" class="btn btn-success" style="width: 150px;">Login</button>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <p class="p-0 m-auto text-center" style="font-size:14px;">Don't have one?</p>
                    </div>
                    <div class="justify-content-center col-sm-12 mb-2 text-center">
                        <button type="button" class="btn btn-primary registerModal" style="width: 150px;" id="registerModal" data-bs-toggle="modal" data-bs-target="#registerModal">Register Now</button>                
                    </div>
                </div>            
            </form>
        </div>
    </div>
</div>
<div class="showRegister" style="display: none"></div>
<script>
    $('#memberLoginModal').on('shown.bs.modal', function () {
    $('#email').focus()
    })
    $('.registerModal').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{route('registerForm')}}',
                success: function (response) {
                    $('.showRegister').html(response).show();
                    $('#memberRegisterModal').modal('show');
                }
            });
        });
</script>