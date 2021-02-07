@extends('layouts.auth')

@section('content')
<link href="{{ asset('css/patientprof.css') }}" rel="stylesheet">

</div>
</div>
<div class="container m-5">
@foreach ($messages as $item)
<li class="list-group bg-success m-1 p-1 w-75 text-light  border position-relative mb-3"><span>
    {{-- {{$item->uimg != null}} --}}
        <img width="40" height="40" class="border mr-1 ml-1" style="border-radius:50%" src={{asset($item->uimg != ''? "storage/".$item->uimg:'mp/anon.png')}}  alt="no image">

    &nbsp;{{$item->uname}}</span>{{$item->message}}<span class="bg-secondary rounded  text-center mt-1 w-25 p-1 position-absolute" style='font-size: 10px;right:3px;bottom:1px'>{{date('M-d ~ h:m',strtotime($item->created_at))}}</span>
    <span>reply &#x2937;</span>
   <form action="{{route('doc.reply',[
       'pat_id'=>$item->Patient_id,
       'qus_id'=>$item->id
   ])}}" method="POST">@csrf <div class=''><input type="text" name="reply" id="" class="form-control h-25"></div><button type="submit" class="btn btn-sm btn-primary mt-1 " style="width:20%; "> send</button></form></form>
</li>
@endforeach
</div>
@endsection