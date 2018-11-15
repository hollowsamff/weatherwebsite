<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description">
	<meta content="" name="author">

	<title>Weather finder</title>
     
  	 <!-- Load JQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  
	  <!-- Load JQuery UI -->
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
	  <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
	  <script src="jquery.ui.touch-punch.js"></script>

	 <script src="https://unpkg.com/leaflet@0.7.7/dist/leaflet.js"></script>

     <script type="text/javascript" src="leaflet-geosearch/docs/dist/bundle.min.js" charset="utf-8"></script>
     <script src="https://unpkg.com/leaflet-geosearch@latest/dist/bundle.min.js"></script>

     <script type="text/javascript" src="js/skycons.js"></script>
 
     <link rel="stylesheet" href="leaflet-geosearch/docs/dist/style.css" />
     <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@latest/assets/css/leaflet.css" />

	  <!-- Bootstrap -->
	  <script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js'></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	  
      <link href="css/style.css" rel="stylesheet">	
  
  
	<!--Poly Fills to make search for city work in IE 11-->  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.js"></script>
	<script>
	// https://tc39.github.io/ecma262/#sec-array.prototype.includes
	if (!Array.prototype.includes) {
	  Object.defineProperty(Array.prototype, 'includes', {
		value: function(searchElement, fromIndex) {

		  if (this == null) {
			throw new TypeError('"this" is null or not defined');
		  }

		  // 1. Let O be ? ToObject(this value).
		  var o = Object(this);

		  // 2. Let len be ? ToLength(? Get(O, "length")).
		  var len = o.length >>> 0;

		  // 3. If len is 0, return false.
		  if (len === 0) {
			return false;
		  }

		  // 4. Let n be ? ToInteger(fromIndex).
		  //    (If fromIndex is undefined, this step produces the value 0.)
		  var n = fromIndex | 0;

		  // 5. If n ≥ 0, then
		  //  a. Let k be n.
		  // 6. Else n < 0,
		  //  a. Let k be len + n.
		  //  b. If k < 0, let k be 0.
		  var k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);

		  function sameValueZero(x, y) {
			return x === y || (typeof x === 'number' && typeof y === 'number' && isNaN(x) && isNaN(y));
		  }

		  // 7. Repeat, while k < len
		  while (k < len) {
			// a. Let elementK be the result of ? Get(O, ! ToString(k)).
			// b. If SameValueZero(searchElement, elementK) is true, return true.
			if (sameValueZero(o[k], searchElement)) {
			  return true;
			}
			// c. Increase k by 1. 
			k++;
		  }

		  // 8. Return false
		  return false;
		}
	  });
	}
	</script>
  

  
  	 
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<style>


	.Closed:before {
	  display: inline-block;
	  font-family: "Glyphicons Halflings";
	  content:"\e080";
	  transform: rotate(-30deg);
	}


	div.scrollmenu {
		background-color: #333;
		overflow: auto;
		white-space: nowrap;
	}

	div.scrollmenu span {
		
		display: inline-block;
		text-align: center;
		padding: 0px;
		margin: 0px;
		text-decoration: none;
	}

	div.scrollmenu span:hover {
		background-color: #gray;
	}
	
	html, body, #map {
      height: 100%;
      width: 100%;
	  margin:0; padding:0;
    }
	
	 
	
	    #map { 
		margin-top:15px;
		margin-bottom:50px;
		margin-left:0;
		left:0px;
		height:20px;  
		position: relative;
	}
	
	
   <!--Search bar-->
   .leaflet-touch .leaflet-bar a {
		width: 0px;
	}

	.leaflet-left .leaflet-control {
	   margin-left: 0px;
	}

	.leaflet-container .leaflet-control-attribution, .leaflet-container .leaflet-control-scale {
		font-size: 8px;
	}
   
   .leaflet-control-geosearch form {	
		background-color:white;
   }
	.leaflet-control-geosearch{
		
		position: absolute;
		left: 0px!important;
		right: 0px!important;
		top: 25px!important;		
	}
    
	.leaflet-zoom-animated{
		   
		   transform: none!important;

	}
	
	.leaflet-control-geosearch a.reset {
        color: #9e0404;
	    padding: 0px;
		margin-left: 1px;
		font-size:17px;
	}

    .leaflet-control-geosearch.bar{		
		   width:300px;
	 }
	 
	
	 #convertbutton{
		position: absolute;
		left: 1100px;
    	top: 50px;
	}


	.fab {
		position: absolute;
		top: 40px;
		left: 480px;
		z-index: 100;
		background-color: #D0D0D0;
		margin:0px;
	}
	
   @media only screen and (max-width: 1285px) and (max-height: 955px) {
			
	.fab{
		left: 435px;
	 }
   }	 
		 	@media only screen and (max-width: 1295px) {
		.fab{
		left: 400px;
	 }
	}
   
	@media only screen and (max-width: 1025px) {
			
		  .fab {
			left: 300px;
		   }
		   
		   #convertbutton{
		 
			left: 900px;	
		  }
	}
	 
	 	/* Kindle Fire portrait  and nexus 10*/
	@media only screen 
	  and (min-device-width: 800px) 
	  and (max-device-width: 1280px) 
	  and (min-device-height: 1280px) 
	  and (max-device-height: 1300px)
	  and (-webkit-min-device-pixel-ratio: 1.5)	  
	  and (orientation: portrait) {
		  
		#convertbutton{
		    position:relative;
		}
		#windSpeed{
				margin-left:0px;
			}
			#windtitle{
				margin-left:0px;
			}
	}
	
	@media only screen and (max-width: 895px) {

	  .fab {
		left: 180px;
	   }
	      #convertbutton{
		  left:670px;
		}
	}	
	 
	@media only screen and (max-width: 642px) {
	
	
	#convertbutton{
		      left: 110px;
              position: relative;
              top: -15px;
		}
	    .leaflet-control-geosearch.bar{		
		       width: 170px;
               margin-left: 40px;
	     }
		 
		  .fab {
		   left: 0px;
	   }
	   
	    #map { 

		height:0px;  

	}
	
	}
	
  </style>
  
</head>

