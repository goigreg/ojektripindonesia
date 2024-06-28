@extends('admin.layout.index')

@section('content')
<div class="card product-card mb-1">
    <div class="card-body filter-search-bar">
        <form action="/admin/product/filter" method="GET">
            <div class="filter d-flex flex-lg-row gap-3">
                <input type="date" class="form-control" name="startDate" value="{{ isset($start_date) ? $start_date : ''}}" required>
                <input type="date" class="form-control" name="endDate" value="{{ isset($end_date) ? $end_date : ''}}" required>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="/admin/product" class="btn btn-danger {{Request::path() == 'admin/product' ? 'collapse' : '';}}">Back</a>
            </div>
        </form>
        <form action="/admin/product/search" method="GET">
            <div class="d-flex flex-lg-row gap-3 justify-content-between">
                <input type="search" class="form-control" name="search" style="width: 250px" 
                placeholder="Search...." value="{{ isset($search) ? $search : ''}}" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>                
        </form>
    </div>
</div>
    <div class="card product-card rounded-full">
        <div class="card-header bg-transparent">            
            <button type="button" class="btn btn-info" id="addData">
                <i class="fas fa-plus">
                    <span>Add Package</span>
                </i>
            </button>
        </div>
        <div class="card-body">
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Photo</th>
                        <th class="text-center">Package Code</th>
                        <th class="text-center">Package Name</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Posted On</th>
                        <th class="text-center">Discount</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                        <tr class="text-center">
                            <td></td>
                        </tr>
                    @else
                        @foreach ($data as $y => $x)
                        <tr class="align-middle">
                            <td class="text-center">{{++$y}}</td>
                            <td class="text-center">
                                <div class="photo-prev">
                                    <img src="{{asset('storage/product/'.$x->package_photo1)}}">
                                </div>
                            </td>
                            <td class="text-center">{{$x->package_code}}</td>
                            <td class="text-center">{{$x->package_name}}</td>
                            <td class="text-center">{{number_format($x->price)}}</td>
                            <td class="text-center">
                                <span>{{$x->category === 1 ? 'Day Tour' : ''}}</span>
                                <span>{{$x->category === 2 ? 'Fun Activity' : ''}}</span>
                                <span>{{$x->category === 3 ? 'Package' : ''}}</span>
                            </td>
                            <td class="text-center">{{$x->created_at->format('Y-m-d')}}</td>
                            @if ($x->discount <= 0)
                            <td class="text-center">
                                <span>None</span>
                            </td>
                            @else
                            <td class="text-center">
                                <span class='badge text-bg-{{$x->discount > 0 ? 'warning' : ''}}'>{{$x->discount}} %</span>
                            </td>
                            @endif
                            <td class="text-center">
                                <button class="btn btn-info px-2 pb-0 editModal" data-id="{{$x->id}}">
                                    <span class="material-icons">
                                        edit
                                    </span>
                                </button>
                                <button class="btn btn-danger deleteData px-2 pb-0" data-id="{{$x->id}}">
                                    <span class="material-icons">
                                        delete
                                    </span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    @endif                                        
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
                url: '{{route('addPackage')}}',
                success: function (response) {
                    $('.showData').html(response).show();
                    $('#addPackage').modal('show');
                }
            });
        });
        $('.editModal').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('editModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showEditData').html(response).show();
                    $('#editModal').modal('show');
                }
            })
        })
        $('.deleteData').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Delete this product?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                location.reload();
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url : "{{route('deleteData', ['id'=> ':id'])}}".replace(':id',id),
                    success: function (response) {
                        location.reload();
                    }
                });
                }
            });
        })
    </script>
@endsection