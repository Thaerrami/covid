@include('layouts.adminapp')
@extends('bootstrap')

@section('content')

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
    
<div class="container p-2 " >
  
    <div class="row justify-content-center mt-3">
        <div class="col-md-3  bg-light rounded p-2 m-1">
            Some Statistics About Symptoms <span class="text-info">{{$symps[0]->title}}</span> ( <span class="text-warning">{{$symps[0]->num}}</span>) is the most frequent symptom
    <hr><br> the latest frequent symptom is <span class="text-info">{{$symps[count($symps)-1]->title}} </span> ( <span class="text-warning">{{$symps[count($symps)-1]->num}} </span>)
    <hr><br> <a href="#addnewsymp" class="btn btn-primary">Add New Symptoms</a>
    {{-- <hr><br> <a href="#addnewsymp" class="btn btn-primary">Add New Symptoms</a> --}}
        </div>
        <div class="col-md-8  bg-light rounded p-2 m-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <canvas id="oilChart" width="600" height="400"></canvas>
                </div>
            </div>
        </div>

        <div style="width: 95%" class="row justify-content-center bg-light rounded m-auto mb-4 ">
            <div class="w-100 m-3">All symptoms</div> 
             @foreach ($symps as $item)
             <div style="background-color: rgba(0, 255, 255, 0.15)" class=" p-1 m-1 rounded col-sm-6 col-md-2 text-center">{{$item->title}}</div>
             @endforeach
         </div>
         
        <div class="col-md-11  bg-light rounded p-2 m-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <canvas id="canvas" width="600" height="400"></canvas>
                </div>
            </div>
        </div>


        <div class="col-md-8 mt-5" >
            <div class="text-bold">Add New Symptom</div>
            <div class="card p-3 mt-3">
             <form  id="submit" method="POST" class="form-group">
                 @csrf
                <input name='title' id='title' type="text" class="form-control" required placeholder="symptom title" />
                <select name="symp_deg" id="symp_deg" class="form-control mt-2" required>
                    <option value="1">Normal</option>
                    <option value="2">In stable case</option>
                    <option value="3">Danger</option>
                </select>
                <input type="submit" class="btn btn-primary m-2" id='addnewsymp' />
             </form>
            </div>
            
        </div>
        
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">

<script>

$(document).ready(()=>{

$('#submit').on('submit',(e)=>{
    e.preventDefault();
    
    var title = $('#title').val();
    var symp_deg = $('#symp_deg').val();

  $.ajax({
    method:"POST",
    url:'../addnewsymp',
    data:{
      _token:"{{csrf_token()}}",
      symp_deg:symp_deg,
      title:title
    },
    success:(data)=>{
        alert('new symp added');
    },
    error:(error)=>{
      console.log(error)
    }
  })
})

});

 
 var url = "{{url('cov/sympnum')}}";
                        
                        var Days = new Array();
                        var Labelss = new Array();
                        var Cols=new Array();
                        $(document).ready(function(){
                          $.get(url, function(response){
                              console.log(response);
                            response.forEach(function(data){
                                Days.push(data.num);
                                Labelss.push(data.title);
                                Cols.push(getRandomColor());
                            });
                           
                            var ctx = document.getElementById("canvas").getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data : {
                                    datasets: [{
                                                data:Days
                                        }],
                                        // These labels appear in the legend and in the tooltips when hovering different arcs
                                        labels: Labelss,
                                        backgroundColor:Cols
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

var url = "{{url('cov/sympnum')}}";
                        
function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
                        var Color=new Array();
                        var Day = new Array();
                        var Labels = new Array();
                       
                        $(document).ready(function(){
                          $.get(url, function(response){
                              console.log(response);
                            response.forEach(function(data){
                                Day.push(data.num);
                                Labels.push(data.title);
                                    Color.push(getRandomColor());
                                });

var oilCanvas = document.getElementById("oilChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var oilData = {
    labels: Labels,
    datasets: [
        {
            data:Day,
            backgroundColor:Color
        }]
};

var pieChart = new Chart(oilCanvas, {
  type: 'pie',
  data: oilData
  });
  });
  });

</script>
@endsection