<body>
    <!-- Navigation bar-->
    <nav class="navbar navbar-inverse navbar-fixed-top" >

        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
				</button> 
			<a class= "navbar-brand " href='index.php'>Home</a>
			</div>	
		
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					   <li><a style="color:white;" href ="timemachines.php">Time machine</a></li>
			     </ul>
		      </div>
        </div>
        <!-- /.container -->
    </nav>


	<!--Code used to change the color of the active webpage-->
	<style>
	nav a.current {
	  background-color:#3CB371;
	}
	
	</style>

	<script>
	$(function(){
	  $('a').each(function() {
		if ($(this).prop('href') == window.location.href) {
		  $(this).addClass('current');
	  }
	  });
	});
	</script>


		<section class="col-sm-12" style="background-color:#EEEEEE">

	<div id='map' style="">
	

	</div>
		<Button lat="" lng="" id='locatebutton' class="fab FolderTitle Closed" aria-hidden="true">
		</Button>

	
   	<div id="convertbutton" class="btn-group" role="group" style="margin: 0px; padding: 0px">
		
		<button id="currentdropdownselect" type="button" name="fahrenheite" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%">
    	˚F,&nbsp;mph 
		 
		 <span class="caret"></span>
		  
		</button>
		<ul class="dropdown-menu">
		  <li><a name="˚C, m/s"	id="˚F,&nbsp;mph" href="#">˚F,&nbsp;mph</a></li>
		  <li><a id="˚C,&nbsp;mph" href="#"> ˚C,&nbsp;mph</a></li>
		  <li><a id="˚C,&nbsp;m/s" href="#"> ˚C,&nbsp;m/s</a></li>
		  <li><a id="˚C,&nbsp;km/h" href="#"> ˚C,&nbsp;km/h</a></li>
		  
		</ul>
		
      </div>
   </section>
	
	  <div class="scrollmenu"  id="scrollone" style="background-color:white;padding:5px; height: 40px;">
	    <span id="daterequestdaybefor"></span>
        <span id="daterequest"></span>
	    <span id="daterequestdaybeafter"></span>
	  </div>
	  <p>Select Date: <input lat='' lng='' type="text" id="datepicker"></p>
       
	   <div id="tempreture" class="col-sm-12" style="background-color:#FCFCFC"></div>
	  
	  <div class="row">
	  
		  <div class="col-sm-10 col-sm-offset-1">	
		  
				<p>
				  <label for="amount">Time:</label>
				  <input type="text" id="amount" readonly style="border:0; color:black; font-weight:bold;">
				</p>
				<div id="slider-range-max"></div>
				
				
			</div>

	 </div>
	 
	 <script>$('#widget').draggable();</script>
	 <hr>
	
	   <div class="scrollmenu  col-sm-offset-1 col-sm-11" id="weatherbar" style="background-color:white;padding:5px; height: 100px;">
	   </div>
	  
	  

 
	 <div class="scrollmenu" style="background-color:#F7F7F7; padding:10px">
         
		<span class="thick">Temp: </span><span name="" temp="" style="opacity:0.731232;" id="tempreturecurrent"></span>
		
		<span id="" style="padding-right:15px; opacity: 0.731232;"></span>
		
		<span " class="thick">Wind: </span><span name="mph" speed="" style="opacity:0.731232;" id="windSpeed"></span>
		<span id="" style="padding-right:15px; opacity: 0.731232;"></span>
		
		<span class="thick">Humidity: </span><span style="opacity:0.731232;" id="humidity"></span> 
		<span id="" style="padding-right:15px; opacity: 0.731232;"></span>
	

		<span class="thick" >UV Index: </span><span style="background-color:#94D587; opacity:0.731232; "  id="uv"></span>
		<span id="" style="padding-right:15px; opacity: 0.731232;"></span>
	
     </div>

	<div class="scrollmenu" style="background-color:#F7F7F7; padding:10px">

		<span class="thick" >Precip: </span><span style=" opacity:0.731232; "  id="precip"></span>
		<span id="" style="padding-right:15px; opacity: 0.731232;"></span>
	 
		<span class="thick" >Pressure: </span><span  style="opacity:0.731232;" id="pressure"></span> <span style="padding-right:15px; opacity: 0.731232;">hPa</span>
		
		<span class="thick" >Dew Pt: </span><span  style="opacity:0.731232;" id="dewpoint"></span>
		<span id="" style="padding-right:15px; opacity: 0.731232;">˚</span>
		
			<span class="thick">Visibility: </span><span name="miles" miles="" style="opacity:0.731232;" id="visibility"></span>
		<span id="" style="padding-right:15px; opacity: 0.731232;"></span>
	
   </div>

	  
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 

  <div id="chart_div"></div>
    <div id="chartdivprecipitation"></div>
	  <div id="chartdivhumidity"></div>
    <div id="chartdivwind"></div>
  <div id="chartdivpressure"></div>
<div id="chartdivuv"></div>

<section style=" padding-bottom:20px;margin-bottom:100px">
</section>

	  
  <!-- website footer-->
        <footer  class="navbar-fixed-bottom" style=" background-color:black;width:100%;">
            <div class="row">
                <div class="col-lg-12">
                    <p style = "color:#fff">

						Search function use the <a href="https://leafletjs.com">leafletjs</a><br>and
						<a href="https://github.com/smeijer/leaflet-geosearch"> the leaflet-geosearch </a>plugins<br>
						Weather functions use the <a href="https://darksky.net">
						Dark Sky</a> API
                        <br>
					   Uses the <a href="http://touchpunch.furf.com/">touchpunch</a> plugin to make it jQuery ui responsive on mobiles<br>
					   Uses <a href="https://developers.google.com/chart/">Googe charts</a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>		
	
    <style>

 .ui-slider .ui-slider-handle {
    height: 20px;
    width: 1px;
    padding-left: 10px; 
	background-color:red!important;
	opacity:0.5;
}




.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
  
    background: none;

}




  </style>
<script>
input.addEventListener('input', (e) => { this.onInput(e); }, false);
input.addEventListener('keyup', (e) => { this.onKeyUp(e); }, false);
input.addEventListener('keypress', (e) => { this.onKeyPress(e); }, false);
input.addEventListener('click', (e) => { e.preventDefault(); e.stopPropagation(); e.target.focus(); }, false);
input.addEventListener('focus', (e) => { this.onFocus(e); }, false);
input.addEventListener('blur', (e) => { this.onBlur(e); }, false);
  


var currentWeatherData = "";//global variable used to hold weather data
var currentTime = 0;//global variable used to current time of the weather that is being shown


 function drawPrecipitationProbabilityLineChart(result) {
	
	      var data = new google.visualization.DataTable();
			data.addColumn('string', 'Date');//Add the chart rows, x axis is date and y axis is users average score
			data.addColumn('number', 'Precipitation Probability');

	      data.addRows([
			["12 AM", Math.round(result["hourly"].data[0].precipProbability*100)],
			["2 AM", Math.round(result["hourly"].data[2].precipProbability*100) ],
			["4 AM",Math.round(result["hourly"].data[4].precipProbability*100) ],
			["6 AM",Math.round(result["hourly"].data[6].precipProbability*100) ],
			["8 AM", Math.round(result["hourly"].data[8].precipProbability*100) ],
			["10 AM", Math.round(result["hourly"].data[10].precipProbability*100) ],
			["12 PM", Math.round(result["hourly"].data[12].precipProbability*100) ],
			["2 AM", Math.round(result["hourly"].data[14].precipProbability*100) ],
			["4 AM",Math.round(result["hourly"].data[16].precipProbability*100) ],
			["6 AM",Math.round(result["hourly"].data[18].precipProbability*100) ],
			["8 AM", Math.round(result["hourly"].data[20].precipProbability*100) ],
			["10 AM", Math.round(result["hourly"].data[22].precipProbability*100) ],
			["11 AM", Math.round(result["hourly"].data[23].precipProbability*100) ]
		  ]);

		  var formatter = new google.visualization.NumberFormat({
			  suffix: '%',pattern:'#'
		   }
          );
           formatter.format(data,1);

		    var options = {

		     pointSize: 5
		   ,
		   vAxis: {format: '#\'%\''},
		   legend: {position: 'none'},
		   
			title: 'Precipitation Probability',
			backgroundColor: 'white'

		  };

		  var chart = new google.visualization.LineChart(document.getElementById('chartdivprecipitation'));
		  chart.draw(data, options);	
}


