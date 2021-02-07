@extends('layouts.adminapp')

@section('content')


<div class="container w-100">
  <div>
    <div class="row">
      
      <div class="col-4 d-inline-flex mb-1 mr-1" style="border-right: 1.5px solid rgb(200, 200, 200);">
        
        
        <select name='filter' class="form-control w-100" id='sfilter' placeholder="filter">
          <option >filter</option>    
          <option value='0'>All</option>
              <option value='1'>Recovered</option>
              <option value='2'>Active case</option>
              <option value='3'>Died</option>
              <option value='4'>Not entered symp to day</option>
          </select>
       
       
      </div>
      <div class="col-5 mb-1 w-100 " style="border-right: 1.5px solid rgb(200, 200, 200);">
        
        <input class="form-control mr-1" type="text"  list="patients" id='sname' name='patname' required  id="browser" placeholder="NAME" >
      
        </div>
      <div class="col-2 text-sm-center"  >
         <a href="{{route('remindpat')}}" style="font-size:1rem; border:4px solid rgb(255, 255, 115);" class="btn btn-warning  mb-1 p-2   text-black-50 text-decoration-none  rounded-circle" > 
          <img class="bell" src="https://cdn3.iconfinder.com/data/icons/time/100/alarm_bell-512.png" />
        </a>
      </div>
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
          
            @foreach ($patient as $ele)
                <tr>
                    <td><img src={{asset( $ele['image']!==''?"storage/$ele[image]":'mp/anon.png')}} style="width:60px;height:60px;border-radius:50%" alt="awed" /></td>
                    <td>{{$ele['name']}}</td>
                    <td>{{$ele['email']}}</td>
                    <td>{{$ele['phone']}}</td>
                    <td>{{$ele['country']}}</td>
                    <td>@if ($ele['currentstate']==1)
                        recovered
                    @elseif ($ele['currentstate']==2)
                    Case
                    @else
                    death
                    @endif</td>
                    <td><a href="/admin/showpat/{{$ele['id']}}" class="btn btn-outline-primary">Show</a></td>
                {{-- @endforeach --}}
                </tr>
            @endforeach
            
        </tbody>  
        
      </table>
    </div>

      @if ($patient==[])
              <div class="text-black-50 text-center"> No Data Found</div>
          @endif

      <datalist id="patients">
        @foreach ($allpat as $ele)  
            <option value="{{$ele['name']}}"> 
          @endforeach
      </datalist>

@endsection

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script>

$(document).ready(()=>{

  $('#sfilter').on('change',()=>{
    filter();
});

$('#sname').on('change',()=>{
   filter();
})

const filter = ()=>{
  var state = $('#sfilter').val();
  var name = $('#sname').val();
  $.ajax({
    method:"POST",
    url:'./filterpatient',
    data:{
      _token:"{{csrf_token()}}",
      state:state,
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
                    <td>${i.currentstate==1?'recovered':i.currentstate==2?'case':'death'}</td>
                    <td><a href="/admin/showpat/${i.id}" class="btn btn-outline-primary">Show</a></td>
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