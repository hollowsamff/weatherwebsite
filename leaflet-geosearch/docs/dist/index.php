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
<Button lat="" lng="" id='locatebutton' class="fab FolderTitle Closed" aria-hidden="true" onClick="refreshPage()">
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

   
   
   
   
   
   
   
   <div class="scrollmenu" style="background-color:#F7F7F7; padding:10px">

    <span id="windtitle" class="thick">Wind: </span><span name="˚C, m/s" speed="" style="opacity:0.731232;" id="windSpeed"></span>
	<span id="" style="padding-right:5px; opacity: 0.731232;"></span>
    <span class="thick">Humidity: </span><span style="opacity:0.731232;" id="humidity"></span> 
	<span id="" style="padding-right:5px; opacity: 0.731232;"></span>
    <span class="thick" >Dew Pt: </span><span  style="opacity:0.731232;" id="dewpoint"></span>
	<span id="" style="padding-right:5px; opacity: 0.731232;">˚</span>
    <span class="thick" >UV Index: </span><span style="background-color:#94D587; opacity:0.731232; "  id="uv"></span>
	<span id="" style="padding-right:5px; opacity: 0.731232;"></span>
 	<span class="thick">Visibility: </span><span name="miles" miles="" style="opacity:0.731232;" id="visibility"></span>
	<span id="" style="padding-right:5px; opacity: 0.731232;"></span>
    <span class="thick" >Pressure: </span><span  style="opacity:0.731232;" id="pressure"></span> <span id="pressuresign" style="padding-right:15px; opacity: 0.731232;">hPa</span>
	
   </div>

    <div id="tempreture" class="col-sm-12" style="background-color:#FCFCFC"></div>
	  

	
	
	   <div class="scrollmenu col-sm-offset-1 col-sm-11" id="weatherbar" style="background-color:white;padding:5px; height: 100px;">
	   </div>
	  
	   
	   
	       <div class="clearfix visible-sm"></div>
	   
	   
	
	
  <div class=" col-sm-offset-1 col-sm-11" style="background-color:white;padding-bottom:100px;margin-bottom:100px">
    <div class="tiles clearfix ">
		
		<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">                
			         <span class="thick" id="nextdayname1"></span><br><span id="nextdaydetails1"></span>                  
                </h4>
            </div>
            <div id="collapseone" class="panel-collapse collapse">
                  <div class="panel-body" id="dailyweather1">			    			    
                </div>
            </div>
        </div>
		
		 <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">                
			         <span class="thick" id="nextdayname2"></span><br><span id="nextdaydetails2"></span>                  
                </h4>
            </div>
            <div id="collapsetwo" class="panel-collapse collapse">
                  <div class="panel-body" id="dailyweather2">			    			    
                </div>
            </div>
        </div>
		
		
		
      <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">                
			         <span class="thick" id="nextdayname3"></span><br><span id="nextdaydetails3"></span>                  
                </h4>
            </div>
            <div id="collapsethree" class="panel-collapse collapse">
                  <div class="panel-body" id="dailyweather3">			    			    
                </div>
            </div>
        </div>
		
		
		<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">                
			         <span class="thick" id="nextdayname4"></span><br><span id="nextdaydetails4"></span>                  
                </h4>
            </div>
            <div id="collapsefour" class="panel-collapse collapse">
                  <div class="panel-body" id="dailyweather4">			    			    
                </div>
            </div>
        </div>
		
		<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
					  <span class="thick" id="nextdayname5"></span><br><span id="nextdaydetails5"></span>  
                </h4>
            </div>
            <div id="collapsefive" class="panel-collapse collapse">
                  <div class="panel-body" id="dailyweather5">
                </div>
            </div>
        </div>
		
		<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">    
					<span class="thick" id="nextdayname6"></span><br><span id="nextdaydetails6"></span> 			    
                </h4>
            </div>
            <div id="collapsesix" class="panel-collapse collapse">
                  <div class="panel-body" id="dailyweather6">
                </div>
            </div>
        </div>

    </div>
</div>


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
					    <a href ="termsandconditions.php">Terms and conditions</a>
					    <a href ="privacypolicy.php">Privacy policy</a></p>
					  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>		
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
  
<script>