function drawHumidityLineChart(result) {
	
	      var data = new google.visualization.DataTable();
		  data.addColumn('string', 'Date');//Add the chart rows, x axis is date and y axis is users average score
		  data.addColumn('number', 'Humidity');
		
	      data.addRows([
			["12 AM", Math.round(result["hourly"].data[0].humidity*100) ],
			["2 AM", Math.round(result["hourly"].data[2].humidity*100) ],
			["4 AM",Math.round(result["hourly"].data[4].humidity*100) ],
			["6 AM",Math.round(result["hourly"].data[6].humidity*100)],
			["8 AM", Math.round(result["hourly"].data[8].humidity*100) ],
			["10 AM", Math.round(result["hourly"].data[10].humidity*100)],
			["12 PM", Math.round(result["hourly"].data[12].humidity*100) ],
			["2 AM", Math.round(result["hourly"].data[14].humidity*100) ],
			["4 AM",Math.round(result["hourly"].data[16].humidity*100) ],
			["6 AM",Math.round(result["hourly"].data[18].humidity*100) ],
			["8 AM", Math.round(result["hourly"].data[20].humidity*100) ],
			["10 AM", Math.round(result["hourly"].data[22].humidity*100)],
			["12 AM", Math.round(result["hourly"].data[23].humidity*100)]
		  ]);
		  
		  var formatter = new google.visualization.NumberFormat({
			  suffix: '%',pattern:'#'
		   }
          );
           formatter.format(data,1);
		    var options = {
			 vAxis: {
			  title: ''
		   },pointSize: 5,
		     vAxis: {format: '#\'%\''},
		   legend: {position: 'none'},
			title: 'Humidity',
			backgroundColor: 'white'
		  };

		  var chart = new google.visualization.LineChart(document.getElementById('chartdivhumidity'));
		  chart.draw(data, options);			  
}


function drawUVLineChart(result) {

    if(typeof result["hourly"].data[0].uvIndex != "undefined"){
	
	      var data = new google.visualization.DataTable();
		  data.addColumn('string', 'Date');//Add the chart rows, x axis is date and y axis is users average score
		  data.addColumn('number', 'UV index');
		  //data.addColumn({type: 'string', role: 'annotation'});
		  
	      data.addRows([
			["12 AM", Math.round(result["hourly"].data[0].uvIndex)],
			["2 AM", Math.round(result["hourly"].data[2].uvIndex) ],
			["4 AM", Math.round(result["hourly"].data[4].uvIndex) ],
			["6 AM", Math.round(result["hourly"].data[6].uvIndex) ],
			["8 AM", Math.round(result["hourly"].data[8].uvIndex) ],
			["10 AM", Math.round(result["hourly"].data[10].uvIndex)],
			["12 PM", Math.round(result["hourly"].data[12].uvIndex) ],
			["2 AM", Math.round(result["hourly"].data[14].uvIndex) ],
			["4 AM", Math.round(result["hourly"].data[16].uvIndex) ],
			["6 AM", Math.round(result["hourly"].data[18].uvIndex) ],
			["8 AM", Math.round(result["hourly"].data[20].uvIndex) ],
			["10 AM", Math.round(result["hourly"].data[22].uvIndex) ],
			["11 AM", Math.round(result["hourly"].data[23].uvIndex) ]
		  ]);
		    var options = {
			 vAxis: {
			  title: ''
		   },pointSize: 5,
		   legend: {position: 'none'},
			title: 'UV index',
			backgroundColor: 'white'
		  };

		  var chart = new google.visualization.LineChart(document.getElementById('chartdivuv'));
		  chart.draw(data, options);	
    }		  
}
	
function drawPressureLineChart(result) {
	
	      var data = new google.visualization.DataTable();
		  data.addColumn('string', 'Date');//Add the chart rows, x axis is date and y axis is users average score
		  data.addColumn('number', 'Atmospheric Pressure');
		 
	      data.addRows([
			["12 AM" , Math.round(result["hourly"].data[0].pressure)],
			["2 AM", Math.round(result["hourly"].data[2].pressure)],
			["4 AM", Math.round(result["hourly"].data[4].pressure) ],
			["6 AM", Math.round(result["hourly"].data[6].pressure)],
			["8 AM", Math.round(result["hourly"].data[8].pressure) ],
			["10 AM", Math.round(result["hourly"].data[10].pressure)],
			["12 PM", Math.round(result["hourly"].data[12].pressure) ],
			["2 AM", Math.round(result["hourly"].data[14].pressure)],
			["4 AM", Math.round(result["hourly"].data[16].pressure) ],
			["6 AM", Math.round(result["hourly"].data[18].pressure)],
			["8 AM", Math.round(result["hourly"].data[20].pressure) ],
			["10 AM", Math.round(result["hourly"].data[22].pressure)],
			["11 AM", Math.round(result["hourly"].data[22].pressure)]
		  ]);
		  var formatter = new google.visualization.NumberFormat({
			  suffix: ' hPa',pattern:'#'
		   }
          );
           formatter.format(data,1);
		    var options = {
			  vAxis: {
          title: 'hPa'
        },pointSize: 5,
		 vAxis: {format: '#\' hPa\''},
		   legend: {position: 'none'},
			title: 'Atmospheric Pressure',
			backgroundColor: 'white'
		  };

		  var chart = new google.visualization.LineChart(document.getElementById('chartdivpressure'));
		  chart.draw(data, options);			  
}	
		
//Draw tempreture chart
function drawTempLineChart(result, typeTemp) {
	
	  //console.log(result);
	  var typeTemp = typeTemp;
	  
      if(typeTemp == "fahrenheit"){

		  var data = new google.visualization.DataTable();
		  data.addColumn('string', 'Date');//Add the chart rows, x axis is date and y axis is users average score
		  data.addColumn('number', 'Fahrenheit');


		  data.addRows([
			["12 AM", Math.round(result["hourly"].data[0].apparentTemperature) ],
			["2 AM", Math.round(result["hourly"].data[2].apparentTemperature) ],
			["4 AM", Math.round(result["hourly"].data[4].apparentTemperature)],
			["6 AM", Math.round(result["hourly"].data[6].apparentTemperature) ],
			["8 AM", Math.round(result["hourly"].data[8].apparentTemperature) ],
			["10 AM", Math.round(result["hourly"].data[10].apparentTemperature) ],
			["12 PM", Math.round(result["hourly"].data[12].apparentTemperature) ],
			["2 AM", Math.round(result["hourly"].data[14].apparentTemperature) ],
			["4 AM", Math.round(result["hourly"].data[16].apparentTemperature) ],
			["6 AM", Math.round(result["hourly"].data[18].apparentTemperature)],
			["8 AM", Math.round(result["hourly"].data[20].apparentTemperature) ],
			["10 AM", Math.round(result["hourly"].data[22].apparentTemperature) ],
			["11 AM", Math.round(result["hourly"].data[23].apparentTemperature) ]
		  ]);

		   var formatter = new google.visualization.NumberFormat({
			  suffix: '˚F',pattern:'#'
		   }
          );
           formatter.format(data,1);
		  
		  
		  var options = {
			 vAxis: {
			  title: 'Fahrenheit'
		   }
		   ,pointSize: 5,
		    vAxis: {format: '#\'˚F\''},
		   legend: {position: 'none'},
			title: 'Temperature / Feels Like',
			backgroundColor: 'white'
		  };

		  var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		  chart.draw(data, options);	

      }else{
		
		  var data = new google.visualization.DataTable();
		  data.addColumn('string', 'Date');//Add the chart rows, x axis is date and y axis is users average score
		  data.addColumn('number', 'Centergrade');


		  data.addRows([
			["12 AM", convertCentergrade(Math.round(result["hourly"].data[0].apparentTemperature))],
			["2 AM", convertCentergrade(Math.round(result["hourly"].data[2].apparentTemperature))],
			["4 AM", convertCentergrade(Math.round(result["hourly"].data[4].apparentTemperature))],
			["6 AM", convertCentergrade(Math.round(result["hourly"].data[6].apparentTemperature))],
			["8 AM", convertCentergrade(Math.round(result["hourly"].data[8].apparentTemperature))],
			["10 AM", convertCentergrade(Math.round(result["hourly"].data[10].apparentTemperature))],
			["12 PM", convertCentergrade(Math.round(result["hourly"].data[12].apparentTemperature))],
			["2 AM", convertCentergrade(Math.round(result["hourly"].data[14].apparentTemperature))],
			["4 AM", convertCentergrade(Math.round(result["hourly"].data[16].apparentTemperature))],
			["6 AM",convertCentergrade( Math.round(result["hourly"].data[18].apparentTemperature))],
			["8 AM", convertCentergrade(Math.round(result["hourly"].data[20].apparentTemperature))],
			["10 AM", convertCentergrade(Math.round(result["hourly"].data[22].apparentTemperature))],
			["11 AM", convertCentergrade(Math.round(result["hourly"].data[23].apparentTemperature))]
		  ]);
		   var formatter = new google.visualization.NumberFormat({
			  suffix: '˚',pattern:'#'
		   }
          );
           formatter.format(data,1);
		 
		  var options = {
			 vAxis: {
			  title: 'Centergrade'
		   }, 
		   vAxis: {format: '#\'˚\''},
		   legend: {position: 'none'}
		   ,pointSize: 5,
			title: 'Temperature / Feel like',
			backgroundColor: 'white'
		  };

		  var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		  chart.draw(data, options);	
	  }	  
}

