@extends('layouts.layout')

@section('css')
    <style>

    </style>
@endsection

@section('title','Form')

@section('content')

      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Thirdparty API Data</h4><br>
                    <div class="table-responsive pt-3">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Image</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($collection as $APIData)
                                <tr>
                                    <td>{{ $APIData['id'] }}</td>
                                    <td>{{ $APIData['email'] }}</td>
                                    <td>{{ $APIData['first_name'] }}</td>
                                    <td>{{ $APIData['last_name'] }}</td>
                                    <td><img src="{{ $APIData['avatar'] }}" alt="image" width="70px" height="70px"></td>
                                </tr>
                                @endforeach
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

@endsection