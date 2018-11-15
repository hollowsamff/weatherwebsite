<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description">
	<meta content="" name="author">

	<title>Weather finder</title>
   
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
  

     <!-- Load Leaflet from CDN -->
	<script src="leaflet/leaflet.js"></script>
	<script src="leaflet/leaflet-src.js"></script>
	
	<link  href="https://unpkg.com/leaflet-geosearch@latest/assets/css/leaflet.css" rel="stylesheet" />
    
	<script src="https://unpkg.com/leaflet-geosearch@latest/dist/bundle.min.js"></script>
	

	
	

    <!-- Load Esri Leaflet from CDN http://esri.github.io/esri-leaflet/examples/geocoding-control.html 
    <script src="https://unpkg.com/esri-leaflet@2.1.4/dist/esri-leaflet.js"
    integrity="sha512-m+BZ3OSlzGdYLqUBZt3u6eA0sH+Txdmq7cqA1u8/B2aTXviGMMLOfrKyiIW7181jbzZAY0u+3jWoiL61iLcTKQ=="
    crossorigin=""></script>

  <!-- Load Esri Leaflet Geocoder from CDN 
  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.css"
    integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ=="
    crossorigin="">
	
  <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.js"
  integrity="sha512-QXchymy6PyEfYFQeOUuoz5pH5q9ng0eewZN8Sv0wvxq3ZhujTGF4eS/ySpnl6YfTQRWmA2Nn3Bezi9xuF8yNiw=="
  crossorigin=""></script>

 -->
 
 
  
  <!-- Load JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <!-- Load JQuery UI -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

  <!-- Bootstrap -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js'></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <link href="css/style.css" rel="stylesheet">	

  <script type="text/javascript" src="js/skycons.js"></script>
  
  
<style>
  
    body { 
		margin:0; padding:0; 
	}
    #map { 
		margin-top:50px;
	}
	
	html, body, #map {
      height: 100%;
      width: 100%;
    }
	

<!--

	.leaflet-left .leaflet-control {
	   margin-left: 0px;
	}

	.leaflet-container .leaflet-control-attribution, .leaflet-container .leaflet-control-scale {
		font-size: 8px;
	}

	.leaflet-touch .leaflet-bar a {
		width: 0px;
		color: #EEEEEE;
		background-color:#EEEEEE;
	}

