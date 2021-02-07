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


<div class="container emp-profile pcb mt-5 bg-white p-3 " style='border-radius:20px'>
            <form method="post">
                <div class="row ">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img  class='docimage'
                            src="{{asset( $image!==''? "storage/$image":'mp/anon.png')}}" alt="no image"/>
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
                   
                </div>
                <div class="row mt-3">

                    <div class="col-md-4">
                        
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
             
                 <hr style="border:1px solid rgb(112, 112, 112) ; border-radius:50%">
                
                 <h2 class="text-center m-5 rounded bg-info p-2 text-white"> Patient Reports 
                     <img src="https://img.icons8.com/nolan/64/business-report.png"/>
                </h2>

               

                @isset($finalreport)
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">report</th>
                      </tr>
                    </thead>
                    <tbody>
                     <tr>
                        <td>{{$finalreport['date']}}</td>
                        <td>{{$finalreport['recoverreport']??$finalreport['deathreport']}}</td>
                      </tr>   
                    </tbody>
                  </table>
                @endisset

                 <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">report</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                     @foreach ($reports as $item)
                     <tr>
                        <td>{{$item['date']}}</td>
                        <td>{{$item['report']}}</td>
                      </tr>   
                     
                     @endforeach
                    </tbody>
                  </table>

        </div>

        @push('headhome')
<!-- Styles -->
<!-- Scripts -->
<script src="{{ asset('js/updateuser.js')}}"></script>
@endpush
@endsection
