@extends('layouts.dashboard')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('dashboard-content')
<style>
    .shrink {
        white-space:nowrap
    }
</style>
    <h1>Auctions</h1>
    <table border="0" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <td>Date :</td>
                <td>
                    <div class="input-group">
                        <input class="form-control" name="date-range" id="date-range" type="text">
                    </div>
                </td>

            </tr>
        </tbody>
    </table>
    &nbsp;
    <table class="dashboard-table" id="dashboard-table">
        <thead>
            <tr>
                <th>Listing</th>
                <th>Expires At</th>
                <th>Bids</th>
                <th>Bids History</th>
                <th>Purchased</th>
                <th>Created at</th>
            </tr>
        </thead>
    </table>

@endsection
@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>

        let from;
        let to;
        $(document).ready( function () {
            let dataTable = $('#dashboard-table').DataTable({
                "processing": true,
                "serverSide": true,
                "drawCallback": function( settings ) {

                    },
                "ajax":{
                        "url": "{{ route('dashboard.auctions.ajax') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data": function (data) {
                            data._token = "{{csrf_token()}}"
                            data.from = from
                            data.to = to
                        }
                    },
                "columns": [
                    { "data": "listing" },
                    { "data": "expires_at" },
                    { "data": "bids" },
                    { "data": "bids_history", "orderable": false },
                    { "data": "purchased" },
                    { "data": "created_at",className: "shrink" }
                ]
            });

            $('#date-range').daterangepicker({
                autoUpdateInput: false,
                locale: { cancelLabel: 'Clear' }
            });

            $('#date-range').on('apply.daterangepicker', function(ev, picker) {
                from = picker.startDate.format('MM/DD/YYYY');
                to = picker.endDate.format('MM/DD/YYYY');
                $(this).val( from + ' - ' + to);
                dataTable.draw();
            });
            $('#date-range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                from = '';
                to ='';
                dataTable.draw();
            });

        } );
    </script>

@endsection
