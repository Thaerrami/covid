@extends('bootstrap')
@section('content')
<div class="bg-light p-3 d-flex justify-content-around">
    <span class="btn btn-secondary text-decoration-none text-black-50" style="font-size: 30px" onclick="window.history.back()"> &#x2B98; </span>
    <span class="btn "><a href="/" class='text-black-50'>home</a></span>
    <span class="btn "><a href="{{route('help')}}" class='text-black-50'>help</a></span>
    <span class="btn "><a href="{{route('about')}}" class='text-black-50'>about us </a></span>
</div>
    <div class="container">
        @yield('helpshap')
    </div>
@endsection