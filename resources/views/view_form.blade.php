@extends('layouts.layout')

@section('css')
    <style>
        i {
            display: inline-block;
            font-size: 20px;
            width: auto;
            text-align: left;
            color: #4B49AC;
        }
        a#DeleteAllSelectRec {
            padding: 12px 26px;
        }
    </style>
@endsection

@section('title','View Form')


@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h4 class="card-title">Form Table</h4>
                                <a href="#" class="btn btn-danger" id="DeleteAllSelectRec">Delete</a>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="searchdata" name="search" placeholder="Search now">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll"></th>
                                        <th>Id</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Address</th>
                                        <th>Pin Code</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Multiple Image</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($FormRecord as $formRec)
                                        <tr id="formId{{ $formRec->id }}"> 
                                            <td><input type="checkbox" class="checkboxclass" name="ids" value="{{ $formRec->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $formRec->first_name }}</td>
                                            <td>{{ $formRec->last_name }}</td>
                                            <td>{{ $formRec->email }}</td>
                                            <td>{{ $formRec->phone }}</td>
                                            <td>{{ $formRec->gender }}</td>
                                            <td>{{ $formRec->state }}</td>
                                            <td>{{ $formRec->city }}</td>
                                            <td>{{ $formRec->address }}</td>
                                            <td>{{ $formRec->pincode }}</td>
                                            <td>{{ $formRec->description }}</td>
                                            <td><img src="admin/images/{{ $formRec->image }}" width="50px" height="50px"></td>
                                            <td>
                                                @foreach(explode(',',$formRec->mimages) as $mim)
                                                    <img src="{{URL::to('admin/mimages/'.$mim)}}" width="50px" height="50px">
                                                @endforeach
                                            </td>
                                            <td><a href="{{ url("/delete-field/$formRec->id")}}" class="delete-confirm"><i class="mdi mdi-delete"></i></a></td>
                                            <td><a href="{{ url("/edit-field/$formRec->id")}}" class="edit-confirm"><i class="mdi mdi-border-color"></i></a></td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td colspan="15">
                                              {!! $FormRecord->links() !!}
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        // Print Delete  Msg
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure ?',
                icon: 'error',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });


        // Live Searching
        $('#searchdata').on('keyup', function (event) {
            var search = $(this).val();
            $.ajax({
                url: '{{ url('search') }}',
                type: 'GET',
                data: {'search':search},
                success: function(data)
                {
                    $('tbody').html(data);
                }
            });
        });


        // Multiple Delete Record
        $(function(e){
            $('#checkAll').click(function(){
                $('.checkboxclass').prop('checked', $(this).prop('checked'));
            });

            
            $('#DeleteAllSelectRec').click(function(e){
                e.preventDefault();
                var allids = [];
                
                $('input:checkbox[name=ids]:checked').each(function(){
                    allids.push($(this).val());
                });
                 
                
                $.ajax({
                    url: '{{ route('deleteSelected') }}',
                    type: 'DELETE', 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {ids:allids},
                    success:function(response){
                        $.each(allids,function(key,val){
                            $('#formId'+val).remove();
                        });
                    }
                });

            });
        });

    </script>

    {{-- Print Success Msg --}}
    @if(session('msg'))
    <script>
        swal({
            title: "Data Updated Succsessfully !",
            icon: "success",
            timer: 2000,
        });
    </script>
    @endif


@endsection


