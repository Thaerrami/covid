@extends('patient.editprofile')

@section('content')




  <div class="col-12  p-3 rounded shadow" style="background: rgb(221, 231, 235)">
    <form class="form-horizontal w-100" role="form" id="submit" method="POST"  >
        @csrf
    <div class="form-group w-100">
      <div class="text-black-50 " style="font-size: 1.2em">Change Password</div>
      <Label class="w-100 p-1 text-danger " id="alert" ></Label>
        <label class=" control-label w-100" name='password'>Password:</label><br>
        <div class=" w-100">
          <input class="w-100 form-control" name='password' id="password" type="password" >
        </div>
      </div>
      <div class="form-group w-100">
        <label class=" control-label w-100">Confirm password:</label><br>
        <div class="w-100">
          <input class="w-100 form-control" name='confirm' id="confirm" type="password" >
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-8">
          <input type="submit" class="btn btn-primary" value="Save Changes">
          <span></span>
          
        </div>
      </div>
    </form>
</div>


<script>


  $("#submit").on('submit',(e)=>{
    e.preventDefault();
  
    var password = $('#password').val();
    var confirm = $('#confirm').val();
   
    if(password !== confirm || password.length < 6){
      $('#alert').text('password  not match or shorter than 6 characters');
      
    }else
    {
       $.ajax({
         method:'POST',
         url:"./edituserprofile",
         data:{
            _token: '{{csrf_token()}}',
            password:password,
            confirm:confirm
         },
         success:(data)=>{
           alert('password updated successfuly');
           $('#alert').text('');
         error:(error)=>{
           console.log(error)
         }}})}})
     
  
       
      </script>


@endsection


<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

