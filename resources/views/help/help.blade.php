@extends('help.helptemplate')
@section('helpshap')
   <h1 class="mt-2">Help</h1>
   <div class="container w-100 mt-5">
       <div class="row w-100">
           <form action="{{route('helpquestion')}}" method="POST"  class="w-100">
            @csrf
               <input required name='name' type="text" class="form-control mb-2" placeholder="enter your name" />
               <textarea required class="form-control" placeholder="enter message" name="message" id="" style="width: 100%;color:rgba(2, 202, 52, 0.746)" cols="30" rows="5" ></textarea>
               <button type="submit" class="btn  btn-success m-3 ">Send <img src="{{asset('mp/send.svg')}}"  width=30 alt=""></button>
           </form>
       </div>
       <div class="row">
           @foreach ($message as $item)
           <div class="p-1 bg-info w-75 m-2 p-1 rounded">
           <div class="bg-white rounded w-25 p-1 mb-1">{{$item->name}}</div>    
           <div class="bg-white rounded p-1">{{$item->message}}</div>
        </div>
           @endforeach
       </div>
   </div>
@endsection