//Draw tempreture chart
function drawWindLineChart(result, typeTemp) {
	
	  //console.log(result);
	  var typeTemp = $("#windSpeed").attr("name") ;
	  //alert(typeTemp);

	   var data = new google.visualization.DataTable();
	   data.addColumn('string', 'Date');//Add the chart rows, x axis is date and y axis is users average score
	   data.addColumn('number', 'Wind Speed');
	 
	  
      if(typeTemp == "m/s"){
	    data.addRows([
			["12 AM", Math.round(result["hourly"].data[0].windSpeed*0.44704) ],
			["2 AM", Math.round(result["hourly"].data[2].windSpeed*0.44704) ],
			["4 AM", Math.round(result["hourly"].data[4].windSpeed*0.44704) ],
			["6 AM", Math.round(result["hourly"].data[6].windSpeed*0.44704) ],
			["8 AM", Math.round(result["hourly"].data[8].windSpeed*0.44704) ],
			["10 AM", Math.round(result["hourly"].data[10].windSpeed*0.44704) ],
			["12 PM", Math.round(result["hourly"].data[12].windSpeed*0.44704) ],
			["2 AM", Math.round(result["hourly"].data[14].windSpeed*0.44704) ],
			["4 AM", Math.round(result["hourly"].data[16].windSpeed*0.44704) ],
			["6 AM", Math.round(result["hourly"].data[18].windSpeed*0.44704) ],
			["8 AM", Math.round(result["hourly"].data[20].windSpeed*0.44704) ],
			["10 AM", Math.round(result["hourly"].data[22].windSpeed*0.44704) ],
			["11 AM", Math.round(result["hourly"].data[23].windSpeed*0.44704) ]
		  ]);
		   var formatter = new google.visualization.NumberFormat({
			  suffix: ' m/s',pattern:'#'
		   }
          );
          
		  formatter.format(data,1);
		 
		  var options = {
			 vAxis: {
			  title: ' m/s'
		   }
		   ,pointSize: 5,
		   vAxis: {format: '#\' m/s\''},
		   legend: {position: 'none'},
			title: 'Wind',
			backgroundColor: 'white'
		  };
		  
      }else if(typeTemp == "km/h") {

		  data.addRows([
			["12 AM", Math.round(result["hourly"].data[0].windSpeed*1.609344) ],
			["2 AM", Math.round(result["hourly"].data[2].windSpeed*1.609344) ],
			["4 AM", Math.round(result["hourly"].data[4].windSpeed*1.609344) ],
			["6 AM", Math.round(result["hourly"].data[6].windSpeed*1.609344) ],
			["8 AM", Math.round(result["hourly"].data[8].windSpeed*1.609344) ],
			["10 AM", Math.round(result["hourly"].data[10].windSpeed*1.609344) ],
			["12 PM", Math.round(result["hourly"].data[12].windSpeed*1.609344) ],
			["2 AM", Math.round(result["hourly"].data[14].windSpeed*1.609344) ],
			["4 AM", Math.round(result["hourly"].data[16].windSpeed*1.609344) ],
			["6 AM", Math.round(result["hourly"].data[18].windSpeed*1.609344) ],
			["8 AM", Math.round(result["hourly"].data[20].windSpeed*1.609344) ],
			["10 AM", Math.round(result["hourly"].data[22].windSpeed*1.609344) ],
			["11 AM", Math.round(result["hourly"].data[23].windSpeed*1.609344) ]
		  ]);
		   var formatter = new google.visualization.NumberFormat({
			  suffix: ' km/h',pattern:'#'
		   }
          );
          
		  formatter.format(data,1);
		 
		  var options = {
			 vAxis: {
			  title: 'km/h'
		   }
		   ,pointSize: 5,
		   vAxis: {format: '#\' km/h\''},
		   legend: {position: 'none'},
			title: 'Wind',
			backgroundColor: 'white'
		  };
		  
	  }else{
		  
		  data.addRows([
			["12 AM", Math.round(result["hourly"].data[0].windSpeed) ],
			["2 AM", Math.round(result["hourly"].data[2].windSpeed) ],
			["4 AM", Math.round(result["hourly"].data[4].windSpeed) ],
			["6 AM", Math.round(result["hourly"].data[6].windSpeed) ],
			["8 AM", Math.round(result["hourly"].data[8].windSpeed) ],
			["10 AM", Math.round(result["hourly"].data[10].windSpeed) ],
			["12 PM", Math.round(result["hourly"].data[12].windSpeed) ],
			["2 AM", Math.round(result["hourly"].data[14].windSpeed) ],
			["4 AM", Math.round(result["hourly"].data[16].windSpeed) ],
			["6 AM", Math.round(result["hourly"].data[18].windSpeed) ],
			["8 AM", Math.round(result["hourly"].data[20].windSpeed) ],
			["10 AM", Math.round(result["hourly"].data[22].windSpeed) ],
			["11 AM", Math.round(result["hourly"].data[22].windSpeed) ]
		  ]);
		   var formatter = new google.visualization.NumberFormat({
			  suffix: ' mph',pattern:'#'
		   }
          );
          
		  formatter.format(data,1);
		 
		  var options = {
			 vAxis: {
			  title: ' mph'
		   }
		   ,pointSize: 5,
		   vAxis: {format: '#\' mph\''},
		   legend: {position: 'none'},
			title: 'Wind',
			backgroundColor: 'white'
		  }; 
		  
		  
	  }
		

		  var chart = new google.visualization.LineChart(document.getElementById('chartdivwind'));
		  chart.draw(data, options);	
	    
}


 function getDate(dayFromToday, lat ,lng){
	
	 showLocalWeather2(lat,lng, dayFromToday);
     map.setView(new L.LatLng(lat,lng));
	 var newDate = new Date();
	 newDate.setDate(newDate.getDate() +parseInt(dayFromToday));
	 $("#datepicker").datepicker().datepicker("setDate", newDate);  
	 
  }
