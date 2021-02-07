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
        <div class="w-100 d-flex position-fixed " style="left: 50%; margin-left:-30%; top:90px; z-index: 20;" id="a">
            from : <input type="date" max="{{date('Y-m-d')}}" style="font-size: .5em;width:40%"  value="2020-01-01" id="from" class="bg-white form-control w-25 mr-1">
            to :   <input type="date" max="{{date('Y-m-d')}}" style="font-size: .5em;width:40%" value="{{date('Y-m-d')}}" id="to" class="bg-white form-control w-25">
         </div>
        <div class="d-flex justify-content-between w-100 mt-4">
            <a href="admin/updatedaydata"><button class="btn btn-primary ml-5 mb-5" >Refesh</button></a>
            <a href="admin/updatedivces"><button class="btn btn-outline-primary ml-5 mb-5 float-right" >Advices +</button></a>
        </div>
        <div class="panel-heading"><b>daily Cases</b></div>
        <div class="row mb-4">
       <div class="col-md-6 col-md-offset-1 ">
           <div class="panel panel-default">
               <div class="panel-body">
                   <canvas id="canvas" height="280" width="600" class="chart1"></canvas>
               </div>
           </div>
       </div>
       <div class="col-md-5 col-md-offset-1 mt-5 ml-2 text-secondary">
       <b style='text-decoration: underline'> {{$breaf['date']}}</b> - Today cases were as following <b class="text-warning">( &nbsp;{{$breaf['daycase']}}&nbsp;)</b> cases , <b class="text-success">(&nbsp;{{$breaf['recover']}}&nbsp;)</b> recovered case , <b class="text-danger">(&nbsp;{{$breaf['death']}}&nbsp;)</b> death case 
    </div>
     </div>
     <div class="panel-heading"><b>Cases Status</b></div>
     <div class="row ">
        <div class="col-md-6 col-md-offset-1 mt-4 text-secondary">
            <b style='text-decoration: underline'> {{$breaf['date']}}</b> - Today cases status were as following <b class="text-warning">( &nbsp;{{$breaf['midcase']}}&nbsp;)</b>In stable state cases , <b class="text-success">(&nbsp;{{$breaf['norcase']}})&nbsp;</b> Good state cases , <b class="text-danger">(&nbsp;{{$breaf['dancase']}}&nbsp;)</b> Danger cases
        </div>
        <div class="col-md-6 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <canvas id="cases" height="280" width="600" class="chart1"></canvas>
                </div>
            </div>
        </div>
      </div>
      <div class="row w-100 mb-5 mt-5 d-flex justify-content-around text-center text-white " style="font-size: xx-large">
          <div class="col-3 bg-warning p-2 m-1 rounded" style="font-size: .4em"><div>All Cases</div><div>{{$c}}</div></div>
          <div class="col-3 bg-success p-2 m-1 rounded" style="font-size: .4em"><div>All Recover</div><div>{{$r}}</div></div>
          <div class="col-3 bg-danger  p-2 m-1 rounded" style="font-size: .4em"><div>All Death</div><div>{{$d}}</div></div>
      </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
                       
                       
                       <script>
                        var url = "{{url('cov/nums')}}";
                        
                        var Day = new Array();
                        var Labels = new Array();
                        var Prices = new Array();
                        var Deaths = new Array();
                       
                        $(document).ready(function(){
                          $.get(url, function(response){
                              
                            response.forEach(function(data){
                                Day.push(data.date);
                                Labels.push(data.recover);
                                Prices.push(data.daycase);
                                Deaths.push(data.death);
                            });
                           
                            var ctx = document.getElementById("canvas").getContext('2d');
                                var myChart = new Chart(ctx, {
                                  type: 'line',
                                  data: {
                                      labels:Day,
                                      datasets: [
                                          {
                                          label: 'Cases',
                                          data: Prices,
                                          borderColor: "rgb(216, 219, 29)",
                                          backgroundColor: [
                                            'rgb(208, 255, 0)',
                                              'rgba(209, 196, 8, 0.917)',
                                              'rgba(145, 197, 3, 0.911)',
                                              'rgba(201, 204, 12, 0.89)',
                                              'rgba(255, 230, 0, 0.91)',
                                              'rgba(255, 236, 64, 0.883)',
            ],
                                      },
                                      {
                                          label: 'recover',
                                          data: Labels,
                                          borderColor: "#3e95cd",
                                          backgroundColor: [
                                            'rgba(109, 255, 99, 0.2)',
                                                     'rgba(96, 235, 54, 0.2)',
                                                     'rgba(139, 255, 86, 0.2)',
                                                     'rgba(75, 192, 81, 0.2)',
                                                     'rgba(107, 255, 102, 0.2)',
                                                     'rgba(93, 255, 64, 0.2)',
            ],
                                      },
                                      {
                                          label: 'deaths',
                                          data: Deaths,
                                          borderColor: "rgb(206, 7, 7)",
                                          backgroundColor: [
                                            'rgba(255, 99, 99, 0.2)',
                                            'rgba(255, 99, 99, 0.589)',
                                            'rgba(235, 54, 54, 0.582)',
                                            'rgba(255, 86, 86, 0.541)',
                                            'rgba(192, 132, 75, 0.548)',
                                            'rgba(255, 252, 102, 0.561)',
                                            'rgba(255, 64, 214, 0.753)'
            ],
                                      }
                                      ]
                                  },
                                  options: {
                                      scales: {
                                          yAxes: [{
                                              ticks: {
                                                  beginAtZero:true
                                              }
                                          }]
                                      }
                                  }
                              });
                          });
                        });

                                //////////////////chart fa-rotate-270
        ///////////////////////////
                    ////////////////////////////////
