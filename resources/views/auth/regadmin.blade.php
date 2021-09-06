@extends('frontend.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('regadmin') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name"  required autocomplete="name" autofocus>
                            </div>
                        </div>
                      <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email"  required autocomplete="last_name" autofocus>

                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password"  required>

                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone_No</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control " name="phone" required autocomplete="phone_no">

                                
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
