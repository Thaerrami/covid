@extends('layouts.adminapp')

@section('content')
<div class="container ">
    <div class="row">
        <div class="m-1 w-100 shadow">

            <div class="nav bg-dark p-3 text-white text-center " style='border-top-left-radius:10px;border-top-right-radius:10px'><p>Add new patient</p></div>
            <div class="card ">
              @isset($success)
                 <div class="form-control text-success">{{$success}}</div> 
              @endisset
                <form  id="submit" method="post" class="p-3" autocomplete="off">
                    @csrf

                        <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
        
                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                              @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
        
                      <div class="form-group row">
                          <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                          <div class="col-md-6">
                          <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required >
                          @error('phone')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                          </div>
                          </div>
        
                      <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div> 
                      </div>

                      <div class="form-group row">
                        <label for="Country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
      
                        <div class="col-md-6">
                            <select id="Country" type="text" class="form-control @error('Country') is-invalid @enderror" name="Country" value="{{ old('Country') }}" required autocomplete="Country" autofocus>
                                @foreach ($country as $item)
                                <option></option>
                                <option type="text" value={{$item['name']}} >{{$item['name']}}</option>
                                @endforeach
                            </select>
                            @error('Country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="City" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
      
                        <div class="col-md-6">
                            <input id="City" type="text" class="form-control @error('City') is-invalid @enderror" name="City" value="{{ old('City') }}" required autocomplete="City" autofocus />
                            
                            @error('City')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="startwork" class="col-md-4 col-form-label text-md-right">{{ __('startwork') }}</label>
      
                        <div class="col-md-6">
                            <input id="startwork" type="time" class="form-control @error('startwork') is-invalid @enderror" name="startwork" value="{{ old('startwork') }}" required autocomplete="startwork" autofocus />
                            
                            @error('startwork')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="endwork" class="col-md-4 col-form-label text-md-right">{{ __('endwork') }}</label>
      
                        <div class="col-md-6">
                            <input id="endwork" type="time" class="form-control @error('endwork') is-invalid @enderror" name="endwork" value="{{ old('endwork') }}" required autocomplete="endwork" autofocus />
                            
                            @error('endwork')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                      <div class="form-group row">
                          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        
                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      
        
                      <div class="form-group row">
                          <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                          <div class="col-md-6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                          </div>
                      </div>
        
                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Register') }}
                              </button>
                          </div>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<script>

  $(document).ready(()=>{

$('#submit').on('submit',(e)=>{
    e.preventDefault();

    var name     = $('#name').val();
    var email    = $('#email').val() ;
    var phone    = $('#phone').val() ;
    var country  = $('#Country').val() ;
    var city     = $('#City').val() ;
    var startwork= $('#startwork').val() ;
    var endwork  = $('#endwork').val() ;
    var password = $('#password').val() ;
    var confirm = $('#password-confirm').val() ;



if(confirm!==password || password.length<6){
    alert('password should be confirmed and it length 6 and more')
}else{
    $.ajax({
      method:"POST",
      url:"{{route('admin.adddoc')}}",
      data:{
        _token:"{{csrf_token()}}",
        name:name,
        email:email,
        phone:phone,
        country:country,
        city:city,
        startwork:startwork,
        endwork:endwork,
        password:password,
      },
      success:(data)=>{
          alert('doctor registered successfuly')
      },
      error:(error)=>{
        alert('doctor already exist')
        
      }
    })}
})
  
  });
  
  </script>
