@extends('layout/main')
@section('content')

    <div class="container">
        <h2 class="mb-2">
            Search
        </h2>

        <div class="table-responsive">
            <table id="txTable" class="table table-striped table-bordered image-table" style="width:100%">
            </table>
        </div>

        <div id="sum" class="text-right mb-5"></div>
    </div>

    <script>
        $(document).ready(function () {
            var table = $('#txTable')
            .on('xhr.dt', function ( e, settings, json, xhr ) {
                if (json.sum && json.sum > 0)
                    $("#sum").html("Total Amount : " + json.sum.toFixed(2));
            } ).DataTable({
                responsive: true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('usertransactions')}}",
                    method:"post",                    
                    data: function(d) {
                    },
                },
                "paging": false,
                "columns" : [
                    {title: "No", data: "no", orderable: false},
                    {title: "Txhash", data: "txhash", orderable: false},
                    {title: "DateTime", data: "datetime", orderable: false},
                    {title: "Amount", data: "amount", orderable: false},
                ],
                "order": []                
              });
            $('.dataTables_filter input[type="search"]').css(
                    {'width':'350px','display':'inline-block'}
            );
        });
    </script>
@endsection
