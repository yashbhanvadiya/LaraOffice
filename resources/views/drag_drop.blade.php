<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
  <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
  <style>
    th.sorting {
      text-align: left;
    }
  </style>
</head>
<body>
  
    <div class="search">
        <h3 class="text-center title-color">Drag and Drop Datatables</h3>
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <table id="table" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Status</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody id="tablecontents">
                    @foreach($tasks as $task)
                    <tr class="row1" data-id="{{ $task->id }}">
                      <td>
                        <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;" title="change display order">
                        {{ $loop->iteration }}
                        </div>
                      </td>
                      <td>{{ $task->title }}</td>
                      <td>{{ ($task->status == 1)? "Completed" : "Not Completed" }}</td>
                      <td>{{ date('d-m-Y h:m:s',strtotime($task->created_at)) }}</td>
                    </tr>
                    @endforeach
                  </tbody>                  
                </table>
            </div>
        </div> 
    </div>  








    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
 
    <!-- Datatables Js-->
    <script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

    <script type="text/javascript">
    $(function () {
      $("#table").DataTable();

         $( "#tablecontents" ).sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendOrderToServer();
        }
      });

      function sendOrderToServer() {

        var order = [];
        $('tr.row1').each(function(index,element) {
          order.push({
            id: $(this).attr('data-id'),
            position: index+1
          });
        });

        $.ajax({
          type: "POST", 
          dataType: "json", 
          url: "{{ url('/drag_drop') }}",
          data: {
            order:order,
            _token: '{{csrf_token()}}'
          },
          success: function(response) {
              if (response.status == "success") {
                console.log(response);
              } else {
                console.log(response);
              }
          }
        });

      }
    });

    </script>

</body>
</html>