<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
        <script type="text/javascript" src="//geoip-js.com/js/apis/geoip2/v2.1/geoip2.js"></script>
        <link href="css/welcome.css" rel="stylesheet">

    </head>
    <body>
        
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                    @endauth
                </div>
            @endif

            <div class="header">
               
            </div>
<div class="container jumbotron-fluid">
            <div class="faq">
                <h2 class="head-faq"> Most Frequent Questions</h2>
                <h1 class="qustion">{{$question}}</h1>
                @foreach ($answer as $ans)
                    <li>{{$ans}}</li>
                @endforeach
                <button class="btn btn-primary mt-2" id='showmore'>show all</button>
       <div id='allfaq'>
                @foreach ($all as $it)
                <div class="jumbotron p-4" >
                <h1 class="qustion">{{$it->question}}</h1>
                @foreach (explode('+',$it->answer) as $ans)
                    <li class="answer">{{$ans}}</li>
                @endforeach
            </div>
                @endforeach
        </div>
            </div>
        </div>
            <div class="container">
                <div class="row" id="a">
                    
                    <div class="col-sm-12 col-md-6  col-lg-4 mt-3 mb-3 " id='Sym-head'>
                        <div class="b" style='transition-duration: 1px;'>
                        <img src="mp/sep.png" alt="" />
                        <h1 class="head-of-text-card"> Symptoms of COVID</h1>
                        <div id="Sym-text" >
                        High body temperature.Hacking cough.Vomiting.Runny nose.Shortness of breath.Pneumonia.In severe cases, one has severe symptoms: acute pneumonia, kidney inability.
                    </div>
                    </div>
                </div>
                    <div class="col-sm-12 col-md-6  col-lg-4 mt-3 mb-3 " id='Prev-head'>
                        <div class="b">
                        <img src="mp/pevent.png" alt="" />
                       <h1 class="head-of-text-card"> Preventative Measurements</h1>
                       <div id="Prev-text">
                           Wash hands with soap and water frequently for 20 seconds at least.Avoid hand shaking and kissing at meetings.Cover your mouth and nose when coughing and sneezing.Dispose of used wipes safely.Avoid direct contact with any suspected or confirmed case.Avoid touching the eyes, nose, and mouth after touching the surfaces.Eat healthy foods rich in vitamin C to strengthen the immune system.Avoid using the same cup or bowl for more than one person
                           </div>                    
                    </div>
                </div>
                    <div class="col-sm-12 col-md-6  col-lg-4 mt-3 mb-3 " id='Spr-head'>
                        <div class="b">
                        <img src="mp/syp.png" alt="" id='' />
                        <h1 class="head-of-text-card"> How it Spreads</h1>
                        <div id="Spr-text">
                            Direct transmission through droplets from the patient when coughing or sneezing.Direct transmission (touching surfaces and devices contaminated with the secretions of the patient, and then touching the mouth, nose or eye).Direct contact with corona virus patients
                        </div>                    
                    </div>
              
                </div>
            </div>
            </div>
            
            <iframe src="" class="cov-jo" frameborder="0" id='mapframe' ></iframe>



            
        </div>

      <script type="application/javascript">





function geoip(json){
var userip      = document.getElementById("user_ip");
var countrycode = document.getElementById("user_countrycode");
// userip.textContent      = json.ip;
// countrycode.textContent = json.country_code;
var location ='https://covid19.who.int/region/emro/country/'+json.country_code.toLowerCase();

var e=document.getElementById('a');
        
        
        document.addEventListener("scroll",function(){
           
            var sh=Number(window.screen.availHeight);
            console.log(e.offsetTop);
           var offset= window.scrollY - e.offsetTop +(sh/2)+20;
            if(offset > 0 && offset < 10){
                if(!e.classList.contains('good'))
                     e.classList.add('good')
            }
        });

document.getElementById('mapframe').src=location;

}
$('#allfaq').hide();
$('#showmore').click(()=>{
$('#allfaq').fadeToggle();
$('#showmore').text(function(i, text){
          return text === "show all" ? "hide" : "show all";
      })
});

$('#Sym-text').fadeOut();
$('#Prev-text').fadeOut();
$('#Spr-text').fadeOut();

$('#Sym-head').click(()=>{
    $('#Sym-text').fadeToggle();
})

$('#Prev-head').click(()=>{
    $('#Prev-text').fadeToggle();
})

$('#Spr-head').click(()=>{
    $('#Spr-text').fadeToggle();
})



</script>
<script async src="https://get.geojs.io/v1/ip/geo.js"></script>

    </body>
</html>