////////////////////////////////////////////////////////////

    var numberOfDayFromToday = 0;
   
    var GeoSearchControl = window.GeoSearch.GeoSearchControl;
	var OpenStreetMapProvider = window.GeoSearch.OpenStreetMapProvider;

	var provider = new OpenStreetMapProvider();

	var map = new L.Map('map');
	map.setZoom(11);

	var searchControl = new GeoSearchControl({
		provider: provider,
		style: 'bar',
		showMarker: false,
		retainZoomLevel: false,
		autoClose: true,  
		position:"topright",
		animateZoom: false
								 
	});


	var results = L.layerGroup().addTo(map)

	map.addControl(searchControl);

	map.on('geosearch/showlocation', function(data){
		
		//console.log(data["location"]);
		//showLocalWeather2(data["location"]["y"],data["location"]["x"],numberOfDayFromToday);			
		//$(".glass").attr("placeholder", data["location"]["label"]);		
        $//(document).attr("title", data["location"]["label"]);
			
	});


	function onLocationFound(e) {
		
		//console.log(e);
		//showLocalWeather2(e["latitude"],e["longitude"],numberOfDayFromToday);		
		//map.setView(new L.LatLng(e["latitude"],e["longitude"],numberOfDayFromToday));	
		///$(".glass").attr("placeholder", "Your location");
		//$(document).attr("title", "Your location");
		
	}


	function onLocationError(e) {
		
		 //alert(e.message);
		// showLocalWeather2(40.7127,-74.0059,numberOfDayFromToday);
		 //map.setView(new L.LatLng(40.7306,-73.9866));
		 //$(".glass").attr("placeholder", "Default location - New York");
		// $(document).attr("title", "Default location - New York");
	}


	//findLocation();
		
	function findLocation(){

	  //map.on('locationfound', onLocationFound);
	 // map.on('locationerror', onLocationError);
	 // map.locate({setView: true, maxZoom: 10});	  
	}
  
 
	
////////////////////////////////////////////////////////////////////
  
  
function getQueryStringValue (key) {  
  
  return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));  
 
}  

var currentCity = "";

$("document").ready(function() {
	
if(getQueryStringValue("day") != "" && getQueryStringValue("lng") != ""  && getQueryStringValue("lat") != ""){//When user has loaded the page useing the 6 next day buttons on the index page 
	
     $(".glass").attr("placeholder", getQueryStringValue("cityname"));
	 $(document).attr("title", getQueryStringValue("cityname"));
	// Would write the value of the QueryString-variable called name to the console  
	//console.log(getQueryStringValue("day"));
    var lat  = getQueryStringValue("lat");
	var lng  = getQueryStringValue("lng");
	var day = parseInt(getQueryStringValue("day"));
	
	var newDate = new Date();
	newDate.setDate(newDate.getDate() + day);
	$("#datepicker").datepicker().datepicker("setDate", newDate);  
	
	currentCity = getQueryStringValue("cityname");
	showLocalWeather2(lat , lng , getQueryStringValue("day"));
    map.setView(new L.LatLng(lng ,lng));	
	
	
}else{
		
	findLocation();
	//Show current date when page loads
    $("#datepicker").datepicker().datepicker("setDate", new Date());  
}

});


$(document).on("click", "#locatebutton", function(e){

 event.preventDefault();
 findLocation();
	
	
})


