@extends('layouts.layout')

@section('css')
    <style>
        .form-gender .controls label {
            margin-right: 10px;
        }
        select.form-control{
          color: #1f1f1f;
        }
    </style>
@endsection

@section('title','Edit Form')

@section('content')

      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                {{-- @if(Session('msg'))
                    <div class="alert alert-success">
                        {{ Session('msg') }}
                    </div>
                @endif --}}

                  <h4 class="card-title">Edit Form</h4><br>
                  <form class="forms-sample" method="post" action="{{ url('/edit_form_record') }}" enctype="multipart/form-data" id="edit_form">

                    @csrf
                    <input type="hidden" name="form_id" value="{{$FormRec->id}}" />

                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control" id="first_name" name="fname" value="{{old('fname') ? old('fname') : $FormRec->first_name}}">
                      <span class="alert-danger">{{ $errors->first('fname') }}</span>
                    </div>
                    
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" id="last_name" name="lname" value="{{old('lname') ? old('lname') : $FormRec->last_name}}">
                      <span class="alert-danger">{{ $errors->first('lname') }}</span>
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email') ? old('email') : $FormRec->email}}">
                        <span class="alert-danger">{{ $errors->first('email') }}</span>
                    </div>
                    
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="{{old('phone') ? old('phone') : $FormRec->phone}}">
                        <span class="alert-danger">{{ $errors->first('phone') }}</span>
                    </div>

                    <div class="form-group form-gender">
                        <label>Gender</label>
                        <div class="controls">
                            <label>
                            <input type="radio" name="gender" value="male" {{(old('gender') == 'male' || $FormRec->gender=='male') ? 'checked' : ''}} />
                            Male</label>
                            <label>
                            <input type="radio" name="gender" value="female" {{(old('gender') == 'female' || $FormRec->gender=='female') ? 'checked' : ''}} />
                            Female</label>
                        </div>
                        <span class="alert-danger">{{ $errors->first('gender') }}</span>
                    </div>

                    <div class="form-group">
                        <label>State</label>
                        <select name="state" id="state" class="form-control">
                            <option value="">-- Select State --</option>
                            <option value="gujarat" {{(old('state') == 'gujarat' || $FormRec->state=='gujarat') ? 'selected' : ''}}>Gujarat</option>
                            <option value="maharashtra" {{(old('state') == 'maharashtra' || $FormRec->state=='maharashtra') ? 'selected' : ''}}>Maharashtra</option>
                            <option value="rajasthan" {{(old('state') == 'rajasthan' || $FormRec->state=='rajasthan') ? 'selected' : ''}}>Rajasthan</option>
                            <option value="kerala" {{(old('state') == 'kerala' || $FormRec->state=='kerala') ? 'selected' : ''}}>Kerala</option>
                        </select>
                        <span class="alert-danger">{{ $errors->first('state') }}</span>
                    </div>

                    @php $city = array('Surat','Rajkot','Ahemdabad','Vadodara'); @endphp
                    <div class="form-group">
                        <label>City</label>
                        <select name="city" id="city" class="form-control">
                            <option value="">-- Select City --</option>
                            @foreach($city as $cities)
                                <option value="{{ $cities }}" {{(old('city') == $cities || $FormRec->city==$cities) ? 'selected' : ''}}>{{ $cities }}</option>
                            @endforeach
                        </select>
                        <span class="alert-danger">{{ $errors->first('city') }}</span>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{old('address') ? old('address') : $FormRec->address}}">
                        <span class="alert-danger">{{ $errors->first('address') }}</span>
                    </div>

                    <div class="form-group">
                        <label>Pin Code</label>
                        <input type="number" class="form-control" id="pincode" name="pincode" value="{{old('pincode') ? old('pincode') : $FormRec->pincode}}">
                        <span class="alert-danger">{{ $errors->first('pincode') }}</span>
                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="description" rows="10" name="description">{{old('description') ? old('description') : $FormRec->description}}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <img src='{{ url("/admin/images/$FormRec->image")}}' alt="image" width="40px" height="40px">
                    </div>

                    <div class="form-group">
                        <label>Multiple Image</label>
                        <input type="file" class="form-control" id="Mimage" name="mimages[]" multiple>
                            @foreach(explode(',',$FormRec->mimages) as $mim)
                                <img src="{{URL::to('admin/mimages/'.$mim)}}" width="40px" height="40px">
                            @endforeach
                    </div>

                    
                    

                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        Remember me
                      </label>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <button class="btn btn-light" id="cancle-btn" type="button">Cancel</button>

                  </form>
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
          title: "Data Updated Succsessfully !",
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