////////////////////////////////////////////////////////////////////////
                        var ur = "{{url('cov/case')}}";
                        
                        var Days = new Array();
                        var Label = new Array();
                        var Price = new Array();
                        var Danger = new Array();
                       
                        $(document).ready(function(){
                          $.get(ur, function(response){
                            
                            response.forEach(function(data){
                                Days.push(data.date);
                                Label.push(data.midcase);
                                Price.push(data.norcase);
                                Danger.push(data.dancase);
                            });
                           
                            var ctx = document.getElementById("cases").getContext('2d');
                                var myChart = new Chart(ctx, {
                                  type: 'line',
                                  data: {
                                      labels:Days,
                                      datasets: [
                                          {
                                          label: 'normal',
                                          data: Price,
                                          borderColor: "#3e95cd",
                                          backgroundColor: [
                                                'rgba(109, 255, 99, 0.2)',
                                                     'rgba(96, 235, 54, 0.2)',
                                                     'rgba(139, 255, 86, 0.2)',
                                                     'rgba(75, 192, 81, 0.2)',
                                                     'rgba(107, 255, 102, 0.2)',
                                                     'rgba(93, 255, 64, 0.2)',
                                            ],
                                      },
                                      {
                                          label: 'in stable case',
                                          data: Label,
                                          borderColor: "rgb(216, 219, 29)",
                                          backgroundColor: [
                                              'rgb(208, 255, 0)',
                                              'rgba(209, 196, 8, 0.917)',
                                              'rgba(145, 197, 3, 0.911)',
                                              'rgba(201, 204, 12, 0.89)',
                                              'rgba(255, 230, 0, 0.91)',
                                              'rgba(255, 236, 64, 0.883)',
                                          ],
                                      },
                                      {
                                          label: 'danger',
                                          data: Danger,
                                          borderColor: "rgb(206, 7, 7)",
                                          backgroundColor: [
                                            'rgba(255, 99, 99, 0.2)',
                                            'rgba(255, 99, 99, 0.589)',
                                            'rgba(235, 54, 54, 0.582)',
                                            'rgba(255, 86, 86, 0.541)',
                                            'rgba(192, 132, 75, 0.548)',
                                            'rgba(255, 252, 102, 0.561)',
                                            'rgba(255, 64, 214, 0.753)'
            ],
                                      }
                                      ]
                                  },
                                  options: {
                                      scales: {
                                          yAxes: [{
                                              ticks: {
                                                  beginAtZero:true
                                              }
                                          }]
                                      }
                                  }
                              });
                          });
                        });
                       

         var e=document.getElementById('a');
         document.addEventListener("scroll",function(){
       
         var offset= window.scrollY;
         if(offset > 80 ){
             e.style.top='10px';
            }
            else{
                e.style.top='80px';
            }
        });


        var from=document.getElementById('from');
        var to=document.getElementById('to');

        from.addEventListener('change',()=>{sdate()});

        var sdate = function(){

            var url='./admin/date/data/';
            from=$('#from').val();
            to = $('#to').val();
            
    $.ajax({
        method:'GET',
        url:url,
        data:{
            _token:'{{csrf_token()}}',
            from:from,
            to:to,
        },
        success:(data)=>{
            console.log(data);
            Day=[];
            Labels=[];
            Prices=[];
            Deaths=[];
            for(var i of data[0]){
                Day.push(i.date);
                Labels.push(i.recover);
                Prices.push(i.daycase);
                Deaths.push(i.death);
            }

            var ctx = document.getElementById("canvas").getContext('2d');
                                var myChart = new Chart(ctx, {
                                  type: 'line',
                                  data: {
                                      labels:Day,
                                      datasets: [
                                          {
                                          label: 'Cases',
                                          data: Prices,
                                          borderColor: "rgb(216, 219, 29)",
                                          backgroundColor: [
                                            'rgb(208, 255, 0)',
                                              'rgba(209, 196, 8, 0.917)',
                                              'rgba(145, 197, 3, 0.911)',
                                              'rgba(201, 204, 12, 0.89)',
                                              'rgba(255, 230, 0, 0.91)',
                                              'rgba(255, 236, 64, 0.883)',
            ],
                                      },
                                      {
                                          label: 'recover',
                                          data: Labels,
                                          borderColor: "#3e95cd",
                                          backgroundColor: [
                                            'rgba(109, 255, 99, 0.2)',
                                                     'rgba(96, 235, 54, 0.2)',
                                                     'rgba(139, 255, 86, 0.2)',
                                                     'rgba(75, 192, 81, 0.2)',
                                                     'rgba(107, 255, 102, 0.2)',
                                                     'rgba(93, 255, 64, 0.2)',
            ],
                                      },
                                      {
                                          label: 'deaths',
                                          data: Deaths,
                                          borderColor: "rgb(206, 7, 7)",
                                          backgroundColor: [
                                            'rgba(255, 99, 99, 0.2)',
                                            'rgba(255, 99, 99, 0.589)',
                                            'rgba(235, 54, 54, 0.582)',
                                            'rgba(255, 86, 86, 0.541)',
                                            'rgba(192, 132, 75, 0.548)',
                                            'rgba(255, 252, 102, 0.561)',
                                            'rgba(255, 64, 214, 0.753)'
            ],
                                      }
                                      ]
                                  },
                                  options: {
                                      scales: {
                                          yAxes: [{
                                              ticks: {
                                                  beginAtZero:true
                                              }
                                          }]
                                      }
                                  }
                              });

//////////////////////////////////////////////////
//update status
                        var Days = [];
                        var Label = [];
                        var Price = [];
                        var Danger = [];

                        for(var i of data[1]){
                            Days.push(i.date);
                            Label.push(i.norcase);
                            Price.push(i.midcase);
                            Danger.push(i.dancase);
            }
                        
                        var ctx = document.getElementById("cases").getContext('2d');
                                var myChart = new Chart(ctx, {
                                  type: 'line',
                                  data: {
                                      labels:Days,
                                      datasets: [
                                          {
                                          label: 'normal',
                                          data: Price,
                                          borderColor: "#3e95cd",
                                          backgroundColor: [
                                                'rgba(109, 255, 99, 0.2)',
                                                     'rgba(96, 235, 54, 0.2)',
                                                     'rgba(139, 255, 86, 0.2)',
                                                     'rgba(75, 192, 81, 0.2)',
                                                     'rgba(107, 255, 102, 0.2)',
                                                     'rgba(93, 255, 64, 0.2)',
                                            ],
                                      },
                                      {
                                          label: 'in stable case',
                                          data: Label,
                                          borderColor: "rgb(216, 219, 29)",
                                          backgroundColor: [
                                              'rgb(208, 255, 0)',
                                              'rgba(209, 196, 8, 0.917)',
                                              'rgba(145, 197, 3, 0.911)',
                                              'rgba(201, 204, 12, 0.89)',
                                              'rgba(255, 230, 0, 0.91)',
                                              'rgba(255, 236, 64, 0.883)',
                                          ],
                                      },
                                      {
                                          label: 'danger',
                                          data: Danger,
                                          borderColor: "rgb(206, 7, 7)",
                                          backgroundColor: [
                                            'rgba(255, 99, 99, 0.2)',
                                            'rgba(255, 99, 99, 0.589)',
                                            'rgba(235, 54, 54, 0.582)',
                                            'rgba(255, 86, 86, 0.541)',
                                            'rgba(192, 132, 75, 0.548)',
                                            'rgba(255, 252, 102, 0.561)',
                                            'rgba(255, 64, 214, 0.753)'
            ],
                                      }
                                      ]
                                  },
                                  options: {
                                      scales: {
                                          yAxes: [{
                                              ticks: {
                                                  beginAtZero:true
                                              }
                                          }]
                                      }
                                  }
                              });

        },
        error:(data)=>{
            console.error(data)
        }
    })    

        }

     
        


    </script>


                        <div class="text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>