@extends('layouts.dashboard')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('dashboard-content')
    <h1>Bid History</h1>
    <table border="0" cellspacing="" cellpadding="">
        <tbody>
            <tr>
                <td><strong>Product SKU :</strong></td>
                &nbsp;
                <td>
                    <div class="input-group">
                        <Label>{{$currentWinningBid->listing->product_id}}</Label>
                    </div>
                </td>
            </tr>
            <tr>
                <td><strong>Current winner name :</strong></td>
                <td>
                    <div class="input-group">
                        <Label>{{$currentWinningBid->user->name}}</Label>
                    </div>
                </td>
            </tr>
            <tr>
                <td><strong>Current winner email :</strong></td>
                <td>
                    <div class="input-group">
                        <Label>{{$currentWinningBid->user->email}}</Label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    &nbsp;
    <table class="dashboard-table" id="dashboard-table">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Bid Amount</th>
                <th>Time</th>
                <th>Remove</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bids as $bid)
            <tr>
                <td>{{$bid->user->name}}</td>
                <td>{{$bid->user->email}}</td>
                <td>{{ Currency::format($bid->bid_amount) }}</td>
                <td>{{ $bid->updated_at }} </td>
                <form action="{{route('dashboard.auctions.destroy-bid',['bid'=>$bid->id])}}" method="post">
                    @csrf
                    @method('delete')
                    <td>
                        <div class="checkbox" >
                            <label>
                                <input type="checkbox" name="remove" style="margin-left: 1px" required>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </div>
                    </td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>

        $(document).ready( function () {
            let dataTable = $('#dashboard-table').DataTable({
                // "processing": true,
                // "serverSide": true,
                // "drawCallback": function( settings ) {

                //     },
                // "ajax":{
                //         "url": "{{ route('dashboard.auctions.ajax') }}",
                //         "dataType": "json",
                //         "type": "POST",
                //         "data": function (data) {
                //             data._token = "{{csrf_token()}}"
                //             data.from = from
                //             data.to = to
                //         }
                //     },
                // "columns": [
                //     { "data": "user_name" },
                //     { "data": "email" },
                //     { "data": "bid_amount" },
                //     { "data": "time" },
                //     { "data": "remove" },
                //     { "data": "update" }
                // ]
            });

        } );
    </script>

@endsection