-->
	.leaflet-touch .leaflet-control-layers, .leaflet-touch .leaflet-bar {
		border: 1px solid rgba(0,0,0,0);
	}

	.leaflet-touch .geocoder-control-input {
		
		position: absolute;
		left: 450px!important;
		top: -75px!important;
		width: 420px;
		border: 1px solid #EEEEEE;
		background-image:none;
		overflow: auto;
		
	}

	.leaflet-touch .geocoder-control-suggestions {
		top: -80px;
		left:750px;
		color:blue;
		z-index:5000000!important;
		border: 1px solid black;
		overflow:hide;
		text-align:left;
	}

	
	
	
	.fab {
	  position: absolute;
	  bottom: 12px;
	  left: 400px;
	  z-index:100;
	  background-color:#D0D0D0;
	}

	#convertbutton{
		position: absolute;
		left: 170px;	
	}

	
	@media only screen and (max-width: 1025px) {
			
		  #convertbutton{
		 
			left: 55px;
		  }
			
		  .leaflet-touch .geocoder-control-input {    
			left: 300px!important;
		  }
		  
		  .leaflet-touch .geocoder-control-suggestions {
			  left: 650px!important;
		  }
		  .fab {
			left: 250px;
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
		   left: 0px;
		}
		#windSpeed{
				margin-left:0px;
			}
			#windtitle{
				margin-left:80px;
			}
	}

	@media only screen and (max-width: 780px) {

	  .leaflet-touch .geocoder-control-input {   
		left: 200px!important;
	  }
	   .leaflet-touch .geocoder-control-suggestions {
		  left: 450px!important;
	  }
	  .fab {
		left: 150px;
	   }
	   
	   #convertbutton{
		  left: 0px;
		}
			
		#windSpeed{
			margin-left:0px;
		}
		#windtitle{
			margin-left:80px;
		}

	}

	@media only screen and (max-width: 602px) {
		
		#convertbutton{
		  left: 0px;
		}
			
		#windSpeed{
			margin-left:0px;
		}
		#windtitle{
			margin-left:80px;
		}
		
	  .leaflet-touch .geocoder-control-input { 
		left: 50px!important;
		width: 265px;
	 }
	 
	   .leaflet-touch .geocoder-control-suggestions {
		  left: 140px!important;
	  }
	  .fab {
		left: 15px;
	   }
	}


	.leaflet-touch .leaflet-bar a {
		width: 0px;
	}


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

  </style>
  
  <!--- DO NOT EDIT - GlobalSign SSL Site Seal Code - DO NOT EDIT
  <<table width=125 border=0 cellspacing=0 cellpadding=0 title="CLICK TO VERIFY: This site uses a GlobalSign SSL Certificate to secure your personal information." ><tr><td><span id="ss_img_wrapper_gmogs_image_125-50_en_dblue"><a href="https://www.globalsign.com/" target=_blank title="GlobalSign Site Seal" rel="nofollow"><img alt="SSL" border=0 id="ss_img" src="//seal.globalsign.com/SiteSeal/images/gs_noscript_125-50_en.gif"></a></span><script type="text/javascript" src="//seal.globalsign.com/SiteSeal/gmogs_image_125-50_en_dblue.js"></script></td></tr></table><!--- DO NOT EDIT - GlobalSign SSL Site Seal Code - DO NOT EDIT --->
  
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

	<div id='map' style="height:500px;  position: relative;">
 
	  <Button lat="" lng="" id='locatebutton' class="fab FolderTitle Closed" aria-hidden="true" onClick="refreshPage()">
	  </Button>
	  
	</div>

   	<div id="convertbutton"class="btn-group col-md-1" role="group" style="margin-left: 0px; padding: 0px">
		
		<button id="currentdropdownselect" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%">
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
   
   
   <div class="scrollmenu" style="background-color:#F7F7F7; padding:10px">

    <span id="windtitle" class="thick">Wind: </span><span name="˚C, m/s" speed="" style="opacity:0.731232;" id="windSpeed"></span>
	<span id="" style="padding-right:15px; opacity: 0.731232;"></span>
    <span class="thick">Humidity: </span><span style="opacity:0.731232;" id="humidity"></span> 
	<span id="" style="padding-right:15px; opacity: 0.731232;"></span>
    <span class="thick" >Dew Pt: </span><span  style="opacity:0.731232;" id="dewpoint"></span>
	<span id="" style="padding-right:15px; opacity: 0.731232;">˚</span>
    <span class="thick" >UV Index: </span><span style="background-color:#94D587; opacity:0.731232; "  id="uv"></span>
	<span id="" style="padding-right:15px; opacity: 0.731232;"></span>
 	<span class="thick">Visibility: </span><span name="miles" miles="" style="opacity:0.731232;" id="visibility"></span>
	<span id="" style="padding-right:15px; opacity: 0.731232;"></span>
    <span class="thick" >Pressure: </span><span  style="opacity:0.731232;" id="pressure"></span> <span style="padding-right:15px; opacity: 0.731232;">hPa</span>
	
   </div>


	 <div id="tempreture" class="col-sm-12" style="background-color:#FCFCFC"></div>

	  <div class="scrollmenu" id="weatherbar" style="background-color:white;padding:5px; height: 100px;">
	  </div>
	
	<script src='https://darksky.net/map-embed/@temperature,39.000,-95.000,4.js?embed=true&timeControl=true&fieldControl=true&defaultField=temperature&defaultUnits=_c'></script>
	

      <section style="background-color:#FCFCFC; padding-bottom:20px;margin-bottom:100px">
         
		 <div class="row">
	
		<div class="col-sm-2">	 
			<span class="thick" id="nextdayname1"></span><br><span id="nextdaydetails1"></span> 
		 </div> 
		
		<div class="col-sm-2">	 
			<span class="thick" id="nextdayname2" ></span><br><span id="nextdaydetails2"></span> 
		 </div> 
		
		<div class="col-sm-2">	 
			<span class="thick" id="nextdayname3"></span><br><span id="nextdaydetails3"></span> 
		 </div> 
		 
		 <div class="col-sm-2">	 
			<span class="thick" id="nextdayname4"></span><br><span id="nextdaydetails4"></span> 
		 </div> 
		
		<div class="col-sm-2">	 
			<span class="thick" id="nextdayname5"></span><br><span id="nextdaydetails5"></span> 
		 </div> 
		 
		 <div class="col-sm-2">	 
			<span class="thick" id="nextdayname6"></span><br><span id="nextdaydetails6"></span> 
		 </div>   
		 
		
		 </div> 
   </div>
  </section>

  <!-- website footer-->
        <footer  class="navbar-fixed-bottom" style=" background-color:black;width:100%;">
            <div class="row">
                <div class="col-lg-12">
                    <p style = "color:#fff">

						Search function use the <a href="https://leafletjs.com">leafletjs plugin</a><br>
						and <a href="https://www.openstreetmap.org">openstreetmap</a><br>
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


