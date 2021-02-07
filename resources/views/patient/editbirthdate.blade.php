@extends('patient.editprofile')

@section('content')

<form  method="POST" id="submit"> 
    @csrf
<div class="row">                    
    <div class="col">
      <div class="form-group">
        <label>Birth Of Date</label>
        <input class="form-control" required type="date" id="birthdate" name="birthdate" placeholder={{Auth::user()->birthdate}} value={{Auth::user()->birthdate}} >
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
  
    var birthdate = $('#birthdate').val();

    
       $.ajax({
         method:'POST',
         url:"./edituserprofile",
         data:{
            _token: '{{csrf_token()}}',
            birthdate:birthdate,
         },
         success:(data)=>{
           alert('birth of date successfuly');
         },
         error:(error)=>{
           console.log(error)
         }
       }
     )
     
    });
       
      </script>


@endsection