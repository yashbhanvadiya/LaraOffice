<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ URL::to('https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}">
    <style>
        th {
            text-align: left;
        }
        .dt-buttons button.dt-button {
            background: #c4d1e6;
            padding: 9px 22px;
            margin: 0 2px;
            border-radius: 6px;
            border: 1px solid #b089b2;
        }
    </style>
</head>
<body>

    <h2>Export File</h2>

    {{-- <a href="/file_export" class="btn btn-primary">Export File</a><br><br> --}}
    <a href="/excel_export" class="btn btn-primary">Export File</a><br><br>
    
    <table class="table table-striped" id="multipleRecord" width="100%">

        <thead>
          <tr>
            <th>id</th>
            <th>Book Name</th>
            <th>Bok Price</th>
            <th>Created At</th>
            <th>Updated At</th>
          </tr>
        </thead>

        <tbody>   
             
        </tbody>

     </table><br><br><br>


    <h2>Import File</h2>

    @if(Session('msg'))
        <div class="alert alert-success">
          {{ Session('msg') }}
        </div>
    @endif
    
    <form action="{{ url('/import-form') }}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file">
        <input type="submit" name="submit" value="upload">

    </form>
    <br/><br/><br/><br/><br/><br/><br/><br/>


    <script src="{{ URL::to('https://code.jquery.com/jquery-3.5.1.js') }}"></script>
    <script src="{{ URL::to('https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
    <script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
    <script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
    <script src="{{ URL::to('https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::to('https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#multipleRecord').DataTable({
                serverSide : true,
                ajax : {
                    url : '{{ url('data_load')}}',
                },
                searching : true,
                scrollCollapse : true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                columns : [
                    {data: 'id', class: 'id'},
                    {data: 'book_name', class: 'book_name'},
                    {data: 'book_price', class: 'book_price'},
                    {data: 'created_at', class: 'created_at'},
                    {data: 'updated_at', class: 'updated_at'}
                ]
            });
        });
    </script>


</body>
</html>