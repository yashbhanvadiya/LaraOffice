@extends('layouts.layout')

@section('title','Students')

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


@section('content')

<div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">

                {{-- Button trigger modal --}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
                    Create Student
                </button>
                
                {{-- Add Students Modal --}}
                <div class="modal fade" id="studentaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Student Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="addform">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="fname">
                                    </div>

                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="lname">
                                    </div>

                                    <div class="form-group form-check">
                                        <label>Course</label>
                                        <input type="text" class="form-control" name="course">
                                    </div>

                                    <div class="form-group form-check">
                                        <label>Section</label>
                                        <input type="text" class="form-control" name="section">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Student</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                {{-- Edit Students Modal --}}
                <div class="modal fade" id="studenteditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Student Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="editform">
                                @csrf
                                {{ method_field('PUT') }}

                                <input type="hidden" id="id" name="id">

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="fname" id="fname">
                                    </div>

                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="lname" id="lname">
                                    </div>

                                    <div class="form-group form-check">
                                        <label>Course</label>
                                        <input type="text" class="form-control" name="course" id="course">
                                    </div>

                                    <div class="form-group form-check">
                                        <label>Section</label>
                                        <input type="text" class="form-control" name="section" id="section">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Edit Student</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <br><br>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Course</th>
                            <th>Section</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->fname }}</td>
                                <td>{{ $student->lname }}</td>
                                <td>{{ $student->course }}</td>
                                <td>{{ $student->section }}</td>
                                <td class="text-center"><a href="#" class="edit-confirm editbtn"><i class="mdi mdi-border-color"></i></a></td>
                                <td class="text-center"><a href="#" class="delete-confirm deletebtn"><i class="mdi mdi-delete"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
          </div>
        </div>
      </div>
    </div>


@endsection



@section('js')

<script>

    // Insert Data
    $(document).ready(function(){

        $('#addform').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "/addstudent",
                data: $('#addform').serialize(),
                success: function (response) {
                    console.log(response)
                    $('#studentaddmodal').modal('hide');
                    alert("Data Saved");
                },
                err:or function (error){
                    console.log(error)
                    alert("Data not saved");
                    location.reload()
                }
            });
        });

    });

</script>

<script>

    // webslesson.info
    // Update Data
    $(document).ready(function(){

        $('.editbtn').on('click', function(e){
            $('#studenteditmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children('td').map(function(){
                return $(this).text();
            }).get();

            console.log(data);

            $('#id').val(data[0]);
            $('#fname').val(data[1]);
            $('#lname').val(data[2]);
            $('#course').val(data[3]);
            $('#section').val(data[4]);
        });

        $('#editform').on('submit', function(e){ 
            e.preventDefault();

            var id = $('#id').val();

            $.ajax({
                type: "PUT",
                url: "/studentedit/"+id,
                data: $("#editform").serialize(),
                success: function(response) {
                    console.log(response);
                    $('#studenteditmodal').modal('hide');
                    alert('Data Updated');
                    location.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    });

</script>

@endsection