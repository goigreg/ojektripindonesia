@extends('admin.layout.index')

@section('content')
<div class="card mb-1">
    <div class="card-body d-flex flex-row justify-content-between">
        <form action="/admin/order/filter" method="GET">
            <div class="filter d-flex flex-lg-row gap-3">
                <input type="date" class="form-control" name="startDate" value="{{ isset($start_date) ? $start_date : ''}}" required>
                <input type="date" class="form-control" name="endDate" value="{{ isset($end_date) ? $end_date : ''}}" required>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="/admin/order" class="btn btn-danger {{Request::path() == 'admin/order' ? 'collapse' : '';}}">Back</a>
            </div>
        </form>
        <form action="/admin/order/search" method="GET">
            <div class="d-flex flex-lg-row gap-3 justify-content-between">
                <input type="search" class="form-control" name="search" style="width: 250px" 
                placeholder="Search...." value="{{ isset($search) ? $search : ''}}" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>                
        </form>
    </div>
</div>
    <div class="card rounded-full">
        <div class="card-body">
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Package</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">People</th>
                        <th class="text-center">Status</th>
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
                            <td class="text-center">{{$x->booking_code}}</td>
                            <td class="text-center">{{$x->departure_date}}</td>
                            <td class="text-center">{{$x->package_name}}</td>
                            <td class="text-center">{{$x->name}}</td>
                            <td class="text-center">
                                {{$x->number_of_adult}}/{{$x->number_of_child}}/{{$x->number_of_infant}}
                            </td>
                            <td class="text-center">
                                <span class="px-1 text-bg-{{$x->payment_status === 0 ? 'success' : ''}}">{{$x->payment_status === 0 ? 'Paid' : 'Not Paid'}}</span>                                
                            </td>                                
                            <td class="text-center">
                                <button class="btn btn-info px-2 pb-0 viewOrderModal" data-id="{{$x->id}}">
                                    <span class="material-icons">
                                        visibility
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
    <div class="showViewData" style="display: none"></div>

    <script>
        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        })

        $('.viewOrderModal').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('viewOrderModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showViewData').html(response).show();
                    $('#viewOrderModal').modal('show');
                }
            });
        })
    </script>
@endsection