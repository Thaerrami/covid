@extends('admin.edittemplate')

@section('content')

<div class="col-md-9 personal-info">
  <h3>Personal info</h3>
  
  <form class="form-horizontal" role="form" 
 id="submit"
   method="POST" autocomplete="off" 
   >
      @csrf

        <hr>
        @if ($_SERVER['HTTP_REFERER']=='http://localhost:8000/admin/editdata')
            <div class="p-2 bg-success rounded w-25 m-auto text-light" id='update' >data updated </div>
        @endif
      <div class="form-group mt-2">
      <label class="col-lg-3 control-label">Full name:</label>
      <div class="col-lg-8">
        <input class="form-control" type="text" id="username" name='username' value="{{$data['name'] ?? 'name'}}">
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-lg-3 control-label">Email:</label>
      <div class="col-lg-8">
        <input class="form-control" type="text" name='email' id="email" value="{{$data['email'] ?? 'email'}}">
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">phone:</label>
      <div class="col-lg-8">
        <input class="form-control"  type="text" name="phone" id="city" value="{{$data['phone']??'6757557'}}"  />
      </div>
    </div>


    {{-- password --}}
    
    

<input type="submit" name="submit" class="btn btn-primary m-3 save-data">
  </form>
</div>

<script>

$("#submit").on('submit',(e)=>{
  e.preventDefault();

  var fullname=$('#username').val();
  var email =$('#email').val();
  var phone =$('#phone').val();
 
     $.ajax({
       method:'POST',
       url:'./editprofile',
       data:{
          _token: '{{csrf_token()}}',
          username:fullname,
          email:email,
          phone:phone
       },
       success:(data)=>{
         alert('data updated successfuly');
         $('#username').val();
         $('#email').val();
         $('#phone').val();
         
       },
       error:(error)=>{
         console.log(error)
       }
     }
   )

   
  });
     
    </script>

@endsection