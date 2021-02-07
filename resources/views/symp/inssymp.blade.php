@extends('layouts.app')

@section('content')
<link rel="stylesheet" href={{ asset('css/checkbox.css')}}>
<div class="container p-2 " style="background-image: linear-gradient(to right ,#0044ee88,#0e444499)">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center mb-2 font-weight-bolder p-2 bg-secondary text-white">
              <p  style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size:30px">Date to day  { {{date('Y-m-d')}} }</p>
            </div>
            <div class="card p-3 ">
               
                <form method="POST" action={{ route('savesymp')}} >
                    @csrf
                    @foreach ($syms as $s)
                   

                <fieldset>
                    <label>
                      <input type="checkbox" name="symp[{{$s['symp_deg']}}][]" value="{{$s['id']}}" />
                      <span>{{$s['title']}}</span>
                    </label>
                  </fieldset>

                    @endforeach
                    <textarea required style="color:rgb(55, 52, 255)" name="dayreport" id="" class="w-75 ml-4 form-control " cols="30" rows="10" placeholder="daily report
how are you feeling to day
is there a Strange symptoms ?">
                    </textarea>
                    <div class="rounded text-center mb-2 font-weight-bolder mt-2 bg-light" style="border :2px solid #ddd" >
                        <input type="submit" class="btn btn-primary m-3 w-25 " />
                        <a href="/" class="btn btn-secondary m-3 w-25">cancel</a> 
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection
