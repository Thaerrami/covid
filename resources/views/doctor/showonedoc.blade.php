@extends('layouts.adminapp')

@section('content')


<!------ Include the above in your HEAD tag ---------->

@push('head')
<!-- Styles -->
<link rel="stylesheet" href={{ asset('css/phome.css')}}>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endpush


<div class="jumbotron bg-primary text-white">
    <div class="container text-center">
      <h1>{{$uname}}</h1>      
      <p>title : {{$title}}</p>
    </div>
    <img width="200" class='docimage' src={{asset( $image!==''? "storage/$image":'mp/anon.png')}}  alt="no image">
    <div class="row">
        <h1 class="text-center w-100 jumbotron bg-primary">
            Description
        </h1>
        <div class="text-center w-75 m-auto ">
          {{$desc ?? ''}}
                  </div>
        
      </div> 
</div>
    
  <div class="container-fluid bg-3 text-center">    
    <h3>data</h3><br>
    <div class="row">
      <div class="col-sm-3">
        <p>phone</p>
        {{$uphone}}
      </div>
      <div class="col-sm-3"> 
        <p>Email</p>
        {{$uemail}}
    </div>
      <div class="col-sm-3"> 
        <p>Number Of Patient</p>
       {{$nofp}}
    </div>
      <div class="col-sm-3">
        <p>Country/City</p>
        {{$country??'null'}}/{{$city??'null'}}
    </div>
    </div>
  </div><br>
  <hr>


  <div class="container-fluid bg-3 text-center">    

    <div class="row">
      <div class="col-sm-3">
        <p>start-end work</p>
       ( {{$start??'null'}}-{{$end??'null'}} ) work
      </div>
      
     
    </div>
  </div><br>
  
  <footer class="container-fluid text-center mt-5">
    <p>Footer Text</p>
  </footer>
  
        @push('headhome')
<!-- Styles -->
<!-- Scripts -->
<script src="{{ asset('js/updateuser.js')}}"></script>
@endpush
@endsection
