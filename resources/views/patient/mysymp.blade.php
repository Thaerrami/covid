

@extends('layouts.app')
@section('content')
{{-- <div class="p-2 m-1 bg-light rounded"><span>{{$item->title}}</span><span class="float-right">{{$item->date}}</span></div>. --}}
    <div class="container">
        @isset($symp)
        @foreach ($symp as $key => $item)
        <div class="p-2 m-3 bg-light rounded row">
        <div class="w-100">{{$key}}</div>
            @foreach ($item as $s)
                <div class="ml-3 p-2 m-2 rounded col-3" style="background: rgb(218, 218, 218)">{{$s}}</div>
            @endforeach
        </div>
        @endforeach
        @endisset
       
        
    </div>
@endsection