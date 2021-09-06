@extends('frontend.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First_name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control " name="first_name"  required autocomplete="first_name" autofocus>

                              
                            </div>
                        </div>
                      <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last_name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control " name="last_name"  required autocomplete="last_name" autofocus>

                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email"  required autocomplete="email">

                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-right">Phone_No</label>

                            <div class="col-md-6">
                                <input id="phone_no" type="phone_no" class="form-control " name="phone_no" required autocomplete="phone_no">

                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4  text-md-right">District</label>

                            <div class="col-md-6">
                               <select class="form-control" name="district_id" id="district_id">
                                  <option>Please select District</option
                                  <option value="1">Dhaka</option>
                                  <option value="2">Panchagarh</option>
                                 <option value="3">Kurigram</option>
                                 <option value="4">Rangpur</option>
                                 <option value="5">Khulna</option>
                                 <option value="6">Bogura</option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Thana</label>

                            <div class="col-md-6">
                               <select class="form-control" name="thana" >
                                  <option>Please select District</option
                                  <option value="1">Motijheel</option>
                                  <option value="2">Tetulia</option>
                                 <option value="3">Kurigram Sadar</option>
                                 <option value="4">Sadar</option>
                                 <option value="5">Khulna Sadar</option>
                                 <option value="6">Bogura Sibgong</option>
                               </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="street_address" class="col-md-4 col-form-label text-md-right">Street Address</label>

                            <div class="col-md-6">
                                <input id="street_address" type="street_address" class="form-control" name="street_address" required autocomplete="street_address">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

                            
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="margin-bottom: 20%">
                                   Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <script src="{{ asset('app-assets/vendors/js/core/jquery-3.2.1.min.js') }}" type="text/javascript"></script>

<script>
  
$('#district_id').change(function(){
  var district_id=$('#district_id').val();

  var opt=  $('#thana_id').html();

  $.get("http://localhost/ecomarce/register/thana/"+district_id,function(data){

    var data=JSON.parse(data);
    data.forEach(function(data){
        opt+='<option value="'+data.id+'">'+data.name+'</option>';
        console.log(data)
    });

     $('#thana_id').html(opt);
     console.log($('#thana_id').val())

  });

});

</script>
@endsection
