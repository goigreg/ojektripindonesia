@extends('admin.layout.index')

@section('content')
    <div class="col-md-12 d-flex flex-wrap justify-content-around">
        <div class="position-relative dashboard-btn-container" id="new-order" onclick="nOrder(0)">
            <div class="card card-btn bg-primary">
                <div class="card-body m-auto py-3">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="material-icons fs-1 p-0 m-0 text-white">
                            list_alt
                        </span>
                    </div>
                </div>
                <div class="card-footer dashboard-btn-footer text-center py-1 bg-dark">
                    <h5 class="mb-0 text-white">New Order</h5>
                </div>
            </div>
            <div class="bar-selected bg-primary" id="bar-nOrder" style="display: none">
            </div>
            @if ($nOrderCount)
                <div class="dash-circle">{{$nOrderCount}}</div>
            @endif
        </div>                                 
        <div class="position-relative dashboard-btn-container" id="new-member" onclick="nMember(0)">
            <div class="card card-btn bg-success">
                <div class="card-body m-auto py-3">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="material-icons fs-1 p-0 m-0 text-white">
                            people
                        </span>
                    </div>
                </div>
                <div class="card-footer dashboard-btn-footer text-center py-1 bg-dark">
                    <h5 class="mb-0 text-white">New Member</h5>
                </div>
            </div>
            <div class="bar-selected bg-success" id="bar-nMember" style="display: none">
            </div>
            @if ($nMemberCount)
                <div class="dash-circle bg-warning">{{$nMemberCount}}</div>
            @endif
        </div>                                 
        <div class="position-relative dashboard-btn-container" id="new-transaction" onclick="nTransaction(0)">
            <div class="card card-btn bg-warning">
                <div class="card-body m-auto py-3">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="material-icons fs-1 p-0 m-0 text-white">
                            paid
                        </span>
                    </div>
                </div>
                <div class="card-footer dashboard-btn-footer text-center py-1 bg-dark">
                    <h5 class="mb-0 text-white">New Transaction</h5>
                </div>
            </div>
            <div class="bar-selected bg-warning" id="bar-nTransaction" style="display: none">
            </div>
            @if ($nTransactionCount)
                <div class="dash-circle bg-success">{{$nTransactionCount}}</div>
            @endif
        </div>
        <div class="position-relative dashboard-btn-container" id="new-custom" onclick="nCustom(0)">
            <div class="card card-btn bg-danger">
                <div class="card-body m-auto py-3">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="material-icons fs-1 p-0 m-0 text-white">
                            mail
                        </span>
                    </div>
                </div>
                <div class="card-footer dashboard-btn-footer text-center py-1 bg-dark">
                    <h5 class="mb-0 text-white">New Request</h5>
                </div>
            </div>
            <div class="bar-selected bg-danger" id="bar-nCustom" style="display: none">
            </div>
            @if ($nCustomCount)
                <div class="dash-circle bg-primary">{{$nCustomCount}}</div>
            @endif
        </div>
    {{------------------------------------ card for data -----------------------------------}}
        <div class="card dashboard-data-card col-md-12 mt-4 card-new-order" id="card-new-order" style="display: none">
            <div class="card-header d-flex justify-content-between bg-primary text-white">
                <div class="title dashboard-table-title">
                    <h3>New Order</h3>
                </div>
                <div class="title">
                    <button type="button" class="btn" id="btn-close-nOrder" onclick="nOrder(1)"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-responsive dashboard-table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Code</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Package</th>
                            <th class="text-center">Name</th>
                            <th class="text-center dashboard-hide">People</th>
                            <th class="text-center dashboard-hide">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($nOrder->isEmpty())
                            <tr class="text-center">
                                <td></td>
                            </tr>
                        @else
                            @foreach ($nOrder as $y => $x)
                            <tr class="align-middle bg-{{$x->checked === 1 ? 'success' : ''}}">
                                <td class="text-center">{{++$y}}</td>
                                <td class="text-center">{{$x->booking_code}}</td>
                                <td class="text-center">{{$x->departure_date}}</td>
                                <td class="text-center">{{$x->package_name}}</td>
                                <td class="text-center">{{$x->name}}</td>
                                <td class="text-center dashboard-hide">
                                    {{$x->number_of_adult}}/{{$x->number_of_child}}/{{$x->number_of_infant}}
                                </td>
                                <td class="text-center dashboard-hide">
                                    <span class="px-1 text-bg-{{$x->payment_status === 0 ? 'success' : ''}}">{{$x->payment_status === 0 ? 'Paid' : 'Not Paid'}}</span>                                
                                </td>                                
                                <td class="text-center">
                                    <button class="btn btn-info px-2 pb-0 viewOrderModal" data-id="{{$x->id}}" onclick="newOrder(0)">
                                        <span class="material-icons dashboard-view-btn">
                                            visibility
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif                                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card dashboard-data-card col-md-12 mt-4 card-new-member" id="card-new-member" style="display: none">
            <div class="card-header d-flex justify-content-between bg-success text-white">
                <div class="title dashboard-table-title">
                    <h3>New Member</h3>
                </div>
                <div class="title">
                    <button type="button" class="btn" id="btn-close-nMember" onclick="nMember(1)"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-responsive dashboard-table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Photo</th>
                            <th class="text-center">User Code</th>
                            <th class="text-center">Name</th>
                            <th class="text-center dashboard-hide">Phone</th>
                            <th class="text-center dashboard-hide">Join Date</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($nMember->isEmpty())
                            <tr class="text-center">
                                <td></td>
                            </tr>
                        @else
                            @foreach ($nMember as $y => $x)
                            <tr class="align-middle bg-{{$x->checked === 1 ? 'success' : ''}}">
                                <td class="text-center">{{++$y}}</td>
                                <td class="text-center">
                                    <div class="dashboard-photo-prev">
                                        <img src="{{asset('storage/user/'.$x->profile_photo)}}" alt="">
                                    </div>
                                </td>
                                <td class="text-center">{{$x->user_code}}</td>
                                <td class="text-center">{{$x->name}}</td>
                                <td class="text-center dashboard-hide">{{$x->phone}}</td>
                                <td class="text-center dashboard-hide">{{$x->created_at->format('Y-m-d')}}</td>
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
                                    <button class="btn btn-info px-2 pb-0 viewUserModal" data-id="{{$x->id}}">
                                        <span class="material-icons dashboard-view-btn">
                                            visibility
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif                                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card dashboard-data-card col-md-12 mt-4 card-new-transaction" id="card-new-transaction" style="display: none">
            <div class="card-header d-flex justify-content-between bg-warning text-white">
                <div class="title dashboard-table-title">
                    <h3>New Transaction</h3>
                </div>
                <div class="title">
                    <button type="button" class="btn" id="btn-close-nTransaction" onclick="nTransaction(1)"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-responsive dashboard-table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Code</th>
                            <th class="text-center">Name</th>
                            <th class="text-center dashboard-hide">Total Payment</th>
                            <th class="text-center dashboard-hide">Payment Method</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($nTransaction->isEmpty())
                            <tr class="text-center">
                                <td></td>
                            </tr>
                        @else
                            @foreach ($nTransaction as $y => $x)
                            <tr class="align-middle bg-{{$x->checked === 1 ? 'success' : ''}}">
                                <td class="text-center">{{++$y}}</td>
                                <td class="text-center">{{$x->created_at->format('Y-m-d')}}</td>
                                <td class="text-center">{{$x->transaction_code}}</td>
                                <td class="text-center">{{$x->name}}</td>
                                <td class="text-center dashboard-hide">{{number_format($x->payment_total)}}</td>
                                <td class="text-center dashboard-hide">{{$x->payment_method}}</td>
                                <td class="text-center">
                                    <button class="btn btn-info px-2 pb-0 viewTransactionModal" data-id="{{$x->id}}">
                                        <span class="material-icons dashboard-view-btn">
                                            visibility
                                        </span>
                                    </button>                                
                                </td>
                            </tr>
                            @endforeach
                        @endif                    
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card dashboard-data-card col-md-12 mt-4 card-new-custom" id="card-new-custom" style="display: none">
            <div class="card-header d-flex justify-content-between bg-danger text-white">
                <div class="title dashboard-table-title">
                    <h3>New Custom Tour Request</h3>
                </div>
                <div class="title">
                    <button type="button" class="btn" id="btn-close-nCustom" onclick="nCustom(1)"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-responsive dashboard-table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center dashboard-hide">Email</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Request</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($nCustom->isEmpty())
                            <tr class="text-center">
                                <td></td>
                            </tr>
                        @else
                            @foreach ($nCustom as $y => $x)
                            <tr class="align-middle bg-{{$x->checked === 1 ? 'warning' : ''}}">
                                <td class="text-center" style="vertical-align: top">{{++$y}}</td>
                                <td class="text-center dashboard-hide" style="vertical-align: top">{{$x->user_email}}</td>
                                <td class="text-center" style="vertical-align: top">{{$x->subject}}</td>
                                <td class="overflow-hidden" style="height: 20px">{!! $x->description !!}</td>
                                <td class="text-center" style="vertical-align: top">
                                    <button type="button" class="btn btn-info px-2 pb-0 viewCustom" data-id="{{$x->id}}">
                                        <span class="material-icons dashboard-view-btn">
                                            visibility
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif                                        
                    </tbody>
                </table>
            </div>
        </div>                                 
    </div>
    {{------------------------------------ Chart -----------------------------------}}

    <div class="col-md-12 mt-5 mb-3" id="chart">
        <canvas id="chart-order"></canvas>
    </div>

    
    <div class="showViewUser" style="display: none"></div>
    <div class="showViewOrder" style="display: none"></div>
    <div class="showViewTransaction" style="display: none"></div>
    <div class="showViewCustom" style="display: none"></div>
    <div class="showViewAdvice" style="display: none"></div>


    <script>
        $('.viewUserModal').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('viewUserModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showViewUser').html(response).show();
                    $('#viewUserModal').modal('show');
                }
            });
        })
        $('.viewOrderModal').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('viewOrderModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showViewOrder').html(response).show();
                    $('#viewOrderModal').modal('show');
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
                    $('.showViewTransaction').html(response).show();
                    $('#viewTransactionModal').modal('show');
                }
            });
        })
        $('.viewCustom').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('viewCustomModal', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showViewCustom').html(response).show();
                    $('#viewCustomTourModal').modal('show');
                }
            });
        })
        function nOrder(x){
            if (x == 0) document.getElementById("card-new-order").style.display = "flex",
                        document.getElementById("bar-nOrder").style.display = "flex",
                        document.getElementById("bar-nMember").style.display = "none",
                        document.getElementById("bar-nTransaction").style.display = "none",
                        document.getElementById("bar-nCustom").style.display = "none",
                        document.getElementById("card-new-member").style.display = "none",
                        document.getElementById("card-new-transaction").style.display = "none",
                        document.getElementById("card-new-custom").style.display = "none",
                        document.getElementById("chart").style.display = "none";
            else document.getElementById("card-new-order").style.display = "none",
                document.getElementById("bar-nOrder").style.display = "none",
                document.getElementById("chart").style.display = "block";
            return;
        }
        function nMember(x){
            if (x == 0) document.getElementById("card-new-member").style.display = "flex",
                        document.getElementById("bar-nMember").style.display = "flex",
                        document.getElementById("bar-nOrder").style.display = "none",
                        document.getElementById("bar-nCustom").style.display = "none",
                        document.getElementById("bar-nTransaction").style.display = "none",
                        document.getElementById("card-new-order").style.display = "none",
                        document.getElementById("card-new-transaction").style.display = "none",
                        document.getElementById("card-new-custom").style.display = "none",
                        document.getElementById("chart").style.display = "none";
            else document.getElementById("card-new-member").style.display = "none",
                document.getElementById("bar-nMember").style.display = "none",
                document.getElementById("chart").style.display = "block";
            return;
        }
        function nTransaction(x){
            if (x == 0) document.getElementById("card-new-transaction").style.display = "flex",
                        document.getElementById("bar-nTransaction").style.display = "flex",
                        document.getElementById("bar-nOrder").style.display = "none",
                        document.getElementById("bar-nMember").style.display = "none",
                        document.getElementById("bar-nCustom").style.display = "none",
                        document.getElementById("card-new-order").style.display = "none",
                        document.getElementById("card-new-member").style.display = "none",
                        document.getElementById("card-new-custom").style.display = "none",
                        document.getElementById("chart").style.display = "none";
            else document.getElementById("card-new-transaction").style.display = "none",
                document.getElementById("bar-nTransaction").style.display = "none",
                document.getElementById("chart").style.display = "block";
            return;
        }
        function nCustom(x){
            if (x == 0) document.getElementById("card-new-custom").style.display = "flex",
                        document.getElementById("bar-nCustom").style.display = "flex",
                        document.getElementById("bar-nOrder").style.display = "none",
                        document.getElementById("bar-nMember").style.display = "none",
                        document.getElementById("bar-nTransaction").style.display = "none",
                        document.getElementById("card-new-order").style.display = "none",
                        document.getElementById("card-new-member").style.display = "none",
                        document.getElementById("card-new-transaction").style.display = "none",
                        document.getElementById("chart").style.display = "none";
            else document.getElementById("card-new-custom").style.display = "none",
                document.getElementById("bar-nCustom").style.display = "none",
                document.getElementById("chart").style.display = "block";
            return;
        }
            var ctx = document.getElementById('chart-order').getContext('2d');
            var orderChart = new Chart(ctx,{
                type: 'bar',
                data:{
                    labels: {!! json_encode($labels) !!},
                    datasets: {!! json_encode($datasets) !!}
                },
            });
    </script>
@endsection