$("document").ready(function() {




	var offsets = document.getElementById('pressuresign').getBoundingClientRect();
	var top = offsets.top;
	var lefts = offsets.left;

	var width = $(window).width(); 
	var height = $(window).height(); 

	if ($(window).width() > 700){
	 
	 $("#convertbutton").css({left: lefts+100, position:'absolute'});

	}

	var GeoSearchControl = window.GeoSearch.GeoSearchControl;
	var OpenStreetMapProvider = window.GeoSearch.OpenStreetMapProvider;

	var provider = new OpenStreetMapProvider();

	var map = new L.Map('map');
	map.setZoom(11);

	
	
	const searchControl = new GeoSearchControl({
            provider: provider,
            searchLabel: 'Enter location',
            position: 'topleft',
            style: 'bar',
            classNames: {
                container: 'leaflet-bar leaflet-control leaflet-control-geosearch',
                resetButton: 'reset',
                msgbox: 'leaflet-bar message',
                form: '',
                input: '',
            },
            autoComplete: true,
            autoCompleteDelay: 250,
            maxMarkers: 0,
            animateZoom: false,
            autoClose: true,
        }).addTo(map);
	
	

	document.addEventListener('touchmove', function(e) {
   // e.preventDefault();
    var touch = e.touches[0];
    //alert(touch.pageX + " - " + touch.pageY);
}, false);
	
	
	
	/*
	
	var searchControl = new GeoSearchControl({
		provider: provider,
		style: 'bar',
		showMarker: false,
		retainZoomLevel: false,
		autoClose: true,  
		position:"topright",
		animateZoom: false
								 
	});

*/

	var results = L.layerGroup().addTo(map)

	map.addControl(searchControl);

	map.on('geosearch/showlocation', function(data){
	
	
		$( "#collapseone" ).removeClass( "in" );
		$( "#collapsetwo" ).removeClass( "in" );
		$( "#collapsethree" ).removeClass( "in" );
		$( "#collapsefour" ).removeClass( "in" );
		$( "#collapsefive" ).removeClass( "in" );
		$( "#collapsesix" ).removeClass( "in" );
		
		//console.log(data["location"]);
		showLocalWeather(data["location"]["y"],data["location"]["x"]);			
		$(".glass").attr("placeholder", data["location"]["label"]);	
        $(document).attr("title", data["location"]["label"]);
	
	});

	
	
	
	
	
	  var onClickHandler = function() {
    //$('.leaflet-control-geosearch.bar').trigger('keypress');
  };

  $('.leaflet-control-geosearch.bar').bind('focus', focusTextField);
  $('.leaflet-control-geosearch.bar').bind('click', onClickHandler);
 $('.leaflet-control-geosearch.bar').bind('keypress', onKeypressHandler);

  $(".leaflet-control-geosearch.bar").click(function(){ $("input[name='term']").trigger('focus') });
   
  $(".leaflet-control-geosearch.bar").focus();
   
 
	 $( ".leaflet-control-geosearch.bar" ).focusin(function() {
	  //$( this ).text("ff");
	});

	
   $('.leaflet-control-geosearch.bar').val("fgg");
   $('input', $(".leaflet-control-geosearch.bar")).focus();
	
	
	
	
	
	
	
	
	
	
	
	

	function onLocationFound(e) {
		//console.log(e);
		showLocalWeather(e["latitude"],e["longitude"]);
		map.setView(new L.LatLng(e["latitude"],e["longitude"]));	
		$(".glass").attr("placeholder", "Your location");
		$(document).attr("title", "Your location");
		
	}


	function onLocationError(e) {
		
		//alert(e.message);
		 showLocalWeather(40.7127,-74.0059);
		 map.setView(new L.LatLng(40.7306,-73.9866));
		 $(".glass").attr("placeholder", "Default location - New York");
		 $(document).attr("title", "Default location - New York");
	}


	findLocation();
		
	function findLocation(){

	  map.on('locationfound', onLocationFound);
	  map.on('locationerror', onLocationError);
	  map.locate({setView: true, maxZoom: 10});	  
	}


  //////////////////////////////////////New function
  function showLocalWeather(lat, lng) {

    //The location is saved in the locationLat and locationLong div boxes when the page loads
    var latitude = lat;
    //alert(latitude)
    var longitude = lng;
    //alert(longitude);
	$("#locatebutton").attr("lat", latitude);
	$("#locatebutton").attr("lng", longitude);

    var url =
      "https://api.darksky.net/forecast/abf791e0b7cfcc44c018d320240d62fa/" +
      latitude +
      "," +
      longitude;
    $.ajax({
      url: url,
      dataType: "jsonp",
      success: function(data) {

        //console.log(data);
		
        ////////////////
        var weatherIcon = data["currently"].icon;
        var weather = data["currently"].summary;
        var day = data["hourly"].summary;
	   
        var name = "fahrenheite"; 
		
	    var maxTemp = Math.round(data["daily"].data[0].apparentTemperatureMax);
	    var minTemp = Math.round(data["daily"].data[0].apparentTemperatureMin);

		if($("#currentdropdownselect").attr("name") == "fahrenheite"){

			 $("#tempreture").html(
			  "<span><h1><span name='fahrenheite' temp='" +
				data["currently"].apparentTemperature +
				"' id='currenttemp'>" +
				Math.round(data["currently"].apparentTemperature) +
				"</span><span id='currenttempsign' >&#x2109;</span>&nbsp" +
				weather+
				"</h1><canvas id='icon' width='64' height='64' class='currentWeather' title='" +weatherIcon + "'></canvas><br></span>" +"<strong>Low:</strong><span id='currenttempmin' name='fahrenheite'>"+minTemp+"</span><span id='currenttempminsign' >&#x2109;</span>&nbsp;<strong>High:</strong><span id='currenttempmax' name='fahrenheite'>"+maxTemp+"</span><span id='currenttempmaxsign' >&#x2109;</span><br><h3>"+
				day + 
				"</h3>"
			);
			
	
		}else{
				
			    $("#tempreture").html(
			  "<span><h1><span name='centergrade' temp='" +
				data["currently"].apparentTemperature +
				"' id='currenttemp'>" +
				convertCentergrade(data["currently"].apparentTemperature) +
				"</span><span id='currenttempsign' >&#x2109;</span>&nbsp" +
				weather+
				"</h1><canvas id='icon' width='64' height='64' class='currentWeather' title='" +weatherIcon + "'></canvas><br></span>" +"<strong>Low:</strong><span id='currenttempmin' name='fahrenheite'>"+convertCentergrade(minTemp)+"</span><span id='currenttempminsign' >&#x2109;</span>&nbsp;<strong>High:</strong><span id='currenttempmax' name='fahrenheite'>"+convertCentergrade(maxTemp)+"</span><span id='currenttempmaxsign' >&#x2109;</span><br><h3>"+
				day + 
				"</h3>"
			);	
		}
		
		//Create icons for weather - uses https://github.com/darkskyapp/skyconsicns -  https://github.com/darkskyapp/skycons
		var skycons = new Skycons({"resizeClear": true});
        skycons.add(document.getElementById("icon"), data.currently.icon);

		
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
		
		$("#dewpoint").html("&nbsp"+Math.round(data["currently"].dewPoint));
		
		
		$("#windSpeed").attr("speed", Math.round(data["currently"].windSpeed));

		$("#visibility").attr("miles", Math.round(Math.round(data["currently"].visibility)));
		
		if($("#windSpeed").attr("name") == "m/s"){
		
				var myString = data["currently"].visibility;
				myString *= 1.609344;
				$("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
		
				var myString = data["currently"].windSpeed;
				myString *= 0.44704;
				myString = Math.round(myString);
				$("#windSpeed").html("&nbsp"+myString+" m/s&nbsp");
				$("#windSpeed").attr("speed", Math.round(data["currently"].windSpeed));
				$("#windSpeed").attr("name", "m/s");
				
			    var myString = data["currently"].visibility;//Remove temperature sign
	            myString *= 1.609344;
	            $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
			
				
			}else if($("#windSpeed").attr("name") == "km/h"){
				
				//console.log($("#windSpeed").attr("name"));
				
				var myString = data["currently"].windSpeed;
				myString *= 1.609344;
				myString = Math.round(myString);
				$("#windSpeed").html("&nbsp"+myString+" km/h&nbsp");
				$("#windSpeed").attr("speed", Math.round(data["currently"].windSpeed));
				$("#windSpeed").attr("name", "km/h");
				
				var myString = data["currently"].visibility;
	            myString *= 1.609344;
	            $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");

				
			}else{
				
				var myString = data["currently"].visibility;//Remove temperature sign
	            $("#visibility").html("&nbsp"+Math.round(myString)+" mi&nbsp");
				
				var myString = data["currently"].windSpeed;
				myString = Math.round(myString);
				$("#windSpeed").html("&nbsp"+myString+" mph&nbsp");
				$("#windSpeed").attr("speed", Math.round(data["currently"].windSpeed));
				$("#windSpeed").attr("name", "mph");		
			}
		
		$("#pressure").html("&nbsp"+Math.round(data["currently"].pressure));
		$("#humidity").html("&nbsp"+Math.round(data["currently"].humidity*100)+"%");

		var nextH1 = "";
        var currentWeathers = [];

	    for(var i = 0; i <= 22;  i = i + 2){//Get the weather type for the next 22h
		 
		  currentWeathers.push(data["hourly"].data[i].summary);
		 
	     }

     //console.log(currentWeathers);

	  $("#weatherbar").html("");
				
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

	    arrorBoxArray = [];//Hold the arrows, weather and tempreture of next 22h weather
	    var nums = 0;
		var numtest = 0;
	    arrorBoxArray.push("");

		for(var x = 0;  x < 24; x+= 2){//Used to add the arrows and tempreture of next 22h weather to the $("#weatherbar") div
		
			nextH1 = new Date((data["hourly"].data[numtest].time*1000)).toLocaleString('en-UK', { hour: 'numeric', hour12: true });
			var nextTemp = Math.round(data["hourly"].data[numtest].apparentTemperature);
			numtest = numtest +2;

			arrorBoxArray[0] += "<span style='display:inline-block; height: 5px; position: absolute; left:"+(x*45)+"px ;top:26px'>|<span style='display:inline-block; height: 5px; position: absolute; left:45px ;top:0px'>|</span></span>";	
			arrorBoxArray[0] += "<span style='display:inline-block; height: 5px; position: absolute; left:"+(x*45)+"px ;top:41px'><strong>"+nextH1+"</strong></span>";
			
		    if($("#currentdropdownselect").attr("name") == "fahrenheite"){
			
				arrorBoxArray[0] += "<span name='fahrenheite' temp='"+nextTemp+"' id='hourlyweatherchart"+nums+"' style='display:inline-block; opacity: 0.731232; height: 5px; position: absolute; left:"+(x*45)+"px ;top:61px'>"+nextTemp+"&#x2109;</span>";
			
			}else{
				arrorBoxArray[0] += "<span name='centergrade' temp='"+nextTemp+"' id='hourlyweatherchart"+nums+"' style='display:inline-block; opacity: 0.731232; height: 5px; position: absolute; left:"+(x*45)+"px ;top:61px'>"+convertCentergrade(nextTemp)+"&deg;</span>";
				
			}	

			nums += 1;			
		}

		var leftValue = 0;
		var backGroundColor = "";
		var sizeBox = 91;
		
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
		    arrorBoxArray.push( "<span  style='overflow:hidden; height: 30px;background-color:"+backGroundColor+"; text-align: left; width:"+(numberOfWeatherArray[i]*sizeBox)+"px; display:inline-block;  border:1px solid gray; position: absolute; left:"+leftValue+"px; ;top:0px'>"+valueToShow+"</span>");
            leftValue += numberOfWeatherArray[i]*sizeBox;
	     }
		 
		 $("#weatherbar").html("<span>"+arrorBoxArray+"</span>");
	
		 //console.log(arrorBoxArray);
		 
       //Next weeks weather from one API request
		$("#nextdayname1").html(getDay(1));
        $("#nextdayname2").html(getDay(2));
		$("#nextdayname3").html(getDay(3));
	    $("#nextdayname4").html(getDay(4));
		$("#nextdayname5").html(getDay(5));
		$("#nextdayname6").html(getDay(6));
		
	$("#nextdaydetails1").html(
		"<canvas id='icon2' width='34' height='34' title=''></canvas><br></span>" +
		 "<strong>Low:</strong><span name='fahrenheite' id='dailytemponemin'>"+ Math.round(data["daily"].data[1].apparentTemperatureMin) +"</span><span id='dailytemponesignmin'>&#x2109;</span>&nbsp<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytemponemax'>"+ Math.round(data["daily"].data[1].apparentTemperatureMax) +"</span><span id='dailytemponesignmax'>&#x2109;</span>");
	     skycons.add(document.getElementById("icon2"), data["daily"].data[1].icon);
		 
        ////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 	 
	    $("#nextdaydetails1").append("<br><button name='1' class='btn btn-primary moredaydetails ' data-toggle='collapse' data-parent='' href='#collapseone'    >+</button>");
		
		$("#nextdaydetails2").html(
		"<canvas id='icon3' width='34' height='34' title=''></canvas><br></span>" +
		 "<strong>Low:</strong><span name='fahrenheite' id='dailytemptwomin'>"+ Math.round(data["daily"].data[2].apparentTemperatureMin) +"</span><span id='dailytemptwosignmin'>&#x2109;</span>&nbsp<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytemptwomax'>"+ Math.round(data["daily"].data[2].apparentTemperatureMax) +"</span><span id='dailytemptwosignmax'>&#x2109;</span>&nbsp<br>");
	      skycons.add(document.getElementById("icon3"), data["daily"].data[2].icon);
		  
        ////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 
		 $("#nextdaydetails2").append("<br><button name='2' class='btn btn-primary moredaydetails ' data-toggle='collapse' data-parent='' href='#collapsetwo'    >+</button>");
		
		$("#nextdaydetails3").html(
		"<canvas id='icon4' width='34' height='34' title=''></canvas><br></span>" +
		 "<strong>Low:</strong><span name='fahrenheite' id='dailytempthreemin'>"+ Math.round(data["daily"].data[3].apparentTemperatureMin) +"</span><span id='dailytempthreesignmin'>&#x2109;</span>&nbsp"+
		 "<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytempthreemax'>"+ Math.round(data["daily"].data[3].apparentTemperatureMax) +"</span><span id='dailytempthreesignmax'>&#x2109;</span><br>");
	     skycons.add(document.getElementById("icon4"), data["daily"].data[3].icon);
		 
         ////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 		 
		
		  $("#nextdaydetails3").append("<br><button name='3' class='btn btn-primary moredaydetails ' data-toggle='collapse' data-parent='' href='#collapsethree'    >+</button>");
		
		$("#nextdaydetails4").html(
		"<canvas id='icon5' width='34' height='34' title=''></canvas><br></span>" +
		 "<strong>Low:</strong><span name='fahrenheite' id='dailytempfourmin'>"+ Math.round(data["daily"].data[4].apparentTemperatureMin) +"</span><span id='dailytempfoursignmin'>&#x2109;</span>&nbsp<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytempfourmax'>"+ Math.round(data["daily"].data[4].apparentTemperatureMax) +"</span><span id='dailytempfoursignmax'>&#x2109;</span><br>");
         skycons.add(document.getElementById("icon5"), data["daily"].data[4].icon);
       
		 ////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 			 
		
	    $("#nextdaydetails4").append("<br><button name='4' class='btn btn-primary moredaydetails ' data-toggle='collapse' data-parent='' href='#collapsefour'    >+</button>");
		
		$("#nextdaydetails5").html(
		"<canvas id='icon6' width='34' height='34' title=''></canvas><br></span>" +
		 "<strong>Low:</strong><span name='fahrenheite' id='dailytempfivemin'>"+ Math.round(data["daily"].data[5].apparentTemperatureMin) +"</span><span id='dailytempfivesignmin'>&#x2109;</span>&nbsp<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytempfivemax'>"+ Math.round(data["daily"].data[5].apparentTemperatureMax) +"</span><span id='dailytempfivesignmax'>&#x2109;</span><br>");
		skycons.add(document.getElementById("icon6"), data["daily"].data[5].icon);
        ////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 		 
		$("#nextdaydetails5").append("<br><button name='5' class='btn btn-primary moredaydetails ' data-toggle='collapse' data-parent='' href='#collapsefive'    >+</button>");
		
		$("#nextdaydetails6").html(
		"<canvas id='icon7' width='34' height='34' title=''></canvas><br></span>" +
		 "<strong>Low:</strong><span name='fahrenheite' id='dailytempsixmin'>"+ Math.round(data["daily"].data[6].apparentTemperatureMin )+"</span><span id='dailytempsixsignmin'>&#x2109;</span>&nbsp<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytempsixmax'>"+ Math.round(data["daily"].data[6].apparentTemperatureMax) +"</span><span id='dailytempsixsignmax'>&#x2109;</span><br>");
		skycons.add(document.getElementById("icon7"), data["daily"].data[6].icon);
		
		////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 		 
		$("#nextdaydetails6").append("<br><button name='6' class='btn btn-primary moredaydetails ' data-toggle='collapse' data-parent='' href='#collapsesix'    >+</button>");
	
		skycons.play();
		
      },//End success
       error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Weather for this city is not currently available");; 
	  }, 
      cache: false
    }); //End ajax
  } //End function
}); //End doc.ready 

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


