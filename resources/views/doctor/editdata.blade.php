@extends('doctor.edittemplate')

@section('content')

<div class="col-md-9 personal-info">
  <h3>Personal info</h3>
  
  <form class="form-horizontal" id="submit" role="form" method="POST" autocomplete="off" >
      @csrf

      <div class="form-group">
          <label class="col-lg-3 control-label ">title :</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" name='title' id="title" value="{{$title}}">
          </div>
      </div>

      <div class="form-group">
          <label class="col-lg-3 control-label">Description</label>
          <div class="col-lg-8">
              <textarea class="form-control" name='description' id="description" >{{$desc}}</textarea>
          </div>
      </div>

        <hr>

      <div class="form-group">
      <label class="col-lg-3 control-label">Full name:</label>
      <div class="col-lg-8">
        <input class="form-control" type="text" id="username" name='username' value="{{$name}}">
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-lg-3 control-label">Email:</label>
      <div class="col-lg-8">
        <input class="form-control" type="text" name='email' id="email" value="{{$email}}">
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">Start Work At</label>
      <div class="col-lg-8">
        <div class="ui-select">
         <input class="form-control" type="time"  value="{{$end??'08:00'}}" name="StartAt" id="StartAt" >
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">End Work At</label>
      <div class="col-lg-8">
        <div class="ui-select">
         <input class="form-control" type="time" name="EndAt" value="{{$start??'21:00'}}" id="EndAt" >
        </div>
      </div>
    </div>

    {{-- location --}}

    <div class="form-group">
      <label class="col-lg-3 control-label">country:</label>
      <div class="col-lg-8">
        <input class="form-control" type="text"  list="country" name='country' id="country"  value="{{$country??'' }}" required  id="browser">
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-3 control-label">city:</label>
      <div class="col-lg-8">
        <input class="form-control"  type="text" name="city"  id="city" value="{{$city??''}}"  />
      </div>
    </div>


    <div class="form-group">
      <label class="col-lg-3 control-label">phone:</label>
      <div class="col-lg-8">
        <input class="form-control"  type="text" name="phone" id="phone" value="{{$phone??''}}"  />
      </div>
    </div>


    {{-- password --}}
    

{{-- countries --}}
    <datalist id="country">
      @foreach ($location as $item)
      <option value="{{$item['name']}}"> 
      @endforeach
      </datalist>
{{-- countries --}}
<input type="submit" name="submit" class="btn btn-primary m-3 save-data">
  </form>
</div>




<script>

  $("#submit").on('submit',(e)=>{
    e.preventDefault();    

    var datatosend=[];
    var arr={};

    var title =$('#title').val();
    var description =$('#description').val();
    var username =$('#username').val();
    var email =$('#email').val();
    var StartAt =$('#StartAt').val();
    var EndAt =$('#EndAt').val();
    var country =$('#country').val();
    var city =$('#city').val();
    var phone =$('#phone').val();  
    
       $.ajax({
         method:'POST',
         url:"{{ route('doc.updatedata') }}",
         data:{
            _token: '{{csrf_token()}}',
            title:title,
            description:description,
            email:email,
            StartAt:StartAt,
            EndAt:EndAt,
            country:country,
            city:city,
            phone:phone
         },
         success:(data)=>{
           console.log(data)
         },
         error:(error)=>{
           console.log(error)
         }
       }
     )
  
     
    });
       
      </script>
  
@endsection

