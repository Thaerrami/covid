@include('layouts.adminapp')

<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/admin.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
    </head>
    <body>

    <div class="container">
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
             {{session()->get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        <div class="row mb-2 bg-white p-2 rounded text-capitalize d-flex justify-content-around w-50 m-auto">
           <span class=" p-1 rounded ">Admin Name: {{Auth::user()->name}}</span><span class=" p-1 rounded">Date : {{date('yy-M-d')}}</span> 
        </div>
        <div style="font-size:xx-large;" class="mt-3 ">Send Email to doctors</div> 
        <form action="{{route('admin.maildoc')}}" method="POST" class=" p-2 rounded mt-3 mb-5" style=" background-color: rgb(222, 241, 219)">
            @csrf
            <textarea name="email" id="" cols="30" rows="10" style="width:100%" class="form-control"></textarea>
            <button type="submit" class="btn btn-primary m-3" onclick="alert('email sent')"> Send <img src="{{asset('mp/send.svg')}}" width="20px" alt=""></button>
        </form>
    </div>
</div>
</body>
</html>