function refreshPage(){
    window.location.reload();
} 

$(document).on("click", ".dropdown-menu a", function(e) {
	
	e.preventDefault();
	
	$("#currentdropdownselect").text(this.id); 

     //Convert to m/s
	 if(this.id == "˚C, m/s" && $("#windSpeed").attr("name") != "m/s"){
        
		var myString = $("#visibility").attr("miles");//convert miles to km
	    myString *= 1.609344;
	    $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
		
	    var myString = $("#windSpeed").attr("speed");
		myString *= 0.44704;
	    myString = Math.round(myString);
	    $("#windSpeed").text(myString +" m/s");
	    $("#windSpeed").attr("name","m/s");
        $("#windSpeed").html("&nbsp"+myString+" m/s&nbsp");
	 }
	
	if(this.id == "˚C, m/s"){
	
	$("#currentdropdownselect").attr("name", "centergrade");
	
	 for(var x = 1 ; x <= 6; x++){
		  if (typeof $("#windSpeed2dailyweather"+x+"").attr("speed") !== "undefined" ) {
					
		         var myString = $("#windSpeed2dailyweather"+x+"").attr("speed");
				 myString *= 0.44704;
			     $("#windSpeed2dailyweather"+x+"").html("&nbsp"+Math.round(myString)+" m/s&nbsp");
				 myString = $("#visibility2dailyweather"+x+"").attr("miles");
	             myString *= 1.609344;
	            $("#visibility2dailyweather"+x+"").html("&nbsp"+Math.round(myString)+" km&nbsp");
		  }
	  }
			
	}
	
	 //Convert to km/h
	 if(this.id == "˚C, km/h" && $("#windSpeed").attr("name") != "km/h"){

	 
	    var myString = $("#visibility").attr("miles");
	    myString *= 1.609344;
	    $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
	  
	    var myString = $("#windSpeed").attr("speed");
		myString *= 1.609344;
	    myString = Math.round(myString);
	    $("#windSpeed").html("&nbsp"+myString+" km/h&nbsp");
	    $("#windSpeed").attr("name","km/h");
	 }
	 
	 
	if(this.id == "˚C, km/h"){
		
		$("#currentdropdownselect").attr("name", "centergrade");	
	
	 for(var x = 1 ; x <= 6; x++){
		  if (typeof $("#windSpeed2dailyweather"+x+"").attr("speed") !== "undefined" ) {
					
		         var myString = $("#windSpeed2dailyweather"+x+"").attr("speed");
				 myString *= 1.609344;
			     $("#windSpeed2dailyweather"+x+"").html("&nbsp"+Math.round(myString)+" km/h&nbsp");
				 myString = $("#visibility2dailyweather"+x+"").attr("miles");
	             myString *= 1.609344;
	            $("#visibility2dailyweather"+x+"").html("&nbsp"+Math.round(myString)+" km&nbsp");
		  }
	  }
			
	}
	 //Convert to mph

	 

	 		
 if(this.id == "˚C, mph"  ){
	 
		$("#currentdropdownselect").attr("name", "centergrade");	
	 	
	  $("#visibility").html("&nbsp"+$("#visibility").attr("miles")+" mi&nbsp");
	  $("#windSpeed").html("&nbsp"+$("#windSpeed").attr("speed")+" mph&nbsp")
	  $("#windSpeed").attr("name","mph");
	 
	 
	      //Daily weather charts
	     for(var x = 1 ; x <= 6; x++){
			  if (typeof $("#windSpeed2dailyweather"+x+"").attr("speed") !== "undefined" ) {
						
					 var myString = $("#windSpeed2dailyweather"+x+"").attr("speed");
					 $("#windSpeed2dailyweather"+x+"").html("&nbsp"+Math.round(myString)+"mph&nbsp");
			  }
		  }

	    //Daily weather charts
		for(var i = 0; i <= 11; i++) {
					
			for(var x = 0 ; x <= 6; x++){
				
				 if (typeof $("#hourlyweatherchart2dailyweather"+x+i+"").attr("temp") !== "undefined" && $("#hourlyweatherchart2dailyweather"+x+i+"").attr("name") !== "centergrade") {//Show message when city not found
					
					  var myString = convertCentergrade($("#hourlyweatherchart2dailyweather"+x+i+"").attr("temp"));
					  $("#hourlyweatherchart2dailyweather"+x+i+"").html(myString+"&deg;");
					  $("#hourlyweatherchart2dailyweather"+x+i+"").attr("name", "centergrade");
				 }
				
			}
		}  
		
		 for(var x = 1 ; x <= 6; x++){
		  if (typeof $("#currenttemp2dailyweatherdailyweather"+x+"").attr("temp") !== "undefined" && $("#currenttemp2dailyweatherdailyweather"+x+"").attr("name") !== "centergrade" ) {
					
			  var myString = $("#currenttemp2dailyweatherdailyweather"+x+"").attr("temp");
			   myString = convertCentergrade(myString);
			  $("#currenttemp2dailyweatherdailyweather"+x+"").html(myString+"&deg;");
			  $("#currenttemp2dailyweatherdailyweather"+x+"").attr("name", "centergrade");
		  }
	     }
	 

		
		
		 for(var x = 0 ; x <= 6; x++){
			 
			 for (var i = 0; i < 2; i++){
				 
				  if (typeof $("#currenttemp"+i+"dailyweather"+x+"").attr("temp") !== "undefined" && $("#currenttemp"+i+"dailyweather"+x+"").attr("name") !== "centergrade" ) {//Show message 
						
						
						 var myString =  $("#currenttemp"+i+"dailyweather"+x+"").attr("temp");
						 myString = convertCentergrade(myString);
				
						  $("#currenttemp"+i+"dailyweather"+x+"").html(myString+"&deg;");
						  $("#currenttemp"+i+"dailyweather"+x+"").attr("name", "centergrade");
		
				 }	
			 
			 }			
		}	
	   
}		
	
if(this.id == "˚F, mph"){	 
	 
	$("#currentdropdownselect").attr("name", "fahrenheite");	 
	
	 for(var x = 1 ; x <= 6; x++){
		  if (typeof $("#currenttemp2dailyweatherdailyweather"+x+"").attr("temp") !== "undefined" && $("#currenttemp2dailyweatherdailyweather"+x+"").attr("name") !== "fahrenheite" ) {
					
		              var myString = $("#currenttemp2dailyweatherdailyweather"+x+"").attr("temp");
					  $("#currenttemp2dailyweatherdailyweather"+x+"").html(myString+"&#x2109;");
					  $("#currenttemp2dailyweatherdailyweather"+x+"").attr("name", "fahrenheite");
		  }
	 }
	 
	 
	 
	 for(var i = 0; i <= 11; i++) {
					
            for(var x = 0 ; x <= 6; x++){
			 
			 
			     if (typeof $("#hourlyweatherchart2dailyweather"+x+i+"").attr("temp") !== "undefined" && $("#hourlyweatherchart2dailyweather"+x+i+"").attr("name") !== "fahrenheite" ) {
					
					  var myString = $("#hourlyweatherchart2dailyweather"+x+i+"").attr("temp");
					  $("#hourlyweatherchart2dailyweather"+x+i+"").html(myString+"&#x2109;");
					  $("#hourlyweatherchart2dailyweather"+x+i+"").attr("name", "fahrenheite");
					  
					  myString = $("#hourlyweatherchart2dailyweather"+x+i+"").attr("temp");
					  $("#hourlyweatherchart2dailyweather"+x+i+"").html(myString+"&#x2109;");
					  $("#hourlyweatherchart2dailyweather"+x+i+"").attr("name", "fahrenheite");
					 
			  
				 }
				
			}
		}
		
	   for(var x = 0 ; x <= 6; x++){
			 
				 for (var i = 0; i < 2; i++){
				 
				  if (typeof $("#currenttemp"+i+"dailyweather"+x+"").attr("temp") !== "undefined" && $("#currenttemp"+i+"dailyweather"+x+"").attr("name") !== "fahrenheite" ) {
						
						 var myString =  $("#currenttemp"+i+"dailyweather"+x+"").attr("temp");
						 myString = convertCentergrade(myString);
						 //alert(myString);
						  $("#currenttemp"+i+"dailyweather"+x+"").html(myString+"&#x2109;");
						  $("#currenttemp"+i+"dailyweather"+x+"").attr("name", "fahrenheite");
				 }	
			 
			 }			
		}	
		
}		
		

	 
	//Convert to fahrenheite
	if(this.id == "˚F, mph" && $("#currenttemp").attr("name") != "fahrenheite" ){
		
		$("#visibility").html("&nbsp"+$("#visibility").attr("miles")+" mi&nbsp");
		
		$("#currenttemp").attr("name", "fahrenheite");
		$("#currenttemp").text(convertToFahrenheite($("#currenttemp").text()));
		$("#currenttempsign").html("&#x2109;");
		
		$("#currenttempmin").attr("name", "fahrenheite");
		$("#currenttempmin").text(convertToFahrenheite($("#currenttempmin").text()));
		$("#currenttempminsign").html("&#x2109;");
		
		$("#currenttempmax").attr("name", "fahrenheite");
		$("#currenttempmax").text(convertToFahrenheite($("#currenttempmax").text()));
		
		$("#currenttempmaxsign").html("&#x2109;");
		$("#dailytemponemax").attr("name", "centergrade");
		$("#dailytemponemax").html(convertToFahrenheite($("#dailytemponemax").text()));
	    $("#dailytemponesignmax").html("&#x2109;");
		$("#dailytemponemin").attr("name", "centergrade");
		$("#dailytemponemin").html(convertToFahrenheite($("#dailytemponemin").text()));
	    $("#dailytemponesignmin").html("&#x2109;");
		
		$("#dailytemptwomax").attr("name", "fahrenheite");
		$("#dailytemptwomax").html(convertToFahrenheite($("#dailytemptwomax").text()));
	    $("#dailytemptwosignmax").html("&#x2109;");
		$("#dailytemptwomin").attr("name", "fahrenheite");
		$("#dailytemptwomin").html(convertToFahrenheite($("#dailytemptwomin").text()));
	    $("#dailytemptwosignmin").html("&#x2109;");
		
		$("#dailytempthreemax").attr("name", "fahrenheite");
		$("#dailytempthreemax").html(convertToFahrenheite($("#dailytempthreemax").text()));
	    $("#dailytempthreesignmax").html("&#x2109;");
		$("#dailytempthreemin").attr("name", "fahrenheite");
		$("#dailytempthreemin").html(convertToFahrenheite($("#dailytempthreemin").text()));
	    $("#dailytempthreesignmin").html("&#x2109;;");

		$("#dailytempfourmax").attr("name", "fahrenheite");
		$("#dailytempfourmax").html(convertToFahrenheite($("#dailytempfourmax").text()));
	    $("#dailytempfoursignmax").html("&#x2109;");
		$("#dailytempfourmin").attr("name", "fahrenheite");
		$("#dailytempfourmin").html(convertToFahrenheite($("#dailytempfourmin").text()));
	    $("#dailytempfoursignmin").html("&#x2109;");
		
		$("#dailytempfivemax").attr("name", "fahrenheite");
		$("#dailytempfivemax").html(convertToFahrenheite($("#dailytempfivemax").text()));
	    $("#dailytempfivesignmax").html("&#x2109;");
		$("#dailytempfivemin").attr("name", "fahrenheite");
		$("#dailytempfivemin").html(convertToFahrenheite($("#dailytempfivemin").text()));
	    $("#dailytempfivesignmin").html("&#x2109;");
		
		$("#dailytempsixmax").attr("name", "fahrenheite");
		$("#dailytempsixmax").html(convertToFahrenheite($("#dailytempsixmax").text()));
	    $("#dailytempsixsignmax").html("&#x2109;");
		$("#dailytempsixmin").attr("name", "fahrenheite");
		$("#dailytempsixmin").html(convertToFahrenheite($("#dailytempsixmin").text()));
	    $("#dailytempsixsignmin").html("&#x2109;");

		for(var i = 0; i <= 11; i++) {
			
            var myString = $("#hourlyweatherchart"+i+"").text().replace(/\D/g,'');//Remove temperature sign
			myString = convertToFahrenheite(myString);
			$("#hourlyweatherchart"+i+"").html(myString+"&#x2109;");
			
		}
			
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

		$("#dailytemponemax").attr("name", "centergrade");
		$("#dailytemponemax").html(convertCentergrade($("#dailytemponemax").text()));
	    $("#dailytemponesignmax").html("&deg;");
		$("#dailytemponemin").attr("name", "centergrade");
		$("#dailytemponemin").html(convertCentergrade($("#dailytemponemin").text()));
	    $("#dailytemponesignmin").html("&deg;");
		
		$("#dailytemptwomax").attr("name", "centergrade");
		$("#dailytemptwomax").html(convertCentergrade($("#dailytemptwomax").text()));
	    $("#dailytemptwosignmax").html("&deg;");
		$("#dailytemptwomin").attr("name", "centergrade");
		$("#dailytemptwomin").html(convertCentergrade($("#dailytemptwomin").text()));
	    $("#dailytemptwosignmin").html("&deg;");
		
		$("#dailytempthreemax").attr("name", "centergrade");
		$("#dailytempthreemax").html(convertCentergrade($("#dailytempthreemax").text()));
	    $("#dailytempthreesignmax").html("&deg;");
		$("#dailytempthreemin").attr("name", "centergrade");
		$("#dailytempthreemin").html(convertCentergrade($("#dailytempthreemin").text()));
	    $("#dailytempthreesignmin").html("&deg;");

		$("#dailytempfourmax").attr("name", "centergrade");
		$("#dailytempfourmax").html(convertCentergrade($("#dailytempfourmax").text()));
	    $("#dailytempfoursignmax").html("&deg;");
		$("#dailytempfourmin").attr("name", "centergrade");
		$("#dailytempfourmin").html(convertCentergrade($("#dailytempfourmin").text()));
	    $("#dailytempfoursignmin").html("&deg;");
		
		$("#dailytempfivemax").attr("name", "centergrade");
		$("#dailytempfivemax").html(convertCentergrade($("#dailytempfivemax").text()));
	    $("#dailytempfivesignmax").html("&deg;");
		$("#dailytempfivemin").attr("name", "centergrade");
		$("#dailytempfivemin").html(convertCentergrade($("#dailytempfivemin").text()));
	    $("#dailytempfivesignmin").html("&deg;");
		
		$("#dailytempsixmax").attr("name", "centergrade");
		$("#dailytempsixmax").html(convertCentergrade($("#dailytempsixmax").text()));
	    $("#dailytempsixsignmax").html("&deg;");
		$("#dailytempsixmin").attr("name", "centergrade");
		$("#dailytempsixmin").html(convertCentergrade($("#dailytempsixmin").text()));
	    $("#dailytempsixsignmin").html("&deg;");
		
		for(var i = 0; i <= 11; i++) {
			
            var myString = $("#hourlyweatherchart"+i+"").text().replace(/\D/g,'');//Remove temperature sign
			myString = convertCentergrade(myString);
			$("#hourlyweatherchart"+i+"").html(myString+"&deg;");
		}
		

		
	}
	
	
});

  //Used to get the name of the next six days after current date
  function getDay(data){
		
	var now = new Date();
	var numberOfDaysToAdd = data;
	now.setDate(now.getDate() + numberOfDaysToAdd);
	var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
	var day = days[ now.getDay() ];
	return day;
	
  }
  //Load page with + on the weather when the user presses the buttons for the next 6 days
  $(document).on("click", ".moredaydetails", function(){

  if($(this).text() == "+"){
	 
	 $(this).text("-");
	 
	 showLocalWeather2($("#locatebutton").attr("lat"), $("#locatebutton").attr("lng"), this.name);
  
  }else{
	
	$(this).text("+"); 
	  
  }

  });



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    function showLocalWeather2(lat, lng, numberOfDayFromToday) {

	var boxSelected = "dailyweather"+numberOfDayFromToday;

	
	$('#'+boxSelected+'').html('<section style="background-color:#FCFCFC; padding-bottom:0px;margin-bottom:0px"><div id="tempreture2'+boxSelected+'" class="col-sm-12" style="background-color:#FCFCFC"></div><div class="scrollmenu col-sm-12" id="weatherbar2'+boxSelected+'" style="background-color:white;padding:5px; height: 100px; "></div><span id="dateShown'+boxSelected+'" ></span><div class="scrollmenu" style="background-color:#F7F7F7; padding:10px"><span class="thick">Temp: </span><span name="fahrenheite" temp="" style="opacity:0.731232;" id="tempreturecurrent2'+boxSelected+'"></span><span id="" style="padding-right:15px; opacity: 0.731232;"></span><span id="" class="thick">Wind: </span><span name="˚C, m/s" speed="" style="opacity:0.731232;" id="windSpeed2'+boxSelected+'"></span><span id="" style="padding-right:15px; opacity: 0.731232;"></span><span class="thick">Humidity: </span><span style="opacity:0.731232;" id="humidity2'+boxSelected+'"></span> <span id="" style="padding-right:15px; opacity: 0.731232;"></span><span class="thick" >UV Index: </span><span style="background-color:#94D587; opacity:0.731232; "  id="uv2'+boxSelected+'"></span><span id="" style="padding-right:15px; opacity: 0.731232;"></span> </div><div class="scrollmenu" style="background-color:#F7F7F7; padding:10px"><span class="thick" >Precip: </span><span style=" opacity:0.731232; "  id="precip2'+boxSelected+'"></span><span id="" style="padding-right:15px; opacity: 0.731232;"></span><span class="thick" >Pressure: </span><span  style="opacity:0.731232;" id="pressure2'+boxSelected+'"></span> <span style="padding-right:15px; opacity: 0.731232;">hPa</span><span class="thick" >Dew Pt: </span><span  style="opacity:0.731232;" id="dewpoint2'+boxSelected+'"></span><span id="" style="padding-right:15px; opacity: 0.731232;">˚</span><span class="thick">Visibility: </span><span name="miles" miles="" style="opacity:0.731232;" id="visibility2'+boxSelected+'"></span><span id="" style="padding-right:15px; opacity: 0.731232;"></span></div></section>');
	//$('#'+boxSelected+'').html('<section style="background-color:#FCFCFC; padding-bottom:0px;margin-bottom:0px"><div class="scrollmenu  col-sm-12" id="weatherbar2'+boxSelected+'" style="background-color:white;padding:5px; height: 100px; "></div></section>');

     $('#'+boxSelected+'').append("<br><button name='"+numberOfDayFromToday+"' class='btn btn-primary moredaydetails2'>MORE DETAILS</button>");
	
    //The location is saved in the locationLat and locationLong div boxes when the page loads
    var latitude = lat;
    //alert(latitude)
    var longitude = lng;
    //alert(longitude);

    var numberOfDayFromToday = parseInt(numberOfDayFromToday);

    var now = new Date();
	now.setDate(now.getDate() + numberOfDayFromToday);
    var ts = Math.round((new Date(now)).getTime() / 1000);//Convert time to correct format
    
	$("#dateShown"+boxSelected+"").html(now.toLocaleTimeString([], {weekday: "long", year: "numeric", month: "long", day: "numeric"}));
	

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

	     //console.log(data);
        var weather = data["currently"].summary;
        var day = data["hourly"].summary;
	    var maxTemp = Math.round(data["daily"].data[0].apparentTemperatureMax);
	    var minTemp = Math.round(data["daily"].data[0].apparentTemperatureMin);
        var nextH1 = new Date((data["daily"].data[0].sunriseTime*1000)).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        var nextH2 = new Date((data["daily"].data[0].sunsetTime*1000)).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
		var nextH3 = new Date((data["hourly"].data[0].time*1000)).toLocaleString('en-UK', { hour: 'numeric', hour12: true });
		var nextH4 = new Date((data["hourly"].data[22].time*1000)).toLocaleString('en-UK', { hour: 'numeric', hour12: true });
		
      if($("#currentdropdownselect").attr("name") == "fahrenheite"){


	    $("#tempreture2"+boxSelected+"").html("<h2>"+day+"</h2>"
        +"<strong style='font-size: 17px;'><span name='fahrenheite' temp='" + Math.round(data["hourly"].data[0].apparentTemperature)+"' id='currenttemp0"+boxSelected+"'>" + Math.round(data["hourly"].data[0].apparentTemperature)+"&#x2109;</span></strong>&nbsp"+nextH3+"&nbsp→&nbsp" +"<strong style='font-size: 17px;'><span name='fahrenheite' temp='" + Math.round(data["hourly"].data[22].apparentTemperature)+"' id='currenttemp1"+boxSelected+"'>" + Math.round(data["hourly"].data[22].apparentTemperature) 
		+"&#x2109;</span></strong>&nbsp"+nextH4+"&nbsp&nbsp&nbsp<span> Sunrise: "+nextH1+"</span>&nbsp<span>Sunset: "+nextH2+"</span>");

		
	  }else{
		  
		$("#tempreture2"+boxSelected+"").html("<h2>"+day+"</h2>"
        +"<strong style='font-size: 17px;'><span name='centergrade' temp='" + convertCentergrade(data["hourly"].data[0].apparentTemperature)+"' id='currenttemp0"+boxSelected+"'>" +convertCentergrade(data["hourly"].data[0].apparentTemperature)+"&deg;</span></strong>&nbsp"+nextH3+"&nbsp→&nbsp" +"<strong style='font-size: 17px;'><span name='centergrade' temp='" + convertCentergrade(data["hourly"].data[22].apparentTemperature)+"' id='currenttemp1"+boxSelected+"'>" + convertCentergrade(data["hourly"].data[22].apparentTemperature) 
		+"&deg;</span></strong>&nbsp"+nextH4+"&nbsp&nbsp&nbsp<span> Sunrise: "+nextH1+"</span>&nbsp<span>Sunset: "+nextH2+"</span>");

		  
	  }
		
		
		
	    //Create icons for weather - uses https://github.com/darkskyapp/skyconsicns -  https://github.com/darkskyapp/skycons
		var skycons = new Skycons({"resizeClear": true});
        skycons.add(document.getElementById("icon"), data.currently.icon);

		//Current temp
	   if (typeof data["currently"].uvIndex !== "undefined") {//Show message when city not found
		
		$("#uv2"+boxSelected+"").html("&nbsp"+data["currently"].uvIndex);
	
		if(data["currently"].uvIndex >= 0 && data["currently"].uvIndex < 3){
	  	$("#uv2"+boxSelected+"").css("background-color","rgba(64,191,64,.6)");	
	}else if(data["currently"].uvIndex > 2.9 && data["currently"].uvIndex < 6){ 
			 $("#uv2"+boxSelected+"").css("background-color","yellow");
		 }else if(data["currently"].uvIndex > 5.9 && data["currently"].uvIndex < 8){ 
			$("#uv2"+boxSelected+"").css("background-color","orange");
		 }else{
		$("#uv2"+boxSelected+"").css("background-color","red");
		 }
		 
		}
		
		if($("#currentdropdownselect").attr("name") == "fahrenheite"){

			$("#tempreturecurrent2"+boxSelected+"").html("<span id='currenttemp2dailyweather"+boxSelected+"' name='fahrenheite' temp='"+Math.round(data["currently"].apparentTemperature) +"' id='currenttemp"+boxSelected+"'>" +Math.round(data["currently"].apparentTemperature) +"&#x2109</span>");
			
		}else{
			
			$("#tempreturecurrent2"+boxSelected+"").html("<span id='currenttemp2dailyweather"+boxSelected+"' name='centergrade' temp='"+data["currently"].apparentTemperature +"' id='currenttemp"+boxSelected+"'>" +convertCentergrade(data["currently"].apparentTemperature) +"&deg;</span>");
			
		}
		
		
		
        $("#precip2"+boxSelected+"").html("&nbsp"+Math.round(data["currently"].precipIntensity)+"%");

		$("#dewpoint2"+boxSelected+"").html("&nbsp"+Math.round(data["currently"].dewPoint));
		$("#windSpeed2"+boxSelected+"").attr("speed", Math.round(data["currently"].windSpeed));

	    $("#visibility2"+boxSelected+"").html("&nbsp"+Math.round(data["currently"].visibility)+" mi");

		if($("#windSpeed").attr("name") == "m/s"){
	
			var myString = Math.round(data["currently"].visibility);
			myString *= 1.609344;
			$("#visibility2").html("&nbsp"+Math.round(myString)+" km&nbsp");
	
			var myString = data["currently"].windSpeed;
			myString *= 0.44704;
			myString = Math.round(myString);
			$("#windSpeed2"+boxSelected+"").html("&nbsp"+myString+" m/s&nbsp");
			$("#windSpeed2"+boxSelected+"").attr("speed", Math.round(data["currently"].windSpeed));
			$("#windSpeed2"+boxSelected+"").attr("name", "m/s");
			
			var myString = data["currently"].visibility;
			myString *= 1.609344;
			$("#visibility2"+boxSelected+"").html("&nbsp"+Math.round(myString)+" km&nbsp");
		
			
		}else if($("#windSpeed").attr("name") == "km/h"){
			
			//console.log($("#windSpeed").attr("name"));
			
			var myString = data["currently"].windSpeed;
			myString *= 1.609344;
			myString = Math.round(myString);
			$("#windSpeed2"+boxSelected+"").html("&nbsp"+myString+" km/h&nbsp");
			$("#windSpeed2"+boxSelected+"").attr("speed", Math.round(data["currently"].windSpeed));
			$("#windSpeed2"+boxSelected+"").attr("name", "km/h");
			
			var myString = Math.round(data["currently"].visibility);
			myString *= 1.609344;
			$("#visibility2"+boxSelected+"").html("&nbsp"+Math.round(myString)+" km&nbsp");

			
		}else{
			
			var myString = Math.round(data["currently"].visibility);
			$("#visibility").html("&nbsp"+Math.round(myString)+" mi&nbsp");
			
			var myString =  Math.round(data["currently"].windSpeed);
			myString = Math.round(myString);
			$("#windSpeed2"+boxSelected+"").html("&nbsp"+myString+" mph&nbsp");
			$("#windSpeed2"+boxSelected+"").attr("speed", Math.round(data["currently"].windSpeed));
			$("#windSpeed2"+boxSelected+"").attr("name", "mph");		
		}

		$("#pressure2"+boxSelected+"").html("&nbsp"+Math.round(data["currently"].pressure));
		$("#humidity2"+boxSelected+"").html("&nbsp"+Math.round(data["currently"].humidity*100)+"%");

		var nextH1 = "";
        var currentWeathers = [];

	    for(var i = 0; i <= 22;  i = i + 2){//Get the weather type for the next 22h
		 
		  currentWeathers.push(data["hourly"].data[i].summary);
		 
	     }

     //console.log(currentWeathers);

	  $("#weatherbar2"+boxSelected+"").html("");
				
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
	
	    arrorBoxArray = [];//Hold the arrows, weather and tempreture of next 22h weather
	    var nums = 0;
		var numtest = 0;
	    arrorBoxArray.push("");

		for(var x = 0;  x < 24; x+= 2){//Used to add the arrows and tempreture of next 22h weather to the $("#weatherbar") div
		
			nextH1 = new Date((data["hourly"].data[numtest].time*1000)).toLocaleString('en-UK', { hour: 'numeric', hour12: true });
			var nextTemp = Math.round(data["hourly"].data[numtest].apparentTemperature);
			numtest = numtest +2;

			arrorBoxArray[0] += "<span style='display:inline-block; height: 5px; position: absolute; left:"+(x*45)+"px ;top:26px'>|<span style='display:inline-block; height: 5px; position: absolute; left:45px ;top:0px'>|</span></span>";	
			arrorBoxArray[0] += "<span style='display:inline-block; height: 5px; position: absolute; left:"+(x*45)+"px ;top:41px'><strong>"+nextH1+"</strong></span>";
			
			if($("#currenttemp").attr("name") == "fahrenheite"){
				
				arrorBoxArray[0] += "<span name='fahrenheite' temp='"+nextTemp+"' id='hourlyweatherchart2"+boxSelected+""+nums+"' style='display:inline-block; opacity: 0.731232; height: 5px; position: absolute; left:"+(x*45)+"px ;top:61px'>"+nextTemp+"&#x2109;</span>";
		    	$("#hourlyweatherchart2"+boxSelected+""+nums+"").attr("name", "fahrenheite");
				
			
			}else{
				
				arrorBoxArray[0] += "<span name='centergrade' temp='"+nextTemp+"' id='hourlyweatherchart2"+boxSelected+""+nums+"' style='display:inline-block; opacity: 0.731232; height: 5px; position: absolute; left:"+(x*45)+"px ;top:61px'>"+convertCentergrade(nextTemp)+"°</span>";
			}		
		
			
			nums += 1;			
		}

		var leftValue = 0;
		var backGroundColor = "";
		var sizeBox = 91;
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
			
		    arrorBoxArray.push( "<span  style='overflow:hidden; height: 30px;background-color:"+backGroundColor+"; text-align: left; width:"+(numberOfWeatherArray[i]*sizeBox)+"px; display:inline-block;  border:1px solid gray; position: absolute; left:"+leftValue+"px; ;top:0px'>"+valueToShow+"</span>");
            leftValue += numberOfWeatherArray[i]*sizeBox;
	     }
		 
		 $("#weatherbar2"+boxSelected+"").html("<span>"+arrorBoxArray+"</span>");
	
		 //console.log(arrorBoxArray);

	  
	  },//End success
       error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Weather for this city is not currently available");; 
	  }, 

	});
  }

  
  //Load page with more details on the weather when the user presses the buttons for the next 6 days
  $(document).on("click", ".moredaydetails2", function(){

	  window.location.href = "timemachines.php?lat="+$("#locatebutton").attr("lat")+"&lng="+$("#locatebutton").attr("lng")+"&day="+this.name+"&cityname="+$(".glass").attr("placeholder");
  
  });
  
    //$(document).on("click", ".reset", function(e){
		//e.preventDefault();
		
		// alert("test");
		// $(".reset").children().off();
		 
		 
	//});

	
	
	
	  $(document).on("focus", ".reset", function(e){
		   $(this).focus();
		  ///alert("test2");
		   // $(".leaflet-control-geosearch.bar").focus();
          // $(".reset").children().off();
		  //  $(".reset").off();
	  });
	  
	  
	  
	  
	   var onKeypressHandler = function(){
    console.log("* * * keypress event handler");
    //$('.leaflet-control-geosearch.bar').blur().focus();
  };
	
