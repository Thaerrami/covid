

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href={{ asset('css/phome.css')}}>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="{{ asset('css/updateuser.css') }}" rel="stylesheet">
<link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Scripts -->

</head>
<body>

  <div class="container mt-5">
    <div class="bg-light m-1 ">
      <ul class=" list-unstyled p-1 d-inline-flex w-100 " style="overflow: auto" >
        <span class="text-black-50 " style="font-size: 1.5em"> &#8811;</span>
        <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/pne" class="active nav-link text-dark">name</a></li>
        <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/pee" class="active nav-link text-dark">email</a></li>
        <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/pase" class="active nav-link text-dark">password</a></li>
        <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/ple" class="active nav-link text-dark">location</a></li>
        <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/ppe" class="active nav-link text-dark">phone</a></li>
        <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/pbe" class="active nav-link text-dark">BirthofDate</a></li>
        <li class="nav-item  btn-outline-secondary rounded mr-1 "><a href="/pie" class="active nav-link text-dark">avatar</a></li>
      
      </ul>
     </div>
    
    <div class="row flex-lg-nowrap">
      <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
        <div class="card p-3">
          <div class="e-navlist e-navlist--active-bg">
            <ul class="nav">
              <li class="nav-item"><a class="nav-link px-2 active" href="/home"><i class="fa fa-fw fa-home mr-1"></i><span>Home</span></a></li>
              <li class="nav-item"><a class="nav-link px-2" href="/symptoday"><i class="fa fa-fw fa-th mr-1"></i><span>Insert symptoms</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    
      <div class="col">
        <div class="row">
          
          <div class="col-12 mb-3">
            <div class="card">
              
    
              <div class="card-body">
                <div class="e-profile">
            {{-- <form class="form" action="/edituserprofile" method="POST"   enctype="multipart/form-data"> --}}
              {{-- @csrf --}}

                  
                  <div class="tab-content pt-3">
                    <div class="tab-pane active">
    {{-- form --}}
                        <div class="row">
                          <div class="col">
                            
                            @yield('content')
    
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
          <div class="col-12 col-md-3 mb-3">
            
            
          </div>
        </div>
    
      </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('js/updateuser.js') }}"></script>
</body>
</html>

