@extends('doctor.edittemplate')

@section('content')
@parent


<div class="col-md-6 w-100">
  <div class="col-md-12 p-5 rounded shadow" style="background: rgb(221, 231, 235)">
    <form class="form-horizontal w-100" role="form" id="submit" method="POST"  >
        @csrf

        @if (isset($fail))
            <input type="text"  value="{{$fail}}" disabled  class="form-control">
        @endif

    <div class="form-group w-100">
      <div class="text-black-50 " style="font-size: 2em">change Password</div>
      <Label class="w-100 p-2 text-danger " id="alert" ></Label>
        <label class="col-md-3 control-label" name='password'>Password:</label><br>
        <div class="col-md-8 w-100">
          <input class="w-100 form-control" name='password' id="password" type="password" >
        </div>
      </div>
      <div class="form-group w-100">
        <label class="col-md-3 control-label">Confirm password:</label><br>
        <div class="col-md-8 w-100">
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
   
    if(password !== confirm){
      $('#alert').text('password  not match');
      
    }else
    {
       $.ajax({
         method:'POST',
         url:"{{ route('doc.updatedata') }}",
         data:{
            _token: '{{csrf_token()}}',
            password:password,
            confirm:confirm
         },
         success:(data)=>{
           alert('password updated successfuly');
           $('#password').val();
           $('#confirm').val();
           $('#alert').text('');
         },
         error:(error)=>{
           console.log(error)
         }
       }
     )
    }
     
    });
       
      </script>

@endsection