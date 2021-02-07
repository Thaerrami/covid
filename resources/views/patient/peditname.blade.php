@extends('patient.editprofile')


@section('content')
<form id="submit" method="POST">
    @csrf
<div class="row">                  
    <div class="col">
      <div class="form-group">
        <label>Username</label>
        <input class="form-control" required type="text" name="username" id="username" placeholder={{Auth::user()->name}} value={{Auth::user()->name}} >
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col d-flex justify-content-end">
      <button class="btn btn-primary" type="submit">Save Changes</button>
    </div>
  </div>
</form>


<script>

  $("#submit").on('submit',(e)=>{
    e.preventDefault();
  
    var username = $('#username').val();

    
       $.ajax({
         method:'POST',
         url:"./edituserprofile",
         data:{
            _token: '{{csrf_token()}}',
            username:username,
         },
         success:(data)=>{
           alert('username successfuly updated');
         },
         error:(error)=>{
           console.log(error)
         }
       }
     )
     
    });
       
      </script>



@endsection