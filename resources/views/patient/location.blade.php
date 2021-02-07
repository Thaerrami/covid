@extends('patient.editprofile')


@section('content')
<form  method="POST" id="submit">
    @csrf

    <div class="row">
        <div class="col">
          <div class="form-group">
            <label>country</label>
            <select class="form-control" type="text" name='country' value={{Auth::user()->country}} required  id="country">
              @foreach ($location as $item)
                <option  value="{{$item['name']}}" {{$item['name']==Auth::user()->country?'selected':null}}>{{$item['name']}}</option> 
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label>city</label>
            <input class="form-control" type="text" name='city' id="city" minlength="6" required value={{Auth::user()->city}} placeholder={{Auth::user()->city}}>
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
  
    var country = $('#country').val();
    var city = $('#city').val();
   
    
       $.ajax({
         method:'POST',
         url:"./edituserprofile",
         data:{
            _token: '{{csrf_token()}}',
            country:country,
            city:city
         },
         success:(data)=>{
           alert('location updated successfuly');
         },
         error:(error)=>{
           console.log(error)
         }
       }
     )
     
    });
       
      </script>

@endsection