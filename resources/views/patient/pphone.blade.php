@extends('patient.editprofile')


@section('content')
<form id="submit" method="POST">
    @csrf
    <div class="row">
        <div class="col">
          <div class="form-group">
            <label>phone</label>
            <input class="form-control" minlength="6" name='phone' id="phone" type="text" required value={{Auth::user()->phone}} placeholder={{Auth::user()->phone}}>
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
  
    var phone = $('#phone').val();

    
       $.ajax({
         method:'POST',
         url:"./edituserprofile",
         data:{
            _token: '{{csrf_token()}}',
            phone:phone,
         },
         success:(data)=>{
           alert('phone successfuly updated');
         },
         error:(error)=>{
           console.log(error)
         }
       }
     )
     
    });
       
      </script>

@endsection