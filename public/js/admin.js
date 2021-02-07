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

from.addEventListener('change',sdat);

var sdate = function(){

}

