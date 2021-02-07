@extends('doctor.edittemplate')

@section('content')

<div class="col-md-6">
  
  <div class="p-2 bg-success rounded w-25 m-auto text-light d-none" id='update' >image updated </div>
  
  <div style="background: #ccf;border-radius: 10px;margin-bottom: 50px;" class="shadow"> 
    <div class="w-100 text-center mb-3" style="font-size:xx-large">{{$name}}</div>
    
    <img width="200" class='docimage mb-3' id='avatar'  src={{asset(($image!="")? "storage/$image":"mp/anon.png")}}  style="animation-duration:2s" alt="no image">
     
      <form id="submit" method="POST"  enctype="multipart/form-data">
        @csrf
    <div class="text-center">
       <h6>Upload a different photo...</h6>
      <div class="p-5 rounded" style="background: #eee;border-end-end-radius: 10px">
      <input type="file" name="image" class="form-control" style="display: none;" id='image' required />
      <button type="button" class="btn btn-lg btn-dark mr-4 shadow" id='select'>Select image</button>
      <input type="submit" id='submit' value="change image"  class="btn btn-lg btn-light shadow  " /><br>
      <button class="btn btn-danger mt-5" type="button" id="remove">Remove image</button>
      
    </div>
    </div>
  </form>
  </div>
  </div>


<script>

  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  
    
  
  var img=document.getElementById('image');

  // $('#image').on('change',function(){
  //   if($('#image').val()!=''){
  //     $('#submit').removeClass('disabled')
  //   }
  // })
  

  
  var slt=document.getElementById('select');
  slt.addEventListener('click',function(){
    img.click();
  });
    
    $('#submit').submit(function(e){
  e.preventDefault();

  if($("#image").val()==''){alert('No Image Selected Please Select Image')}else{  
  var url ="{{ route('doc.updatedata') }}";  
  
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
  

  
    
   </script>

@endsection