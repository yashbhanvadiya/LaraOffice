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
                        <h4 class="card-title">Form Table</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
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
                                        <tr>
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

    {{-- Print Delete  Msg --}}
    <script>

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


