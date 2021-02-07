@include('layouts.app')
@extends('bootstrap')

@section('content')
<link href="{{ asset('css/patientprof.css') }}" rel="stylesheet">
    <div class="jumbotron header m-1" >
<br><br>
        @if (isset($mydoctor['image']))
        <img class="pimage headerimg"  src="storage/{{$mydoctor['image']}}" alt=""/>
        @else
        <img  class="headerimg" src={{asset('mp/anon.png')}} alt=""/>
        @endif
    </div>

<div class=" text-center card m-5 bg-secondary text-white">
    {{-- first row --}}
<div class="row p-3 ">
        <div class="col-4">
        Doctor name : {{$mydoctor['name']}}
    </div>
    <div class="col-4">
            Doctor phone : <a href="tel:+{{$mydoctor['phone']}}">{{$mydoctor['phone']}}</a>
    </div>
    <div class="col-4">
            Doctor email : <a href="mailto:{{$mydoctor['email']}}">{{$mydoctor['email']}}</a>
    </div>
    <hr class="white_hr mt-5">
</div>
    {{-- secound --}}
<div class="row p-3 ">
    <div class="col-4">
        Country : {{$mydoctor['country']}}
    </div>
    <div class="col-4">
        City : {{$mydoctor['city']}}
    </div>
    <div class="col-4">
        work time start/end : ({{$mydoctor['startwork']}}/{{$mydoctor['endwork']}})
    </div>

</div>
<div class="row p-3 ">
    <div class="col-12">
        <div class="text-center text-capitalize m-2 text-success bg-light rounded w-25 m-auto">description</div>
    <div class="bg-info p-2 mt-2 rounded"> {{$mydoctor['description']}}</div>
    </div>
</div>
</div>

  <div class="alert alert-success w-25 position-fixed d-none" style="z-index: 10;display: none;top:5%;left:2%" id="success-alert formModal">
    
    <strong>Success! </strong> email sent successfully.
  </div>
<div class="container mt-5 w-100">
  <div class="modal-body mt-4 w-100">
    <form id="myForm" name="myForm" action="{{route('maildoc')}}" method="POST"  class="form-horizontal" novalidate="" >
        @csrf
        
            <legend >Send Message Doctor {{$mydoctor['name']}}</legend>
            <textarea name="emailtodoc" id="emailtodoc" cols="60" rows="7" class="form-control w-100 "></textarea>
       
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn-save" value="add">Send Message
            </button>
        </div>
    </form>
</div>
</div>
<div class="container ">
@foreach ($message as $item)
@if ($item['sender']===1)
<li class="list-group bg-info m-1 p-1 w-50 text-light border position-relative mb-5">{{$item['message']}}<span class="bg-dark rounded text-center mt-1 w-25 p-1 position-absolute " style='font-size: 10px;right:10px;bottom:-25px'>{{date('M-d ~ h:m',strtotime($item['created_at']))}}</span></li>
@else
<li class="list-group bg-success m-1 p-1 w-50 text-light float-right border position-relative mb-5">{{$item['message']}}<span class="bg-dark rounded  text-center mt-1 w-25 p-1 position-absolute" style='font-size: 10px;right:10px;bottom:-25px'>{{date('M-d ~ h:m',strtotime($item['created_at']))}}</span></li>
@endif
@endforeach
</div>
@endsection