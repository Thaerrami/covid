
@extends('layouts.app')
@section('content')


<div class="container mt-5">
 <div class="bg-light m-1 ">
  <ul class=" list-unstyled p-1 d-inline-flex w-100 " style="overflow: auto" >
      
    <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/pne" class="active nav-link text-dark">name</a></li>
    <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/pee" class="active nav-link text-dark">email</a></li>
    <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/pase" class="active nav-link text-dark">password</a></li>
    <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/ple" class="active nav-link text-dark">location</a></li>
    <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/ppe" class="active nav-link text-dark">phone</a></li>
    <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/pbe" class="active nav-link text-dark">BirthofDate</a></li>
    <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/pie" class="active nav-link text-dark">avatar</a></li>
  
  </ul>
 </div>
  <div class="row flex-lg-nowrap">
    <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
      <div class="card p-3">
        <div class="e-navlist e-navlist--active-bg">
          <ul class="nav">
            <li class="nav-item"><a class="nav-link px-2 active" href="/home"><i class="fa fa-fw fa-home mr-1"></i><span>Home</span></a></li>
            <li class="nav-item"><a class="nav-link px-2" href="/symptoday"><i class="fa fa-fw fa-th mr-1"></i><span>Insert symptoms</span></a></li>
          </ul>
        </div>
      </div>
    </div>
  
    <div class="col">
      <div class="row">
        
        <div class="col mb-3">
          <div class="card">
            
  
            <div class="card-body">
              <div class="e-profile">
          {{-- <form class="form" action="/edituserprofile" method="POST"   enctype="multipart/form-data"> --}}
            {{-- @csrf --}}

                
                <div class="tab-content pt-3">
                  <div class="tab-pane active text-center">
  {{-- form --}} <img src="{{Auth::user()->image?'storage/'.Auth::user()->image:'/mp/anon.png'}}"  id="avatar" width="300px" height="350px"   class="m-auto rounded" alt="">
                      <div class="row">
                        <div class="col">
                          <form  method="POST" id="submit" enctype="multipart/form-data">
                            {{-- {{ method_field('PUT') }} --}}
                           
                            <div class="text-center">
                              <h6>Upload a different photo...</h6>
                             <div class="p-2 rounded" style="background: #eee;border-end-end-radius: 10px">
                             <input type="file" name="image" class="form-control" style="display: none" id='image' required />
                             
                             <button type="button" class="btn btn-lg btn-dark shadow " style="margin:5px;font-size:.7em" id='select'>Select image</button>
                             <input type="submit" id='submit' value="change image "    style="margin:5px;font-size:.7em" class=" btn btn-lg btn-light shadow" /><br>
                             <button class="btn btn-danger mt-5" type="button" id="remove">Remove image</button>
                             
                           </div>
                           </div>
                        </form>  
  
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="col-12 col-md-3 mb-3">
          
          
        </div>
      </div>
  
    </div>
  </div>
  </div>



@endsection



<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script>

$(document).ready(()=>{
  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  

  
      var img=document.getElementById('image');
      var slt=document.getElementById('select');

slt.addEventListener('click',function(){
  img.click();
});
  
    
    $('#submit').submit(function(e){
  e.preventDefault();

  if($("#image").val()==''){alert('No Image Selected Please Select Image')}else{  
  var url = "./edituserprofile";  
  
  let fd = new FormData(this);
  $('#image-input-error').text('');
  
 

  $.ajax({
      method:'POST',
      url:url,
      data:fd,
      processData: false,
      contentType: false,
      success:(data)=>{
        alert('image updated');
        
        $("#avatar").attr('src',`${window.location.origin}/storage/${data}`);
        
      },
      error:(error)=>{
        console.log(error)
      }
    }
  )
  }
  });


  $("#remove").click(()=>{
    $.ajax({
      method:'POST',
      url:'./deleteImage',
      data:{
         _token: '{{csrf_token()}}'
      },
      success:(data)=>{
        alert('image remvoed successfuly');
        $("#avatar").attr('src',`${window.location.origin}/mp/anon.png`);
      },
      error:(error)=>{
        console.log(error)
      }
    }
  )
  });
  
  
})

  
    
   </script>