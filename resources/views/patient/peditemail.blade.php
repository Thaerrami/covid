@extends('patient.editprofile')


@section('content')
<form  id="submit" method="POST">
    @csrf

<div class="row">
    <div class="col">
      <div class="form-group">
        <label>Email</label>
        <input class="form-control" type="text" name='email' id="email"  required value={{Auth::user()->email}} placeholder={{Auth::user()->email}}>
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
  
    var email = $('#email').val();

    
       $.ajax({
         method:'POST',
         url:"./edituserprofile",
         data:{
            _token: '{{csrf_token()}}',
            email:email,
         },
         success:(data)=>{
           alert('email  successfuly updated');
         },
         error:(error)=>{
           console.log(error)
         }
       }
     )
     
    });
       
      </script>


@endsection