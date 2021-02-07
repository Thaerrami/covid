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


<div class="container emp-profile pcb">
            <form method="post">
                <div class="row bg-light">
                    <div class="col-md-4">
                        <div class="profile-img">
                    
                {{-- image @if ($image)
                            <img style="width:250px;height:250px;border-radius:50%;border:3px solid rgba(11, 187, 99, 0.452)" src="storage/{{$image}}" alt=""/>
                            @else
                            <img style="width:270px; height:230px" src={{asset('mp/anon.png')}} alt=""/>
                            @endif --}}
                            
                            {{-- <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div> 
                --}}
                
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
                    <div class="col-md-2">
                        <a type="submit" class="profile-edit-btn" style='text-decoration:none' href='/pne' name="btnAddMore" >Edit Profile</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        @if ($filled)
                        
                            <div class='text-center'>
                                <h1><img id="editableimage2" src="https://myfreeconnection.com/images/thank-you-checkmark.gif" width="300px" alt="sending a hug gifs get the best gif on giphy"/></h1>
                                <h4>Data insterted to day</h4>
                            </div>
                            
                        @else
                        <a class='text-center btn btn-primary ' style='margin:auto; text-decoration:none;;margin-top:20px' href="/symptoday"><h3>Fill data Now</h3></a>
                        @endif
                    </div>
                    <div class="col-md-8">
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
            </form> 
             
                 
        </div>

        @push('headhome')
<!-- Styles -->
<!-- Scripts -->
<script src="{{ asset('js/updateuser.js')}}"></script>
@endpush
@endsection
