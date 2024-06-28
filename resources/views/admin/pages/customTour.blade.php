@extends('admin.layout.index')

@section('content')
    <div class="card custom-tour-card mb-1">
        <div class="card-body d-flex flex-row justify-content-between">
            <form action="/admin/customTour/filter" method="GET">
                <div class="filter d-flex flex-lg-row gap-3">
                    <input type="date" class="form-control" name="startDate" value="{{ isset($start_date) ? $start_date : ''}}" required>
                    <input type="date" class="form-control" name="endDate" value="{{ isset($end_date) ? $end_date : ''}}" required>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="/admin/customTour" class="btn btn-danger {{Request::path() == 'admin/customTour' ? 'collapse' : '';}}">Back</a>
                </div>
            </form>
            <form action="/admin/customTour/search" method="GET">
                <div class="d-flex flex-lg-row gap-3 justify-content-between">
                    <input type="search" class="form-control" name="search" style="width: 250px" 
                    placeholder="Search...." value="{{ isset($search) ? $search : ''}}" required>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>                
            </form>
        </div>
    </div>
    <div class="card custom-tour-card rounded-full">
        <div class="card-body">
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Subject</th>
                        <th class="text-center">Request</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $y => $x)
                    <tr class="align-middle bg-{{$x->checked === 1 ? 'warning' : ''}}">
                        <td class="text-center" style="vertical-align: top">{{++$y}}</td>
                        <td class="text-center" style="vertical-align: top">{{$x->user_email}}</td>
                        <td class="text-center" style="vertical-align: top">{{$x->subject}}</td>
                        <td class="overflow-hidden" style="height: 20px">{!! $x->description !!}</td>
                        <td class="text-center" style="vertical-align: top">
                            <button type="button" class="btn btn-info px-2 pb-0 viewCustom" data-id="{{$x->id}}">
                                <span class="material-icons">
                                    visibility
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
        </div>
    </div>
    <div class="showViewCustom" style="display: none"></div>

    <script>        
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
    </script>
@endsection