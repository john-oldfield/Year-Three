<!DOCTYPE html>
<html>
    
    <head>
        <title>hittastic</title>
        <link rel="stylesheet" href="style.css">
		<link rel='stylesheet' type='text/css' href='http://www.free-map.org.uk/osmuk/jslib/leaflet.css' />
        <script type="text/javascript" src="main.js"></script>
		<script type='text/javascript' src='http://www.free-map.org.uk/osmuk/jslib/leaflet.js'></script>
		
    </head>
    <body>
        <header><h1>HITTASTIC!</h1></header>
        <div id="wrapper">
            <h2>Artists on the Map</h2>
            <form>
                Artist: <input type="text" name="artist" id="artist"><br/>
                <input type="button" value="SEARCH" onclick="ajaxRequest();">
                <input type="button" value="WHERE THEY FROM?" onclick="whereFrom()">
                <input type="button" value="ARTISTS ON THE MAP" onclick="allMarkers()">
            </form>
            <div id="results"></div>
			<div id="map-container">
				<div id="map1" style="width:800px; height:600px"></div>
			</div>
        </div>
    </body>
</html>