var GeoSearchControl = window.GeoSearch.GeoSearchControl;
var OpenStreetMapProvider = window.GeoSearch.OpenStreetMapProvider;

//var searchControl = new GeoSearchControl({
 // OpenStreetMapProvider: OpenStreetMapProvider,
 // autoComplete: true,             // optional: true|false  - default true
///  autoCompleteDelay: 250,         // optional: number      - defaul
//});


const provider = window.GeoSearch.OpenStreetMapProvider;

const searchControl = new GeoSearchControl({
  provider: provider,
});

const map = new L.Map('map');
map.addControl(searchControl);

map.setView(new L.LatLng(40.7306,-73.9866));




//var map = new L.Map('map');
//map.addControl(searchControl);


//var map = new L.Map('map');
//var cityName = "New York";

  //var searchControl = L.esri.Geocoding.geosearch().addTo(map) ; 

  
  //var results = L.layerGroup().addTo(map);

  //searchControl.on('results', function(data){
	  
	 //console.log(data);
    // results.clearLayers();
	 
	//if (typeof data.latlng === "undefined") {//Show message when city not found
		
	//	alert("City not found");
		
	//}else{
	//	showLocalWeather(data.latlng.lat,data.latlng.lng);	
		//geocodeService.reverse().latlng(data.latlng).run(function(error, result) {
	   
	      // $(".geocoder-control-input").val(result.address.Match_addr);
      
	   //});
	//}
	
  //});
  
   //var geocodeService = L.esri.Geocoding.geocodeService();

   //function onLocationFound(e) {

	 // geocodeService.reverse().latlng(e.latlng).run(function(error, result) {
	   
	  // $(".geocoder-control-input").val(result.address.Match_addr);
      
	 // });
	  
      //showLocalWeather(e.latlng.lat, e.latlng.lng);
      //map.setView(new L.LatLng(e.latlng.lat, e.latlng.lng)); 
   //}
   
   //	function onLocationError(e) {

		//alert(e.message);
		//alert("Showing weather for default location New York");
		 //showLocalWeather(40.7127,-74.0059);
		 //map.setView(new L.LatLng(40.7306,-73.9866));
         //$(".geocoder-control-input").val(cityName);		
		
	//}

	//findLocation();
	
	//function findLocation(){
  
	//  map.on('locationfound', onLocationFound);
	//  map.on('locationerror', onLocationError);
    //  map.locate({setView: true, maxZoom: 10});	  
	//}

	
	
	
 //////////////////////////////////////New function
  function showLocalWeather2(lat, lng) {

    //The location is saved in the locationLat and locationLong div boxes when the page loads
    var latitude = lat;
    //alert(latitude)
    var longitude = lng;
    //alert(longitude);
	

    var now = new Date();
	var numberOfDaysToAdd = 50;
	now.setDate(now.getDate() + numberOfDaysToAdd);
	alert("Showing weather for "+now)
    var ts = Math.round((new Date(now)).getTime() / 1000);

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

	  console.log(data);
	  
	  }

	});
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

        console.log(data);
		
        ////////////////
        var weatherIcon = data["currently"].icon;
        var weather = data["currently"].summary;
        var day = data["hourly"].summary;
	   
	    var maxTemp = Math.round(data["daily"].data[0].apparentTemperatureMax);
	    var minTemp = Math.round(data["daily"].data[0].apparentTemperatureMin);

		
        $("#tempreture").html(
          "<span><h1><span name='fahrenheite' id='currenttemp'>" +
            data["currently"].apparentTemperature +
            "</span><span id='currenttempsign' >&#x2109;</span>&nbsp" +
            weather+
            "</h1><canvas id='icon' width='64' height='64' class='currentWeather' title='" +weatherIcon + "'></canvas><br></span>" +"<strong>Low:</strong><span id='currenttempmin' name='fahrenheite'>"+minTemp+"</span><span id='currenttempminsign' >&#x2109;</span>&nbsp;<strong>High:</strong><span id='currenttempmax' name='fahrenheite'>"+maxTemp+"</span><span id='currenttempmaxsign' >&#x2109;</span><br><h3>"+
			day + 
			"</h3>"
        );

		//Create icons for weather - uses https://github.com/darkskyapp/skyconsicns -  https://github.com/darkskyapp/skycons
		var skycons = new Skycons({"resizeClear": true});
        skycons.add(document.getElementById("icon"), data.currently.icon);

		//Current temp
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
		
		$("#windSpeed").html("&nbsp"+Math.round(data["currently"].windSpeed)+" mph");
		$("#windSpeed").attr("speed", Math.round(data["currently"].windSpeed));

		$("#visibility").html("&nbsp"+Math.round(data["currently"].visibility)+" mi");
		$("#visibility").attr("miles", Math.round(Math.round(data["currently"].visibility)));

		$("#pressure").html("&nbsp"+Math.round(data["currently"].pressure));
		$("#humidity").html("&nbsp"+Math.round(data["currently"].humidity*100)+"%");

		var nextH1 = "";
        var currentWeathers = [];

	    for(var i = 0; i <= 22;  i = i + 2){//Get the weather type for the next 22h
		 
		  currentWeathers.push(data["hourly"].data[i].summary);
		 
	     }

     console.log(currentWeathers);

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
    console.log(uniqueArray);
	

	if(uniqueArray.length  == 1){
		
		numberOfWeatherArray.push(12);
		
	}else{
		
    	numberOfWeatherArray.push(currentWeathers.length - numberOfWeatherArrayLastItem[numberOfWeatherArrayLastItem.length-1]);//Add the numer of times  the last weather type happened to the array 

	}
	
	//console.log(numberOfWeatherArray);
	arrorBoxArray = [];//Hold the arrows and tempreture of next 22h weather
	var nums = 0;

	for(var i = 0; i < numberOfWeatherArray.length; i++){//Used to add the arrows and tempreture of next 22h weather to the $("#weatherbar") div

		arrorBoxArray.push("");
		
		for(var x = 0;  x < numberOfWeatherArray[i]; x++){

			nextH1 = new Date((data["hourly"].data[nums*2].time*1000)).toLocaleString('en-UK', { hour: 'numeric', hour12: true });
            if(i == 0 &&  x == 0){
			  nextH1 = "Now"; 
		    }
			
			arrorBoxArray[i] += "<span style='display:inline-block; height: 5px; position: absolute; left:"+(x*43)+"px ;top:39px'>|</span><span style='display:inline-block; height: 5px; position: absolute; left:"+(x*43)+"px ;top:52px'><strong>"+nextH1+"</strong></span><span id='hourlyweatherchart"+nums+"' style='display:inline-block;opacity: 0.731232; height: 5px; position: absolute; left:"+(x*43)+"px ;top:72px'>"+Math.round(data["hourly"].data[nums*2].apparentTemperature)+""+"&#x2109;</span>";	
			nums += 1;
			
		}
	}

	var backGroundColor = "";
	var widthBox = 100;

	for(var i = 0; i < uniqueArray.length; i++ ){//Create bar of weather type per hour for the next 22 hours

	   widthBox = numberOfWeatherArray[i]  * 55;
	   
		if(widthBox < 170){
			widthBox = 170;
		}
		if(numberOfWeatherArray.length == 1){//When only one weather type is stored
			
			widthBox = 600;
			
		}
		if(uniqueArray[i] == "Clear"){//Change color of box based on weather type
			
			backGroundColor = "white";
			
		}else if(uniqueArray[i] == "Rain"|| uniqueArray[i] == "Light Rain"){	
		
			backGroundColor = "#80a5d6";
			
		}else if (uniqueArray[i] == "Partly Cloudy"){
			
			backGroundColor = "gray";
			
		}else{
			
			backGroundColor = "darkgray";
		}
		
		$("#weatherbar").append("<span style='position:relative; background-color:"+backGroundColor+";display:inline-block; width:"+widthBox+"px; height:45px; border:1px solid gray'>"+uniqueArray[i]+
		arrorBoxArray[i]);

		$("#weatherbar").append("</span>")
    }
	
       //Next weeks weather 
		$("#nextdayname1").html(getDay(1));
        $("#nextdayname2").html(getDay(2));
		$("#nextdayname3").html(getDay(3));
	    $("#nextdayname4").html(getDay(4));
		$("#nextdayname5").html(getDay(5));
		$("#nextdayname6").html(getDay(6));
		
		$("#nextdaydetails1").html(
		"<canvas id='icon2' width='64' height='64' title=''></canvas><br></span>" +
		 "<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytemponemax'>"+ data["daily"].data[1].apparentTemperatureMax +"</span><span id='dailytemponesignmax'>&#x2109;</span>&nbsp<strong>Low:</strong><span name='fahrenheite' id='dailytemponemin'>"+ data["daily"].data[1].apparentTemperatureMin +"</span><span id='dailytemponesignmin'>&#x2109;</span><br>"+data["daily"].data[1].summary);
	     skycons.add(document.getElementById("icon2"), data["daily"].data[1].icon);
		 
        ////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 	 
		$("#nextdaydetails1").append("<br><button name='1' class='btn btn-primary moredaydetails'>MORE DETAILS</button>");
	
		$("#nextdaydetails2").html(
		"<canvas id='icon3' width='64' height='64' title=''></canvas><br></span>" +
		 "<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytemptwomax'>"+ data["daily"].data[2].apparentTemperatureMax +"</span><span id='dailytemptwosignmax'>&#x2109;</span>&nbsp<strong>Low:</strong><span name='fahrenheite' id='dailytemptwomin'>"+ data["daily"].data[2].apparentTemperatureMin +"</span><span id='dailytemptwosignmin'>&#x2109;</span><br>"+data["daily"].data[2].summary);
	      skycons.add(document.getElementById("icon3"), data["daily"].data[2].icon);
		  
        ////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 
		$("#nextdaydetails2").append("<br><button name='2' class='btn btn-primary moredaydetails'>MORE DETAILS</button>");

		$("#nextdaydetails3").html(
		"<canvas id='icon4' width='64' height='64' title=''></canvas><br></span>" +
		 "<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytempthreemax'>"+ data["daily"].data[3].apparentTemperatureMax +"</span><span id='dailytempthreesignmax'>&#x2109;</span>&nbsp<strong>Low:</strong><span name='fahrenheite' id='dailytempthreemin'>"+ data["daily"].data[3].apparentTemperatureMin +"</span><span id='dailytempthreesignmin'>&#x2109;</span><br>"+data["daily"].data[3].summary);
	     skycons.add(document.getElementById("icon4"), data["daily"].data[3].icon);
		 
         ////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 		 
		$("#nextdaydetails3").append("<br><button name='3' class='btn btn-primary moredaydetails'>MORE DETAILS</button>");

		$("#nextdaydetails4").html(
		"<canvas id='icon5' width='64' height='64' title=''></canvas><br></span>" +
		 "<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytempfourmax'>"+ data["daily"].data[4].apparentTemperatureMax +"</span><span id='dailytempfoursignmax'>&#x2109;</span>&nbsp<strong>Low:</strong><span name='fahrenheite' id='dailytempfourmin'>"+ data["daily"].data[4].apparentTemperatureMin +"</span><span id='dailytempfoursignmin'>&#x2109;</span><br>"+data["daily"].data[4].summary);
         skycons.add(document.getElementById("icon5"), data["daily"].data[4].icon);
       
		 ////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 			 
		$("#nextdaydetails4").append("<br><button name='4' class='btn btn-primary moredaydetails'>MORE DETAILS</button>");

		$("#nextdaydetails5").html(
		"<canvas id='icon6' width='64' height='64' title=''></canvas><br></span>" +
		 "<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytempfivemax'>"+ data["daily"].data[5].apparentTemperatureMax +"</span><span id='dailytempfivesignmax'>&#x2109;</span>&nbsp<strong>Low:</strong><span name='fahrenheite' id='dailytempfivemin'>"+ data["daily"].data[5].apparentTemperatureMin +"</span><span id='dailytempfivesignmin'>&#x2109;</span><br>"+data["daily"].data[5].summary);
		skycons.add(document.getElementById("icon6"), data["daily"].data[5].icon);
        ////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 		 
		$("#nextdaydetails5").append("<br><button name='5' class='btn btn-primary moredaydetails'>MORE DETAILS</button>");

		$("#nextdaydetails6").html(
		"<canvas id='icon7' width='64' height='64' title=''></canvas><br></span>" +
		 "<strong>High:&nbsp</strong><span name='fahrenheite' id='dailytempsixmax'>"+ data["daily"].data[6].apparentTemperatureMax +"</span><span id='dailytempsixsignmax'>&#x2109;</span>&nbsp<strong>Low:</strong><span name='fahrenheite' id='dailytempsixmin'>"+ data["daily"].data[6].apparentTemperatureMin +"</span><span id='dailytempsixsignmin'>&#x2109;</span><br>"+data["daily"].data[6].summary);
		skycons.add(document.getElementById("icon7"), data["daily"].data[6].icon);
		
		////////////////////////////////////////////////////////////////////////If you want to remove button comment out the line bellow 		 
		$("#nextdaydetails6").append("<br><button name='6' class='btn btn-primary moredaydetails'>MORE DETAILS</button>");
		
		skycons.play();
		
      }, //End success
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
        
		var myString = $("#visibility").attr("miles");//Remove temperature sign
	    myString *= 1.609344;
	    $("#visibility").html("&nbsp"+Math.round(myString)+" km&nbsp");
		
	    var myString = $("#windSpeed").attr("speed");//Remove temperature sign
		myString *= 0.44704;
	    myString = Math.round(myString);
	    $("#windSpeed").text(myString +" m/s");
	    $("#windSpeed").attr("name","m/s");
        $("#windSpeed").html("&nbsp"+myString+" m/s&nbsp");
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
	 }
	 //Convert to mph
	 if(this.id == "˚C, mph"){
		
	  $("#visibility").html("&nbsp"+$("#visibility").attr("miles")+" mi&nbsp");
	  $("#windSpeed").html("&nbsp"+$("#windSpeed").attr("speed")+" mph&nbsp")
	  $("#windSpeed").attr("name","mph");
	  
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
		
		$("#dailytemptwomax").attr("name", "fahrenheite");
		$("#dailytemptwomax").html(convertCentergrade($("#dailytemptwomax").text()));
	    $("#dailytemptwosignmax").html("&deg;");
		$("#dailytemptwomin").attr("name", "fahrenheite");
		$("#dailytemptwomin").html(convertCentergrade($("#dailytemptwomin").text()));
	    $("#dailytemptwosignmin").html("&deg;");
		
		$("#dailytempthreemax").attr("name", "fahrenheite");
		$("#dailytempthreemax").html(convertCentergrade($("#dailytempthreemax").text()));
	    $("#dailytempthreesignmax").html("&deg;");
		$("#dailytempthreemin").attr("name", "fahrenheite");
		$("#dailytempthreemin").html(convertCentergrade($("#dailytempthreemin").text()));
	    $("#dailytempthreesignmin").html("&deg;");

		$("#dailytempfourmax").attr("name", "fahrenheite");
		$("#dailytempfourmax").html(convertCentergrade($("#dailytempfourmax").text()));
	    $("#dailytempfoursignmax").html("&deg;");
		$("#dailytempfourmin").attr("name", "fahrenheite");
		$("#dailytempfourmin").html(convertCentergrade($("#dailytempfourmin").text()));
	    $("#dailytempfoursignmin").html("&deg;");
		
		$("#dailytempfivemax").attr("name", "fahrenheite");
		$("#dailytempfivemax").html(convertCentergrade($("#dailytempfivemax").text()));
	    $("#dailytempfivesignmax").html("&deg;");
		$("#dailytempfivemin").attr("name", "fahrenheite");
		$("#dailytempfivemin").html(convertCentergrade($("#dailytempfivemin").text()));
	    $("#dailytempfivesignmin").html("&deg;");
		
		$("#dailytempsixmax").attr("name", "fahrenheite");
		$("#dailytempsixmax").html(convertCentergrade($("#dailytempsixmax").text()));
	    $("#dailytempsixsignmax").html("&deg;");
		$("#dailytempsixmin").attr("name", "fahrenheite");
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
  //Load page with more details on the weather when the user presses the buttons for the next 6 days
  $(document).on("click", ".moredaydetails", function(){

	  window.location.href = "timemachines.php?lat="+$("#locatebutton").attr("lat")+"&lng="+$("#locatebutton").attr("lng")+"&day="+this.name;
  
  });

  
</script>
 
</body>
</html>
    