<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .hotelrow{
            width: 100%;
        }
        .hotelbox1{
            background-color: #dcbcbc;
            width: 100%;
            height: 500px;
        }
        form#myForm {
            justify-content: center;
            height: 100%;
        }
        .hotelbox2{
            background-color: #c5dcbc;
            width: 100%;
            height: 500px;
        }
        .hotelbox3{
            background-color: #bcd2dc;
            width: 100%;
            height: 500px;
        }
        .hotelbox4{
            background-color: #c5bcdc;
            width: 100%;
            height: 500px;
        }
        .accommodation{
            display: flex;
            align-items: center;
        }
        .accommodation input{
            width: 20%;;
        }
    </style>
</head>
<body>

    <div class="hotel">
        <div class="row hotelrow">
            <div class="col-lg-3 hotelbox1">
                <form class="form-inline" id="myForm">
                    <button type="submit" class="btn btn-primary">Model</button>
                </form>
            </div>
            <div class="col-lg-3 hotelbox2">
                <p>Hotel Name: $</p> 
                <p>Hotel Type: </p> 
                <p>Country: </p>
                <p>State: </p>
                <p>City: </p>
                <p>Hotel Accommodation: </p> 
                <p>Hotel Image: </p> 
            </div>
            <div class="col-lg-3 hotelbox3"></div>
            <div class="col-lg-3 hotelbox4"></div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <form id="contactForm" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Hotel name</label>
                            <input type="text" name="hotelname" class="form-control" placeholder="Hotel Name" id="hotelname">
                        </div>
                
                        <div class="form-group">
                            <label>Hotel Type</label>
                            <select name="hoteltype" id="hoteltype">
                                <option value="">--Select Type--</option>
                                <option value="3star">3 Star</option>
                                <option value="4star">4 Star</option>
                                <option value="5star">5 Star</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Country</label>
                            <select name="country" id="country">
                                <option value="">--Select Country--</option>
                                <option value="india">India</option>
                                <option value="australia">Australia</option>
                                <option value="usa">USA</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>State</label>
                            <select name="state" id="state">
                                <option value="">--Select State--</option>
                                <option value="gujarat">Gujarat</option>
                                <option value="rajasthan">Rajasthan</option>
                                <option value="goa">Goa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <select name="city" id="city">
                                <option value="">--Select City--</option>
                                <option value="surat">Surat</option>
                                <option value="rajkot">Rajkot</option>
                                <option value="vadodara">Vadodara</option>
                            </select>
                        </div>

                        <label>Hotel Accommodation</label>
                        <div class="form-group accommodation" id="accomodation">
                            <input type="checkbox" name="accommodation[]" value="bed" class="form-control accommodation" id="bed">Bed
                            <input type="checkbox" name="accommodation[]" value="tv" class="form-control accommodation" id="tv">TV
                            <input type="checkbox" name="accommodation[]" value="hitter" class="form-control accommodation" id="hitter">Hitter
                            <input type="checkbox" name="accommodation[]" value="ac" class="form-control accommodation" id="ac">AC
                            <input type="checkbox" name="accommodation[]" value="bathroom" class="form-control accommodation" id="bathroom">Bathroom
                        </div>

                        <div class="form-group model_img">
                            <label>Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" id="submit">Submit</button>
                        </div>
                        
                    </form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
    


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

    $('#myForm').on('submit', function(e){
    $('#myModal').modal('show');
    e.preventDefault();
    });

    //form
    $(document).on('submit','#contactForm',function(event){
        event.preventDefault();

        let checkboxs_value = [];
        $('.accommodation').each(function(){  
            if(this.checked) {              
                 checkboxs_value.push($(this).val());                                                                               
            }  
        });  
        checkboxs_value = checkboxs_value.toString();

        var data = new FormData();

        //Form data
        var form_data = $('#contactForm').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });


        var file_data = $('input[name="image"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("image", file_data[i]);
        }
           
        //Custom data
        data.append('key', 'value');

        $.ajax({
            url: "/contact-form",
            method: "post",
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                if(response){
                    $('.hotelbox2').prepend('<p> </p>')
                }
            },
            error: function (e) {
                //error
            }
        });

        
        // console.log(data);
       /* var form = $(this);
        var files = $('#image').files;
        console.log(files);
        form.append('image',files);

        let hotelname = $('#hotelname').val();
        let hoteltype = $('#hoteltype').val();
        let country = $('#country').val();
        let state = $('#state').val();
        let city = $('#city').val();
        let accommodation = checkboxs_value.toString();
        // let Image = $('#image').val();
        
        $.ajax({
        url: "/contact-form",
        type:"POST",
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: form.serialize(),
            // '_token': '{{ csrf_token() }}',
            // hotelname:hotelname,
            // hoteltype:hoteltype,
            // country:country,
            // state:state,
            // city:city,
            // accommodation:accommodation,
            // image:image,
        success:function(response){
            // console.log(response);
            if(response != 0){
                $("#img").attr("src",response); 
                // $(".model_img img").show(); // Display image element
            }else{
                alert('file not uploaded');
            }
        },
        });*/
    });

</script>
</body>
</html>