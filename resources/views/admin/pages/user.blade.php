@extends('admin.layout.index')

@section('content')
    <div class="card mb-1">
        <div class="card-body d-flex flex-row justify-content-between">
            <form action="/admin/user/filter" method="GET">
                <div class="filter d-flex flex-lg-row gap-3">
                    <input type="date" class="form-control" name="startDate" value="{{ isset($start_date) ? $start_date : ''}}" required>
                    <input type="date" class="form-control" name="endDate" value="{{ isset($end_date) ? $end_date : ''}}" required>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="/admin/user" class="btn btn-danger {{Request::path() == 'admin/user' ? 'collapse' : '';}}">Back</a>
                </div>
            </form>
            <form action="/admin/user/search" method="GET">
                <div class="d-flex flex-lg-row gap-3 justify-content-between">
                    <input type="search" class="form-control" name="search" style="width: 250px" 
                    placeholder="Search...." value="{{ isset($search) ? $search : ''}}" required>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>                
            </form>
        </div>
    </div>
    <div class="card rounded-full">
        <div class="card-header bg-transparent {{$role === 'manager' ? '' : 'collapse'}}">            
            <button class="btn btn-info" id="addData">
                <i class="fas fa-plus">
                    <span>Add Admin</span>
                </i>
            </button>            
        </div>
        <div class="card-body">
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Photo</th>
                        <th class="text-center">User Code</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Join Date</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $y => $x)
                    <tr class="align-middle">
                        <td class="text-center">{{++$y}}</td>
                        <td class="text-center">
                            <div class="photo-prev">
                                <img src="{{asset('storage/user/'.$x->profile_photo)}}" alt="">
                            </div>
                        </td>
                        <td class="text-center">{{$x->user_code}}</td>
                        <td class="text-center">{{$x->name}}</td>
                        <td class="text-center">{{$x->phone}}</td>
                        <td class="text-center">{{$x->created_at->format('Y-m-d')}}</td>
                        @if ($x->role === 'member')
                        <td class="text-center">
                            <span>Member</span>
                        </td>
                        @else
                        <td class="text-center">
                            <span class='badge text-bg-{{$x->role === 'admin' ? 'warning' : 'success'}}'>{{$x->role === 'admin' ? 'Admin' : 'Manager'}}</span>
                        </td>
                        @endif

                        <td class="text-center">
                            @if ($x->id == $authId)
                                <button class="btn btn-info px-2 pb-0 editUserModal" data-id="{{$x->id}}">
                                    <span class="material-icons">
                                        edit
                                    </span>
                                </button>
                            @else                                            
                                @if ($x->role === 'member')
                                <button class="btn btn-info px-2 pb-0 viewUserModal" data-id="{{$x->id}}">
                                    <span class="material-icons">
                                        visibility
                                    </span>
                                </button>
                                @else
                                    @if ($role == 'manager')                                
                                        <button class="btn btn-info px-2 pb-0 editUserModal" data-id="{{$x->id}}">
                                            <span class="material-icons">
                                                edit
                                            </span>
                                        </button>
                                    @else
                                        <button class="btn btn-info px-2 pb-0 viewUserModal" data-id="{{$x->id}}">
                                            <span class="material-icons">
                                                visibility
                                            </span>
                                        </button>
                                    @endif
                                @endif
                            @endif
                            @if ($role === 'manager')
                                <button class="btn btn-danger deleteUserData px-2 pb-0 {{$x->role === 'manager' ? 'disabled' : ''}}" data-id="{{$x->id}}">
                                    <span class="material-icons">
                                        delete
                                    </span>
                                </button>
                            @else
                                @if ($x->role === 'member')
                                    <button class="btn btn-danger deleteUserData px-2 pb-0" data-id="{{$x->id}}">
                                        <span class="material-icons">
                                            delete
                                        </span>
                                    </button>
                                @else
                                    @if ($x->id == $authId)
                                        <button class="btn btn-danger deleteUserData px-2 pb-0" data-id="{{$x->id}}">
                                            <span class="material-icons">
                                                delete
                                            </span>
                                        </button>
                                    @else                                        
                                        <button class="btn btn-danger deleteUserData px-2 pb-0" data-id="{{$x->id}}" disabled>
                                            <span class="material-icons">
                                                delete
                                            </span>
                                        </button>
                                    @endif                                    
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach                    
                </tbody>
            </table>
            @if ($data->isEmpty())
            <div class="text-center mt-5">
                <h5>Empty</h5>
            </div>
            @else
            <div class="pagination d-flex flex-row justify-content-between">
                <div class="showData">
                    Displayed {{$data->count()}} of {{$data->total()}}
                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="showData" style="display: none"></div>
    <div class="showViewData" style="display: none"></div>
    <div class="showEditData" style="display: none"></div>

    <script>
        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        })

        $('#addData').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{route('addUserModal')}}',
                success: function (response) {
                    $('.showData').html(response).show();
                    $('#addUserModal').modal('show');
                }
            });
        });
        $('.viewUserModal').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('viewUserModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showViewData').html(response).show();
                    $('#viewUserModal').modal('show');
                }
            });
        })
        $('.editUserModal').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('editUserModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showEditData').html(response).show();
                    $('#editUserModal').modal('show');
                }
            });
        })
        $('.deleteUserData').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Delete this user?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url : "{{route('deleteUserData', ['id'=> ':id'])}}".replace(':id',id),
                    success: function (response) {
                        location.reload();
                    }
                });
                }
            });
        })
    </script>
@endsection