//$( ".reset" ).focus(function() {
	
 /// alert( "Handler for .focus() called." );
 // 
//});

	//$('.leaflet-control-geosearch.bar').on({ 'touchstart' : function(){

	
	//alert("test7");} });
	

  
  
  
$(window).on('load', function() {
$('a').on('click touchend',function(e){
	//e.preventDefault();
	
	  // alert('Mouse Clicks4');
      // $("a").removeAttr("onclick");
	
}  )})




$(".leaflet-control-geosearch.bar glass").blur(function() {
	
	
	
	 //alert( "Handler for .blur() called." );
	
})	
	
	
$(".leaflet-control-geosearch.bar" ).blur(function() {
 
});



$(window).on('load', function() {
	
	
	
	





	//$('.glass').unbind();
	
	//$('.a.reset')
 // .unbind('click') // takes care of jQuery-bound click events
//  .attr('onclick', '') // clears `onclick` attributes in the HTML
  //.each(function() { // reset `onclick` event handlers
  //  this.onclick = null;
  ///});
	
	
	
	$('a.reset').on({ 'touchstart' : function(){ 
	
	
	//alert('Touch');
	
	/* do something... */ } });
	
$('a.reset').on('click touchend',function(e){
	
	//alert('Touch');
	
})	
	
	
$('.leaflet-control-geosearch.bar').on('click touchend',function(e){
	
//e.preventDefault();
 
  
   

	
 //if(e.type=='click')
 
  // alert('Mouse Click2');
   
	  
	  
  //else
	  
  //alert('Touch');
  
 // $(".leaflet-control-geosearch.bar").focus();
  //$(".leaflet-control-geosearch.bar").children().off();

  
  
//$('.glass').bind('focus', focusTextField);
//$('.glass').bind('click', onClickHandler);
//$('.glass').bind('keypress', onKeypressHandler);




//
   //$("form").click(function(){ $("input[name='term']").trigger('focus') });
  // 
  


	
})
  
  
})

  var onKeypressHandler = function(){
    console.log("* * * keypress event handler")
    //$('.leaflet-control-geosearch.bar').blur().focus();
  };


