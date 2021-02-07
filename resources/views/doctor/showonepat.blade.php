@extends('layouts.auth')

@section('content')


<!------ Include the above in your HEAD tag ---------->

@push('head')
<!-- Styles -->
<link rel="stylesheet" href={{ asset('css/phome.css')}}>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endpush


<div class="container emp-profile pcb mt-5 bg-white p-3 " style='border-radius:20px'>
                <div class="row ">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img  class='pimage'
                            src="{{asset( $image!==''? "storage/$image":'mp/anon.png')}}" alt="no image"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        {{$name}}
                                    </h5>
                                    <p class="proile-rating">status : <span>{{ $status }}</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">State info</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                   
                </div>
                <div class="row mt-3">

                    <div class="col-md-4">
                        @if ($current==='Case')
                        @if ($filled)
                        
                            <div class='text-center'>
                                <h1><img id="editableimage2" src="{{asset('mp/inserted.gif')}}" width="300px" alt="sending a hug gifs get the best gif on giphy"/></h1>
                                <h4>Data insterted to day</h4>
                            </div>
                            
                        @else
                        <button class='text-center btn btn-outline-primary ml-4 mt-5' id='fillbut' style='margin:auto; text-decoration:none;;margin-top:20px' 
                        {{-- href="/doc/fillpat/{{$id}}" --}}
                        ><h3>Fill patient data</h3></button>
                        @endif
                        @endif
                        
                    </div>
                    <div class="col-md-8">
                        @if ($current==='Case')
                        <a href="/doc/changepatstate/{{$id}}" class="d-inline-flex btn btn-primary mb-2 border" >change status (<p class="text-dark">recover</p>&nbsp; /&nbsp; <p class="text-danger">death</p>)</a>
                        @elseif($current==='Recovered')

                        <form  method="POST" class="form-group btn-submit " style="text-align: left" id="formupdate">
                            @csrf 
                        <input type="hidden" name="id" id='id' data-id={{$id}} />
                        <input type="submit" name="submit" id="submit"  class="btn btn-primary float-left mt-1" value="reassign as patient" />
                      </form><br><br>
                      @else
                        @endif
                        
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$phone}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>country</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$country}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>city</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$city}}</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>status</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$status}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>current state</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$current}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>logged in</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$start}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Birth Of Date</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$bof}}</p>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            
             
                 <hr style="border:1px solid rgb(112, 112, 112) ; border-radius:50%">
                
                 <h2 class="text-center m-5 rounded bg-info p-2 text-white"> Patient Reports 
                     <img src="https://img.icons8.com/nolan/64/business-report.png"/>
                </h2>

                @isset($finalreport)
                
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">final report</th>
                      </tr>
                    </thead>
                    <tbody>
                     <tr>
                        <td>{{$finalreport['date']}}</td>
                        <td>{{$finalreport['recoverreport']??$finalreport['deathreport']}}</td>
                      </tr>   
                     </tbody>
                  </table>
                  @endisset
                
                 <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">report</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                     @foreach ($reports as $item)
                     <tr>
                        <td>{{$item['date']}}</td>
                        <td>{{$item['report']}}</td>
                      </tr>   
                     
                     @endforeach
                    </tbody>
                  </table>

        </div>

        @push('headhome')
<!-- Styles -->
<!-- Scripts -->

@endpush
<div class="filerpoper">
    
<div class="card p-3">
    <span class="cls-btn">X</span>     
    <form method="POST" id="form" action={{ route('docsavesymp')}} >
        @csrf
        @foreach ($syms as $s)
       

    <fieldset>
        <label>
          <input type="checkbox" name="symp[]" data-sympdeg="{{$s['symp_deg']}}" value="{{$s['id']}}" />
          <span>{{$s['title']}}</span>
        </label>
      </fieldset>

        @endforeach
        <textarea required style="color:rgb(55, 52, 255)" name="dayreport" id="" class="w-75 ml-4 form-control " cols="30" rows="10" placeholder="daily report
how are you feeling to day
is there a Strange symptoms ?">
        </textarea>
        <div class="rounded text-center mb-2 font-weight-bolder mt-2 bg-light" style="border :2px solid #ddd" >
            <input type="hidden" name='id' id='id' value={{$id}}>
            <button type="submit" id='hi' class="btn btn-primary w-100">Submit</button>
        </div>
    </form>
</div>
</div>
@endsection
{{-- <script src="{{ asset('js/updateuser.js')}}"></script> --}}
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script type='text/javascript'>

$(document).ready(()=>{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$('#formupdate').on('submit', function(event){
        event.preventDefault();
        var id=$('#id').data('id');
        var url = '/doc/reassign';

        $.ajax({
            url:url,
            method:"POST",
            data:{
                id:id
                , _token: '{{csrf_token()}}'
            },
            success:function(data)
            {
                alert(data);
                window.location.reload();
            },
            error: function (data, textStatus, errorThrown) {
                alert(data);

    }
        })


    });

///////////fill symp

$('.filerpoper').hide(10);

$('.cls-btn').click(()=>{
    $('.filerpoper').hide(1000);
});

$('#fillbut').click(()=>{
    $('.filerpoper').show(500);
});

        var symps=[];
        var url='/doc/docsavesymp';
        var dayreport='';
        var id;
        var sympdeg=[];

        $( "#form" ).submit(function( event ) {
            event.preventDefault();
            $('#hi').prop('disabled',true);
            $('input:checked').each(function(){
                sympdeg.push($(this).data('sympdeg'));
            });

            dayreport=$("textarea[name='dayreport']").val() ??'nothing to day';
            id=$('#id').val();

            $("input:checked").each(function(){ 
                symps.push(this.value);
            });

            sympdeg=Math.max(...sympdeg);
            symps=JSON.stringify(symps);
            

    $.ajax({
        method:'POST',
        url:url,
        data:{
            _token:'{{csrf_token()}}',
            symps:symps,
            sympdeg:sympdeg,
            dayreport:dayreport,
            id:id
        },
        success:(data)=>{
            alert(data);
            window.location.reload();
        },
        error:(data)=>{
            console.log(data)
        }
    })    

});
  




})


</script>