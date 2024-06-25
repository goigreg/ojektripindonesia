@extends('admin.layout.index')

@section('content')
<div class="card mb-1">
    <div class="card-body d-flex flex-row justify-content-between">
        <form action="/admin/message/filter" method="GET">
            <div class="filter d-flex flex-lg-row gap-3">
                <input type="date" class="form-control" name="startDate" value="{{ isset($start_date) ? $start_date : ''}}" required>
                <input type="date" class="form-control" name="endDate" value="{{ isset($end_date) ? $end_date : ''}}" required>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="/admin/message" class="btn btn-danger {{Request::path() == 'admin/message' ? 'collapse' : '';}}">Back</a>
            </div>
        </form>
        <form action="/admin/message/search" method="GET">
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
                        <th class="text-center">name</th>
                        <th class="text-center">message</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                        <tr class="text-center">
                            <td></td>
                        </tr>
                    @else
                        @foreach ($newData as $y => $x)
                        <tr class="align-middle bg-warning">
                            <td class="text-center" style="vertical-align: top">{{$x->name}}</td>
                            <td class="overflow-hidden" style="height: 20px">{{$x->message}}</td>
                            <td class="text-center" style="vertical-align: top">
                                <button type="button" class="btn btn-info viewMessage px-2 pb-0" data-id="{{$x->id}}">
                                    <span class="material-icons">
                                        visibility
                                    </span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @foreach ($viewedData as $y => $x)
                        <tr class="align-middle">
                            <td class="text-center" style="vertical-align: top">{{$x->name}}</td>
                            <td class="overflow-hidden" style="height: 20px; vertical-align: top">{{$x->message}}</td>
                            <td class="text-center" style="vertical-align: top">
                                <button type="button" class="btn btn-info viewMessage px-2 pb-0" data-id="{{$x->id}}">
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
    <div class="showviewMessage" style="display: none"></div>

    <script>
        $.ajaxSetup({
            headers:{
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        })

        $('.viewMessage').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{route('viewMessage', ['id'=> ':id'])}}".replace(':id',id),
                success: function (response) {
                    $('.showviewMessage').html(response).show();
                    $('#viewMessageModal').modal('show');
                }
            });
        })
    </script>
@endsection