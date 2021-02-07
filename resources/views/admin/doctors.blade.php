@extends('layouts.adminapp')

@section('content')


<div class="container w-100">
    <div class="row">
      
      <div class="col-3">
        <a href={{route('addnewdoc')}} class="btn btn-primary " style="font-size:.5em">new Doctor</a>
      </div>
      <div class="col-6 mb-3">
      
        <input class="form-control mr-1" type="text"  list="patients" name='patname' required  id="browser">
        </div>
      <div class="col-3">
         <a href={{route('admin.maildocview')}} class="btn btn-outline-info" style="font-size: .6em" ><img src="{{asset('mp/message.svg')}}" width="40px" alt="" >SendEmail </a>
      </div>
    </div>
</div>

<div class="container-fluid"  style="overflow-x:auto;margin-left: 0;padding: 0">
  <table class="table"  >
      <thead class="thead-dark">
        <tr>
          <th scope="col" id='cnt'>{{$cnt}}</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Country</th>
          <th scope="col">Status</th>
          <th scope="col"></th>
        </tr>
      </thead>

      <tbody id='table'>
            @foreach ($docs as $ele)
                <tr>
                    <td><a href={{asset( $ele['image']!==''?"storage/$ele[image]":'/mp/anon.png')}}><img src={{asset( $ele['image']!==''?"storage/$ele[image]":'mp/anon.png')}} style="width:60px;height:60px;border-radius:50%" alt="awed" /></a></td>
                    <td>{{$ele['name']}}</td>
                    <td>{{$ele['email']}}</td>
                    <td>{{$ele['phone']}}</td>
                    <td>{{$ele['country']}}</td>
                    <td><a href="/admin/showadmindoc/{{$ele['id']}}" class="btn btn-outline-primary">Show</a></td>
                {{-- @endforeach --}}
                </tr>
            @endforeach
        </tbody>  
      </table>
    </div>

      <datalist id="patients">
        @foreach ($docs as $ele)  
            <option value="{{$ele['name']}}"> 
          @endforeach
      </datalist>

@endsection

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<script>

  $(document).ready(()=>{

  $('#browser').on('change',()=>{
     filter();
  })
  
  const filter = ()=>{
    var name = $('#browser').val();
    $.ajax({
      method:"POST",
      url:'./filterDoc',
      data:{
        _token:"{{csrf_token()}}",
        name:name,
      },
      success:(data)=>{
  
        var table=``;
        for(var i of data){
          $("#table").empty();
          table+=`<tr>
          <td><img src={{asset( $ele['image']!==''?"storage/$ele[image]":'mp/anon.png')}} style="width:60px;height:60px;border-radius:50%" alt="awed" /></td>
                      <td>${i.name}</td>
                      <td>${i.email}</td>
                      <td>${i.phone}</td>
                      <td>${i.country}</td>
                      <td><a href="/admin/showadmindoc/${i.id}" class="btn btn-outline-primary">Show</a></td>
        </tr>`
        }
  
        if(data.length==0){
          $("#table").empty();
          $("#table").append('<div class="text-black-50 text-center w-100 position-absolute mt-2"> No Data Found</div>')
        }
        
        // console.log(table)
        $("#cnt").text(data.length);
        $("#table").append(table);
        
      },
      error:(error)=>{
        console.log(error)
      }
    })
  
  }
  
  });
  
  </script>