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
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Table</h4>
                        <div class="table-responsive pt-3">

                            <form class="forms-sample" method="post" action="{{ url('/edit_user_record') }}" enctype="multipart/form-data" id="edit_form">

                                @csrf
                                <input type="hidden" name="form_id" value="{{$user->id}}" />
            
                                <div class="form-group">
                                  <label>User Name</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{old('name') ? old('name') : Auth::user()->name}}">
                                  <span class="alert-danger">{{ $errors->first('name') }}</span>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email') ? old('email') : Auth::user()->email}}">
                                    <span class="alert-danger">{{ $errors->first('email') }}</span>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="">
                                    <span class="alert-danger">{{ $errors->first('password') }}</span>
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
                                    <span class="alert-danger">{{ $errors->first('password_confirmation') }}</span>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                                <button class="btn btn-light" id="cancle-btn" type="button">Cancel</button>
            
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    {{-- Print Success Msg --}}
    @if(session('msg'))
    <script>
        swal({
            title: "Profile Updated Succsessfully !",
            icon: "success",
            timer: 2000,
        });
    </script>
    @endif

    {{-- Form Reset --}}
    <script>
        $(document).on('click', '#cancle-btn', function(){
            $('#edit_form')[0].reset();
          });
      </script>

@endsection