//////////////////////////////////////////////////////////
 
  function showLocalWeather2(lat, lng, numberOfDayFromToday) {

    //The location is saved in the locationLat and locationLong div boxes when the page loads
    var latitude = lat;
    //alert(latitude)
    var longitude = lng;
    //alert(longitude);

	$("#datepicker").attr("lat", latitude);
	$("#datepicker").attr("lng", longitude);
	
    var numberOfDayFromToday = parseInt(numberOfDayFromToday);
	var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

    var now = new Date();
	now.setDate(now.getDate() + numberOfDayFromToday);
	$("#daterequest").html(""+now.toLocaleDateString("en-US", options)+"");

	now = new Date();
	numberOfDayFromToday  = numberOfDayFromToday - 1;//Get day befor picked day
	now.setDate(now.getDate() + numberOfDayFromToday );
    $("#daterequestdaybefor").html("<a onclick='getDate("+numberOfDayFromToday+","+ latitude  +","+longitude+")' href='javascript:void(0)' style='padding-right:20px'>←"+now.toLocaleDateString("en-US", options)+"</a>");
	
	now = new Date();
	numberOfDayFromToday  = numberOfDayFromToday + 2;//Get day after picked day
	now.setDate(now.getDate() + numberOfDayFromToday );
	//now = new Date((now*1000)).toLocaleTimeString([], {weekday: "long", year: "numeric", month: "long", day: "numeric"})
	$("#daterequestdaybeafter").html("<a onclick='getDate("+numberOfDayFromToday+","+ latitude  +","+longitude+")' style='padding-left:20px' href='javascript:void(0)'>"+now.toLocaleDateString("en-US", options)+"→</a>");

    var ts = Math.round((new Date(now)).getTime() / 1000);//Convert time to correct format

    var url =
      "https://api.darksky.net/forecast/abf791e0b7cfcc44c018d320240d62fa/" +
      latitude +
      "," +
      longitude + ","+
	  ts;
	  
    $.ajax({
      url: url,
      dataType: "jsonp",
      success: function(data) {
  
     var myMapsApiKey = 'SomeMagicToSetThis';
   
	 google.charts.load('current', {
	 packages: ['corechart','line'], 
	 mapsApiKey: myMapsApiKey  
	 
	}).then(function () {	
		  
		drawTempLineChart(data, $("#currentdropdownselect").attr("name"));
 	    drawUVLineChart(data);
        drawPressureLineChart(data);
		drawHumidityLineChart(data);
		drawPrecipitationProbabilityLineChart(data);
	    drawWindLineChart(data,$("#windSpeed").attr("speed"));
		
    });

	     currentWeatherData = data;//Save result in global variable
	  
	     //console.log(data);
        var weather = data["currently"].summary;
        var day = data["hourly"].summary;
	 
		var nextH1 = new Date((data["daily"].data[0].sunriseTime*1000)).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        var nextH2 = new Date((data["daily"].data[0].sunsetTime*1000)).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
		var nextH3 = new Date((data["hourly"].data[0].time*1000)).toLocaleString('en-UK', { hour: 'numeric', hour12: true });
		var nextH4 = new Date((data["hourly"].data[22].time*1000)).toLocaleString('en-UK', { hour: 'numeric', hour12: true });
		
		if($("#currentdropdownselect").attr("name") == "fahrenheite"){

        $("#tempreture").html("<h2>"+day+"</h2>"
        +"<strong style='font-size: 17px;'><span name='fahrenheite' id='currenttemp12'>" + Math.round(data["hourly"].data[0].apparentTemperature) 
		+"</span><span id='currenttempsign12' >&#x2109;</span></strong>&nbsp"+nextH3+"&nbsp→&nbsp" +"<strong style='font-size: 17px;'><span name='fahrenheite' id='currenttemp10'>" + Math.round(data["hourly"].data[22].apparentTemperature) 
		+"</span><span id='currenttempsign10' >&#x2109;</span></strong>&nbsp"+nextH4+"&nbsp&nbsp&nbsp<span> Sunrise: "+nextH1+"</span>&nbsp<span>Sunset: "+nextH2+"</span>");
		
		}else{
			
	     $("#tempreture").html("<h2>"+day+"</h2>"
         +"<strong style='font-size: 17px;'><span name='centergrade' id='currenttemp12'>" + Math.round(convertCentergrade(data["hourly"].data[0].apparentTemperature)) 
		 +"</span><span id='currenttempsign12' >&deg;</span></strong>&nbsp"+nextH3+"&nbsp→&nbsp" +"<strong style='font-size: 17px;'><span name='centergrade' id='currenttemp10'>" + Math.round(convertCentergrade(data["hourly"].data[22].apparentTemperature)) 
		 +"</span><span id='currenttempsign10' >&deg;</span></strong>&nbsp"+nextH4+"&nbsp&nbsp&nbsp<span> Sunrise: "+nextH1+"</span>&nbsp<span>Sunset: "+nextH2+"</span>");
		
		}
		
		
		
	    //Create icons for weather - uses https://github.com/darkskyapp/skyconsicns -  https://github.com/darkskyapp/skycons
		var skycons = new Skycons({"resizeClear": true});
        skycons.add(document.getElementById("icon"), data.currently.icon);

		//Current temp
	    if (typeof data["currently"].uvIndex !== "undefined") {//Show message when city not found
		
		$("#uv").html("&nbsp"+data["currently"].uvIndex);
	
		 if(data["currently"].uvIndex >= 0 && data["currently"].uvIndex < 3){
	  	$("#uv").css("background-color","rgba(64,191,64,.6)");	
		}else if(data["currently"].uvIndex > 2.9 && data["currently"].uvIndex < 6){ 
			 $("#uv").css("background-color","yellow");
		 }else if(data["currently"].uvIndex > 5.9 && data["currently"].uvIndex < 8){ 
			$("#uv").css("background-color","orange");
		 }else{
			$("#uv").css("background-color","red");
		 }
		 
		}
			if($("#currentdropdownselect").attr("name") == "fahrenheite"){
	
			   $("#tempreturecurrent").html("<span name='fahrenheite' id='currenttemp'>" +Math.round(data["currently"].apparentTemperature) +"</span><span id='currenttempsign' >&#x2109;</span>");
			
			}else{

			   $("#tempreturecurrent").html("<span name='centergrade' id='currenttemp'>" +Math.round(convertCentergrade(data["currently"].apparentTemperature)) +"</span><span id='currenttempsign' >&deg;</span>");
			}
			 
        $("#precip").html("&nbsp"+Math.round(data["hourly"].data[currentTime].precipIntensity)+"%");

		$("#dewpoint").html("&nbsp"+Math.round(data["currently"].dewPoint));
		
		$("#windSpeed").attr("speed", Math.round(data["currently"].windSpeed));

		$("#visibility").attr("miles", Math.round(Math.round(data["currently"].visibility)));

		if($("#windSpeed").attr("name") == "m/s"){
		
				var myString = data["hourly"].data[currentTime].visibility;
				myString *= 1.609344;
				$("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
		
				var myString = data["hourly"].data[currentTime].windSpeed;
				myString *= 0.44704;
				myString = Math.round(myString);
				$("#windSpeed").html("&nbsp"+myString+" m/s&nbsp");
				$("#windSpeed").attr("speed", Math.round(data["hourly"].data[currentTime].windSpeed));
				$("#windSpeed").attr("name", "m/s");
				
			    var myString = currentWeatherData["hourly"].data[currentTime].visibility;//Remove temperature sign
	            myString *= 1.609344;
	            $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
			
				
			}else if($("#windSpeed").attr("name") == "km/h"){
				
				//console.log($("#windSpeed").attr("name"));
				
				var myString = data["hourly"].data[currentTime].windSpeed;
				myString *= 1.609344;
				myString = Math.round(myString);
				$("#windSpeed").html("&nbsp"+myString+" km/h&nbsp");
				$("#windSpeed").attr("speed", Math.round(data["hourly"].data[currentTime].windSpeed));
				$("#windSpeed").attr("name", "km/h");
				
				var myString = data["hourly"].data[currentTime].visibility;
	            myString *= 1.609344;
	            $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");

				
			}else{
				
				var myString = data["hourly"].data[currentTime].visibility;//Remove temperature sign
	            $("#visibility").html("&nbsp"+Math.round(myString)+" mi&nbsp");
				
				var myString = data["hourly"].data[currentTime].windSpeed;
				myString = Math.round(myString);
				$("#windSpeed").html("&nbsp"+myString+" mph&nbsp");
				$("#windSpeed").attr("speed", Math.round(data["hourly"].data[currentTime].windSpeed));
				$("#windSpeed").attr("name", "mph");		
			}
		
		
		$("#pressure").html("&nbsp"+Math.round(data["hourly"].data[currentTime].pressure));
		
		$("#humidity").html("&nbsp"+Math.round(data["hourly"].data[currentTime].humidity*100)+"%");

		var nextH1 = "";
        var currentWeathers = [];

	    for(var i = 0; i <= 22;  i = i + 2){//Get the weather type for the next 22h
		 
		  currentWeathers.push(data["hourly"].data[i].summary);
		 
	     }

      //console.log(currentWeathers);
		
	 var numberOfWeatherArray = [];//Used to hold the number of times the cuurent weather will happen in the next 22 hours
	 var i = 1;
	 var numberOfWeatherArrayLastItem = [];//Used to caculate the number of times the last weather in current weather array happens

	 var uniqueArray = currentWeathers.filter(function(item, pos, self) {//Remove duplicate when same weather type happens twice in a row
		if(pos == 0){
		   return item;
		}
		if(pos > 0){	
		  if(self[pos-1]!= item){
				
			numberOfWeatherArray.push(i);
			i = 1;
			numberOfWeatherArrayLastItem.push(pos);
			
			return item;
		  }
		}
		i++;
	});
    //console.log(uniqueArray);

	if(uniqueArray.length  == 1){
		
		numberOfWeatherArray.push(12);
		
	}else{
		
    	numberOfWeatherArray.push(currentWeathers.length - numberOfWeatherArrayLastItem[numberOfWeatherArrayLastItem.length-1]);//Add the numer of times  the last weather type happened to the array 

	}
	//console.log(numberOfWeatherArray);
	//console.log(uniqueArray);
	
	    arrorBoxArray = [];//Hold the arrows, weather and tempreture of next 22h weather
	    var nums = 0;
		var numtest = 0;
	    arrorBoxArray.push("");

		for(var x = 0;  x < 24; x+= 2){//Used to add the arrows and tempreture of next 22h weather to the $("#weatherbar") div
		
			nextH1 = new Date((data["hourly"].data[numtest].time*1000)).toLocaleString('en-UK', { hour: 'numeric', hour12: true });
			var nextTemp = Math.round(data["hourly"].data[numtest].apparentTemperature);
			numtest = numtest +2;

			arrorBoxArray[0] += "<span style='display:inline-block; height: 5px; position: absolute; left:"+(x*47)+"px ;top:26px'>|<span style='display:inline-block; height: 5px; position: absolute; left:45px ;top:0px'>|</span></span>";	
			arrorBoxArray[0] += "<span style='display:inline-block; height: 5px; position: absolute; left:"+(x*47)+"px ;top:41px'><strong>"+nextH1+"</strong></span>";
			
			if($("#currentdropdownselect").attr("name") == "fahrenheite"){
	
			   arrorBoxArray[0] += "<span name='fahrenheite' temp='"+nextTemp+"' id='hourlyweatherchart"+nums+"' style='display:inline-block; opacity: 0.731232; height: 5px; position: absolute; left:"+(x*47)+"px ;top:61px'>"+nextTemp+"&#x2109;</span>";
			
			}else{

			   arrorBoxArray[0] += "<span name='centergrade' temp='"+nextTemp+"' id='hourlyweatherchart"+nums+"' style='display:inline-block; opacity: 0.731232; height: 5px; position: absolute; left:"+(x*47)+"px ;top:61px'>"+convertCentergrade(nextTemp)+"&deg;</span>";
			}
			
			nums += 1;			
		}

		var leftValue = 0;
		var backGroundColor = "";
		
		for(var i = 0; i < uniqueArray.length; i++ ){//Create bar of weather type per hour for the next 22 hours
      
	  
	  	 var valueToShow = uniqueArray[i];

			if(uniqueArray[i].indexOf('Cloudy') == -1){
				
					backGroundColor = "#878F9A";
					valueToShow = "Cloudy";
					
			}else if(uniqueArray[i].indexOf('Mostly Cloudy') == -1){
				
				backGroundColor = "#B6BFCB";
				valueToShow = " Mostly Cloudy";
				
			}else if (uniqueArray[i].indexOf('Overcast') == -1){
					
					backGroundColor = "#9da7b5";
					valueToShow = "Overcast";
					
			}else if (uniqueArray[i].indexOf('Partly Cloudy') == -1){
					
					backGroundColor = "#D5DAE2";
					valueToShow = "Partly Cloudy";
					
			}else if (uniqueArray[i].indexOf('Clear') == -1){
				
					backGroundColor = "#EEEEF5";
					valueToShow = "Clear";
					
			}else if(uniqueArray[i].indexOf('Rain') == -1){
				
					backGroundColor = "#4A80C7";
					valueToShow = "Rain";
					
			}	else if (uniqueArray[i].indexOf('Light Rain') == -1){
				
					backGroundColor = "#80A5D6";
					valueToShow = "Light Rain";
			} 
			
		    arrorBoxArray.push( "<span  style='height: 30px;background-color:"+backGroundColor+"; text-align: left; width:"+(numberOfWeatherArray[i]*92)+"px; display:inline-block;  border:1px solid gray; position: absolute; left:"+leftValue+"px; ;top:0px'>"+valueToShow+"</span>");
            leftValue += numberOfWeatherArray[i]*92;
	     }
		 
		 $("#weatherbar").html("<span id='weatherbox' style='width:100%'>"+arrorBoxArray+"</span>");
	         

	
		skycons.play();
	  
	  }

	});
  }
  
  
///////////////////////////////////////////////////////////////////

$(document).on("click", ".dropdown-menu a", function(e) {
	
	e.preventDefault();
	//console.log(currentWeatherData);
	
	$("#currentdropdownselect").text(this.id); 

     //Convert to m/s
	 if(this.id == "˚C, m/s" && $("#windSpeed").attr("name") != "m/s"){
        

		$("#currentdropdownselect").attr("name") == "centergrade";	
			
		var myString = $("#visibility").attr("miles");//Remove temperature sign
	    myString *= 1.609344;
	    $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
		
	    var myString = $("#windSpeed").attr("speed");//Remove temperature sign
		myString *= 0.44704;
	    myString = Math.round(myString);
	    $("#windSpeed").text(myString +" m/s");
	    $("#windSpeed").attr("name","m/s");
        $("#windSpeed").html("&nbsp"+myString+" m/s&nbsp");		
		$("#currentdropdownselect").attr("name", "centergrade");	
		
		 drawWindLineChart(currentWeatherData,"m/s");

	 }
	
	 //Convert to km/h
	 if(this.id == "˚C, km/h" && $("#windSpeed").attr("name") != "km/h"){
	    
	    var myString = $("#visibility").attr("miles");//Remove temperature sign
	    myString *= 1.609344;
	    $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
	  
	    var myString = $("#windSpeed").attr("speed");//Remove temperature sign
		myString *= 1.609344;
	    myString = Math.round(myString);
	    $("#windSpeed").html("&nbsp"+myString+" km/h&nbsp");
	    $("#windSpeed").attr("name","km/h");
		$("#currentdropdownselect").attr("name", "centergrade");
		
		drawWindLineChart(currentWeatherData,"km/h");

	 }

	 //Convert to mph
	 if(this.id == "˚C, mph"){

      $("#currentdropdownselect").attr("name", "centergrade");	
	  $("#visibility").html("&nbsp"+$("#visibility").attr("miles")+" mi&nbsp");
	  $("#windSpeed").html("&nbsp"+$("#windSpeed").attr("speed")+" mph&nbsp")
	  $("#windSpeed").attr("name","mph");
	  
	   drawWindLineChart(currentWeatherData,"mph");
	  
	 }

	//Convert to fahrenheite
	if(this.id == "˚F, mph" && $("#currenttemp").attr("name") != "fahrenheite" ){
		

		$("#currentdropdownselect").attr("name", "fahrenheite");	
        $("#windSpeed").html("&nbsp"+$("#windSpeed").attr("speed")+" mph&nbsp");	
	    $("#windSpeed").attr("name", "mph");		
		$("#visibility").html("&nbsp"+$("#visibility").attr("miles")+" mi&nbsp");		
		$("#currenttemp").attr("name", "fahrenheite");
		$("#currenttemp").text(convertToFahrenheite($("#currenttemp").text()));
		$("#currenttempsign").html("&#x2109;");	
		$("#currenttempmin").attr("name", "fahrenheite");
		$("#currenttempmin").text(convertToFahrenheite($("#currenttempmin").text()));
		$("#currenttempminsign").html("&#x2109;");
		$("#currenttempmax").attr("name", "fahrenheite");
		$("#currenttempmax").text(convertToFahrenheite($("#currenttempmax").text()));
        $("#currenttemp10").attr("name", "fahrenheite");
		$("#currenttemp10").html(convertToFahrenheite($("#currenttemp10").text()));
		$("#currenttempsign10").html("&#x2109;");
	    $("#currenttemp12").attr("name", "fahrenheite");
		$("#currenttemp12").html(convertToFahrenheite($("#currenttemp12").text()));
		$("#currenttempsign12").html("&#x2109;");

		for(var i = 0; i <= 11; i++) {
			
            var myString = $("#hourlyweatherchart"+i+"").text().replace(/\D/g,'');//Remove temperature sign
			myString = convertToFahrenheite(myString);
			$("#hourlyweatherchart"+i+"").html(myString+"&#x2109;");
			
		}		
		
		drawTempLineChart(currentWeatherData,"fahrenheit");
		
	}
   //Convert to centergrade
   if(this.id == "˚C, mph"  && $("#currenttemp").attr("name") != "centergrade" || this.id == "˚C, m/s"  && $("#currenttemp").attr("name") != "centergrade" || this.id == "˚C, km/h" && $("#currenttemp").attr("name") != "centergrade"  ){

		$("#currenttemp").attr("name", "centergrade");
		$("#currenttemp").html(convertCentergrade($("#currenttemp").text()));
		$("#currenttempsign").html("&deg;");
		$("#currenttempmax").attr("name", "centergrade");
		$("#currenttempmax").html(convertCentergrade($("#currenttempmax").text()));
		$("#currenttempmaxsign").html("&deg;");	
		$("#currenttempmin").attr("name", "centergrade");
		$("#currenttempmin").html(convertCentergrade($("#currenttempmin").text()));
		$("#currenttempminsign").html("&deg;");
		$("#currenttemp10").attr("name", "centergrade");
		$("#currenttemp10").html(convertCentergrade($("#currenttemp10").text()));
		$("#currenttempsign10").html("&deg;");
	    $("#currenttemp12").attr("name", "centergrade");
		$("#currenttemp12").html(convertCentergrade($("#currenttemp12").text()));
		$("#currenttempsign12").html("&deg;");
		
		for(var i = 0; i <= 11; i++) {
			
            var myString = $("#hourlyweatherchart"+i+"").text().replace(/\D/g,'');//Remove temperature sign
			myString = convertCentergrade(myString);
			$("#hourlyweatherchart"+i+"").html(myString+"&deg;");
		}
		          
        drawTempLineChart(currentWeatherData,"centergrade");

	}	
});
 

/////////////////////////////////////////////////////////////////////// 

//Load date picker
 $( function() {
    $( "#datepicker" ).datepicker();
  } );
//Get date from date picker and show weather for that date
$("#datepicker").datepicker({
    onSelect: function() { 
	
	  var lat = $("#datepicker").attr("lat");
	  var lng = $("#datepicker").attr("lng");
	  var dateObject = $(this).datepicker('getDate'); 
	  var today = new Date();
	  var date_to_reply = new Date(dateObject);
	  var timeinmilisec = date_to_reply.getTime() - today.getTime();
	  var daysBetweenDates =  Math.ceil(timeinmilisec / (1000 * 60 * 60 * 24));

	  showLocalWeather2(lat,lng, daysBetweenDates);
      map.setView(new L.LatLng(lat,lng));
		
    }
});

//////////////////////////////////////////////////////////////////////////  

function convertCentergrade(data){
	
	var centergrade  = (data - 32) * 5 / 9;
    centergrade = Math.round(centergrade * 100) / 100;
	return Math.round(centergrade);
}

function convertToFahrenheite(data){

	var newTemp = data * 9 / 5 + 32;
    newTemp = Math.round(newTemp * 100) / 100;
	return Math.round(newTemp);
}

//////////////////////////////////////////////////////////////////////////    
  
  
function refreshPage(){
   // window.location.reload();
}   


	

$(function() {//Change the hour of the weather being show - from 12 am to 11 pm
    $( "#slider-range-max" ).slider({
      range: "max",
      min: 0,
      max: 23,
      value: 0,
	  step: 1,
      slide: function( event, ui ) {
		  
	 currentTime = ui.value;
	
      switch(ui.value){
	
		case 0:
		$("#amount" ).val(12+" Am");
		break;
		case 1:
		$("#amount" ).val(1+" Am");
		break;
		case 2:
		$("#amount" ).val(2+" Am");
		break;
		case 3:
		$("#amount" ).val(3+" Am");
		break;
		case 4:
		$("#amount" ).val(4+" Am");
		break;
		case 5:
		$("#amount" ).val(5+" Am");
		break;
		case 6:
		$("#amount" ).val(6+" Am");
		break;
		case 7:
		$("#amount" ).val(7+" Am");
		break;
		case 8:
		$("#amount" ).val(8+" Am");
		break;
		case 9:
		$("#amount" ).val(9+" Am");
		break;
		case 10:
		$("#amount" ).val(10+" Am");
		break;
		case 11:
		$("#amount" ).val(11+" Am");
		break;
		case 12:
		$("#amount" ).val(12+" Pm");
		break;
		case 13:
		$("#amount" ).val(1+" Pm");
		break;
		case 14:
		$("#amount" ).val(2+" Pm");
		break;
		case 15:
		$("#amount" ).val(3+" Pm");
		break;
		case 16:
		$("#amount" ).val(4+" Pm");
		break;
		case 17:
		$("#amount" ).val(5+" Pm");
		break;
		case 18:
		$("#amount" ).val(6+" Pm");
		break;
		case 19:
		$("#amount" ).val(7+" Pm");
		break;
		case 20:
		$("#amount" ).val(8+" Pm");
		break;
		case 21:
		$("#amount" ).val(9+" Pm");
		break;
		case 22:
		$("#amount" ).val(10+" Pm");
		break;
		case 23:
		$("#amount" ).val(11+" Pm");
		break;
	 }
		  
	
			if($("#currenttemp").attr("name") == "fahrenheite"){
					
			   $("#currenttemp").text(Math.round(currentWeatherData["hourly"].data[ui.value].apparentTemperature));
			
			}else{
			
			   $("#currenttemp").text(convertCentergrade(currentWeatherData["hourly"].data[ui.value].apparentTemperature));
			}
			
			if($("#windSpeed").attr("name") == "m/s"){
		
				var myString = currentWeatherData["hourly"].data[ui.value].visibility;
				myString *= 1.609344;
				$("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
		
				var myString = currentWeatherData["hourly"].data[ui.value].windSpeed;
				myString *= 0.44704;
				myString = Math.round(myString);
				$("#windSpeed").html("&nbsp"+myString+" m/s&nbsp");
				$("#windSpeed").attr("speed", Math.round(currentWeatherData["hourly"].data[ui.value].windSpeed));
				$("#windSpeed").attr("name", "m/s");
				
			    var myString = currentWeatherData["hourly"].data[ui.value].visibility;//Remove temperature sign
	            myString *= 1.609344;
	            $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
			
				
			}else if($("#windSpeed").attr("name") == "km/h"){
				
				//console.log($("#windSpeed").attr("name"));
				
				var myString = currentWeatherData["hourly"].data[ui.value].windSpeed;
				myString *= 1.609344;
				myString = Math.round(myString);
				$("#windSpeed").html("&nbsp"+myString+" km/h&nbsp");
				$("#windSpeed").attr("speed", Math.round(currentWeatherData["hourly"].data[ui.value].windSpeed));
				$("#windSpeed").attr("name", "km/h");
				
				var myString = currentWeatherData["hourly"].data[ui.value].visibility;//Remove temperature sign
	            myString *= 1.609344;
	            $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");

				
			}else{
				
				var myString = currentWeatherData["hourly"].data[ui.value].visibility;//Remove temperature sign
	            $("#visibility").html("&nbsp"+Math.round(myString)+" mi&nbsp");
				
				var myString = currentWeatherData["hourly"].data[ui.value].windSpeed;
				myString = Math.round(myString);
				$("#windSpeed").html("&nbsp"+myString+" mph&nbsp");
				$("#windSpeed").attr("speed", Math.round(currentWeatherData["hourly"].data[ui.value].windSpeed));
				$("#windSpeed").attr("name", "mph");		
			}

			$("#precip").html("&nbsp"+Math.round(currentWeatherData["hourly"].data[ui.value].precipIntensity)+"%");
			$("#dewpoint").html("&nbsp"+Math.round(currentWeatherData["hourly"].data[ui.value].dewPoint));
			$("#pressure").html("&nbsp"+Math.round(currentWeatherData["hourly"].data[ui.value].pressure));
			$("#humidity").html("&nbsp"+Math.round(currentWeatherData["hourly"].data[ui.value].humidity*100)+"%");

			if(typeof currentWeatherData["hourly"].data[ui.value].uvIndex != "undefined"){
			
				var uvCurrent = currentWeatherData["hourly"].data[ui.value].uvIndex;
			}else{			
				uvCurrent =  0;		
			}
			$("#uv").html("&nbsp"+uvCurrent);
			
			if(uvCurrent >= 0 && uvCurrent < 3){
				$("#uv").css("background-color","rgba(64,191,64,.6)");	
			}else if(uvCurrent > 2.9 && uvCurrent < 6){ 
				 $("#uv").css("background-color","yellow");
			}else if(uvCurrent > 5.9 && uvCurrent < 8){ 
				$("#uv").css("background-color","orange");
			}else{
				$("#uv").css("background-color","red");
			}
			
		//console.log(currentWeatherData);

      }
    });
    //$( "#amount" ).val( $( "#slider-range-max" ).slider( "value" ) );
	$( "#amount" ).val( "12 Am" );
  } );
  
  


  

  
</script>
 
</body>
</html>
    