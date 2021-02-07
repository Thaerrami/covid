
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="w-100">
            @foreach ($reports as $item)
                <div class="bg-light border m-4 p-3 w-100 rounded position-relative"><span class="position-absolute bg-dark text-light p-1 rounded" style="top:-15px;right:20px">{{$item['date']}}</span>{{$item['report']}}</div>
            @endforeach
        </div>
    </div>
</div>
@endsection