@extends('admin.layout.index')

@section('content')
    <div class="card mb-1">
        <div class="card-body d-flex flex-row justify-content-between">
            <form action="/admin/transaction/filter" method="GET">
                <div class="filter d-flex flex-lg-row gap-3">
                    <input type="date" class="form-control" name="startDate" value="{{ isset($start_date) ? $start_date : ''}}" required>
                    <input type="date" class="form-control" name="endDate" value="{{ isset($end_date) ? $end_date : ''}}" required>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="/admin/transaction" class="btn btn-danger {{Request::path() == 'admin/transaction' ? 'collapse' : '';}}">Back</a>
                </div>
            </form>
            <form action="/admin/transaction/search" method="GET">
                <div class="d-flex flex-lg-row gap-3 justify-content-between">
                    <input type="search" class="form-control" name="search" style="width: 250px" 
                    placeholder="Search...." value="{{ isset($search) ? $search : ''}}" required>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>                
            </form>
        </div>
    </div>
    <div class="card rounded-full">
        <div class="card-header bg-transparent"> 
            @if ($orderData->isEmpty())
                <button class="btn btn-info" id="addData" onclick="add(0)">
                    <i class="fas fa-plus">
                        <span>Add Transaction</span>
                    </i>
                </button>
                <form action="/admin/transaction/searchBooking" method="GET">
                    <div class="gap-1" id="search-booking" style="display: none">
                        <input type="text" class="form-control" name="searchBooking" style="width: 200px" 
                        placeholder="Input booking code" value="{{ isset($searchBooking) ? $searchBooking : ''}}" required>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                        <button type="button" class="btn btn-danger" onclick="add(1)"><i class="fa-solid fa-xmark"></i></button>
                    </div>                
                </form>           
            @else
                <form action="/admin/transaction/searchBooking" method="GET">
                    <div class="gap-1 d-flex" id="search-booking">
                        <input type="text" class="form-control" name="searchBooking" style="width: 200px" 
                        placeholder="Input booking code" value="{{ isset($searchBooking) ? $searchBooking : ''}}" required>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>                
                </form>                
            @endif
        </div>
        <div class="card-body">
            @if ($transData->isEmpty())
                <div></div>
            @else
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Code</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Total Payment</th>
                            <th class="text-center">Payment Method</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $y => $x)
                        <tr class="align-middle">
                            <td class="text-center">{{++$y}}</td>
                            <td class="text-center">{{$x->created_at->format('Y-m-d')}}</td>
                            <td class="text-center">{{$x->transaction_code}}</td>
                            <td class="text-center">{{$x->name}}</td>
                            <td class="text-center">{{number_format($x->payment_total)}}</td>
                            <td class="text-center">{{$x->payment_method}}</td>
                            <td class="text-center">
                                @if ($x->payment_method === 'Via admin')
                                <button class="btn btn-info px-2 pb-0 editTransactionModal" data-id="{{$x->id}}">
                                    <span class="material-icons">
                                        edit
                                    </span>
                                </button>
                                @else
                                <button class="btn btn-info px-2 pb-0 viewTransactionModal" data-id="{{$x->id}}">
                                    <span class="material-icons">
                                        visibility
                                    </span>
                                </button>
                                @endif
                                <button class="btn btn-danger deleteTransactionData px-2 pb-0 {{$x->payment_method === 'automatic' ? 'disabled' : ''}}" data-id="{{$x->id}}">
                                    <span class="material-icons">
                                        delete
                                    </span>
                                </button>
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
            @endif

            @if ($orderData->isEmpty())
                <div></div>
            @else                
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
                        @if ($order->isEmpty())
                            <tr>
                                <td></td>
                            </tr>
                        @else
                            @foreach ($order as $y => $x)
                            <tr class="align-middle bg-warning text-white">
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
                                    <button class="btn btn-info px-2 addTransaction {{$x->payment_status === 0 ? 'disabled' : ''}}" id="addTransaction" data-id="{{$x->id}}">
                                        <i class="fas fa-plus">
                                            <span>Add</span>
                                        </i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @if ($order->isEmpty())
                    <div class="text-center">
                        <h5>Empty</h5>
                    </div>
                @else
                    <div></div>
                @endif                                        
            @endif
        </div>
    </div>
    <div class="showAddData" style="display: none"></div>
    <div class="showViewData" style="display: none"></div>
    <div class="showEditData" style="display: none"></div>

    <script>
        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        })

        $('#addTransaction').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('addTransactionModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showAddData').html(response).show();
                    $('#addTransactionModal').modal('show');
                }
            });
        })
        $('.viewTransactionModal').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('viewTransactionModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showViewData').html(response).show();
                    $('#viewTransactionModal').modal('show');
                }
            });
        })
        $('.editTransactionModal').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('editTransactionModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showEditData').html(response).show();
                    $('#editTransactionModal').modal('show');
                }
            });
        })
        $('.deleteTransactionData').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Delete this transaction?",
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
                    url : "{{route('deleteTransactionData', ['id'=> ':id'])}}".replace(':id',id),
                    success: function (response) {
                        location.reload();
                    }
                });
                }
            });
        })

        function add(x){
            if (x == 0) document.getElementById("search-booking").style.display = "flex",
                        document.getElementById("addData").style.display = "none"
            else document.getElementById("search-booking").style.display = "none",
                document.getElementById("addData").style.display = "inline-block";
            return;
        }
    </script>
@endsection