var focusTextField = function(){
    console.log("focusElement");
  };


$('.leaflet-control-geosearch.bar').on({ 'touchstart' : function(){
	
// alert("test");} });





  var onClickHandler = function() {
    //$('.leaflet-control-geosearch.bar').trigger('keypress');
  };

  //$('.leaflet-control-geosearch.bar').bind('focus', focusTextField);
  //$('.leaflet-control-geosearch.bar').bind('click', onClickHandler);
  //$('.leaflet-control-geosearch.bar').bind('keypress', onKeypressHandler);

   //$(".leaflet-control-geosearch.bar").click(function(){ $("input[name='term']").trigger('focus') });
   
   //$/(".leaflet-control-geosearch.bar").focus();
   
 
	 $( ".leaflet-control-geosearch.bar" ).focusin(function() {
	  //$( this ).text("ff");
	});

	
   $('.leaflet-control-geosearch.bar').val("fgg");
   $('input', $(".leaflet-control-geosearch.bar")).focus();


//function getEventsList($obj) {
 ////   var ev = new Array(),
  // /     events = $obj.data('events'),
   ///     i;
    ///for(i in events) { ev.push(i); }
    //return ev.join(' ');
///}

//$('body').on("click mousedown mouseup focus blur keydown change mouseup click dblclick mousemove mouseover mouseout mousewheel keydown keyup keypress //textInput touchstart touchmove touchend touchcancel resize scroll zoom focus blur select change submit reset",function(e){
  //   console.log(e);
///}); 


alert("£££");
</script>
 
</body>
</html>
    