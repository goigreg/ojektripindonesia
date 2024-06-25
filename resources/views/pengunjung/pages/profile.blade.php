@extends('pengunjung.layout.index')

@section('contents')
<div class="container-profile">
    <div class="row profile-card">
        <div class="col-md-4" style="background-color: #36c3bb">
            <div class="box bg-white">
                <img src="{{asset('storage/user/'. Auth::user()->profile_photo)}}" alt="">
                <button type="button" class="btn btn-info p-0 editPhoto position-absolute"><i class="fa-solid fa-camera"></i></button>            
                <div class="logout-member">
                    <form action="/memberLogout" method="POST">
                        @csrf
                        <button type="submit" class=" btn btn-danger memberLogout" type="button">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row col-md-12 mt-4 profile-text">
                <div class="col-md-8 auth-name">
                    <h1>{{Auth::user()->name}}</h1>
                </div>
                <div class="col-md-4 align-content-center">
                    <button class="btn d-flex btn-edit"><span class="material-icons">edit</span>Edit Profile</button>
                </div>
                <div class="dropdown profile-btn-setting">
                    <button class="btn dropdown-toggle btn-setting" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-gear fs-5"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <button class="dropdown-item changePassword" type="button">
                            <i class="fa-solid fa-pen-to-square"></i> Change password                  
                        </button>
                        <form action="{{route('deleteAccount', $data->id)}}" method="GET">
                            @csrf
                            <button type="submit" class="dropdown-item deleteAccount" type="button" data-id="{{$data->id}}">
                                <i class="fa-solid fa-trash"></i> Delete account
                            </button>
                        </form>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="col-md-12 mt-5 profile-detail">
                <h3 class="mb-4"><i class="fa-solid fa-envelope"></i> {{Auth::user()->email}}</h3>
                <h3 class="mb-4"><i class="fa-solid fa-phone"></i> {{Auth::user()->phone}}</h3>
                <h3 class="mb-4"><i class="fa-solid fa-flag"></i> {{Auth::user()->nationality}}</h3>
                <h3 class="mb-4"><i class="fa-solid fa-location-dot"></i> {{Auth::user()->address}}</h3>
            </div>
        </div>
    </div>
    {{--------------------------------------- Booking history --------------------------------------}}
    <div class="mt-5 mb-2 bookHistory-title" id="my-tickets">
        <h2 class="text-center" style="color: #f18930">Booking History</h2>
        <hr>
    </div>
    @foreach ($ticket as $x)            
        <div class="bookHistory-card mb-4">
            <div class="col-md-4 p-1" style="background-color: #36c3bb;">
                <div class="position-relative" style="left: 15px">
                    <h3 class="text-white">{{$x->name}}</h3>
                    <h6 class="text-white">Adult: {{$x->number_of_adult}} | Child: {{$x->number_of_child}} | Infant: {{$x->number_of_infant}}</h6>
                </div>
            </div>
            <div class="col-md-8 p-1 row d-flex justify-content-between">
                <div class="col-sm-8">
                    <div class="position-relative" style="left:15px">
                        <h3>{{$x->package_name}}</h3>
                        <h6>{{$x->departure_date}}</h6>
                    </div>
                </div>
                <div class="col-sm-4 d-flex btn-book-history">
                    <div class="d-inline" style="margin: auto 0">
                        {{-- <button class="btn btn-warning btn-pdf" data-id="{{$x->id}}"><i class="fa-solid fa-download"></i> PDF</button> --}}
                        <a href="viewTicket/{{$x->id}}" target="_blank" class="btn btn-info" style="background-color: rgb(54, 195, 187); color:white">View Ticket</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="empty-div"></div>
<div class="showEditPhoto" style="display: none"></div>
<div class="showEditProfile" style="display: none"></div>
<div class="showChangePassword" style="display: none"></div>
<script>
    $('.memberLogout').click(function(e) {
            e.preventDefault();            
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, logout!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url : '{{route('memberLogout')}}',
                    success: function (response) {
                        location.replace('/');
                    }
                });
                }
            });
        })
    $('.editPhoto').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('editProfilePhotoModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showEditPhoto').html(response).show();
                    $('#editProfilePhotoModal').modal('show');
                }
            })
        })
    $('.btn-edit').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('editProfileModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showEditProfile').html(response).show();
                    $('#editProfileModal').modal('show');
                }
            })
        })
    $('.btn-pdf').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('downloadPdf', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    location.reload();
                }
            })
        })
    $('.changePassword').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('changePasswordModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showChangePassword').html(response).show();
                    $('#changePasswordModal').modal('show');
                }
            })
        })
    $('.deleteAccount').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete my account!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url : "{{route('deleteAccount', ['id'=> ':id'])}}".replace(':id',id),
                    success: function (response) {
                        location.replace('/');
                    }
                });
                }
            });
        })
</script>
@endsection