/* function ajaxRequest()
{
    var xhr2 = new XMLHttpRequest();
    
    xhr2.addEventListener ("load",  (e) =>
    {
        var data = JSON.parse(e.target.responseText);
        for(var i=0; i<data.length; i++) 
        {
            var parent = document.getElementById("results");
            var p = document.createElement("p");
            parent.appendChild(p);
            
            var textNode = document.createTextNode("Song Title: " + data[i].title + " " + "Artist: " + data[i].artist + " ");
            var button = document.createElement("INPUT");
            button.type = "button";
            button.value = "DOWNLOAD";
            button.id = "button" + data[i].songid;
            
            button.addEventListener("click", (e) =>
            {
				var songid = e.target.id.substring(6);
				console.log("Song ID: " + songid);
				
				var xhr2 = new XMLHttpRequest();
				var data = new FormData();
				data.append("id", songid);
				xhr2.addEventListener("load", responseReceived);
				xhr2.open("POST", "http://edward2.solent.ac.uk/~oldfieldj/wad/session4download.php");
				xhr2.send(data);
            });
            
            p.appendChild(textNode);
            p.appendChild(button);
        } 
    });
    
    var a = document.getElementById("artist").value;

    xhr2.open("GET" , "/~oldfieldj/wad/search2.php?artist=" + a);
    xhr2.send();
}

function responseReceived(e)
{
	var response = e.target.responseText;
	
	if(response == "SONG_PURCHASED")
	{
		var parent = document.getElementById("wrapper");
		var dialog = document.createElement("div");
		parent.appendChild(dialog);
		
		dialog.style.position="absolute";
		dialog.style.left="100px";
		dialog.style.top="100px";
		dialog.style.backgroundColor="green";
		dialog.style.padding = "30px";
		dialog.style.border = "2px solid black";
		
		var textNode = document.createTextNode("SONG PURCHASED SUCCESSFULLY ");
		var button = document.createElement("INPUT");
            button.type = "button";
            button.value = "OK";
		
		button.addEventListener("click", (e) =>
            {
				dialog.style.display = "none";
            });
            
            dialog.appendChild(textNode);
            dialog.appendChild(button);
		
	}
	else if(response == "INSUFFICIENT_FUNDS")
	{
		var parent = document.getElementById("wrapper");
		var dialog = document.createElement("div");
		parent.appendChild(dialog);
		
		dialog.style.position="absolute";
		dialog.style.left="100px";
		dialog.style.top="100px";
		dialog.style.backgroundColor="red";
		dialog.style.padding = "30px";
		dialog.style.border = "2px solid black";
		
		var textNode = document.createTextNode("INSUFFICENT FUNDS ");
		var button = document.createElement("INPUT");
            button.type = "button";
            button.value = "OK";
		
		button.addEventListener("click", (e) =>
            {
				dialog.style.display = "none";
            });
            
            dialog.appendChild(textNode);
            dialog.appendChild(button);
		
	}
} */

var map;
function allMarkers()
{
	var xhr2 = new XMLHttpRequest();
		
		xhr2.addEventListener ("load",  (e) =>
		{
			var data = JSON.parse(e.target.responseText);
			map = L.map ("map1");
			map.setView([55,-1], 3);
			
			for(i=0; i<data.length;i++)
			{
				var lat = data[i].lat;
				var lon = data[i].lon;
				

				var attrib = "Map data copyright OpenStreetMap contributors, Open Database Licence";

				L.tileLayer
					("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
						{ attribution: attrib } ).addTo(map);
				
				//coords
				var pos = [lat, lon];
				
				//MARKER 
				var marker = L.marker(pos).addTo(map);
				
				marker.bindPopup(data[i].name + ", " + data[i].hometown);
			}

		});
		
		xhr2.open("GET" , "http://edward2.solent.ac.uk/wad/artists.php?");
		xhr2.send();
}
function whereFrom()
{
	var a = document.getElementById("artist").value;
	
	if(a == "")
	{
		var xhr2 = new XMLHttpRequest();
		
		xhr2.addEventListener ("load",  (e) =>
		{
			var data = JSON.parse(e.target.responseText);
			map = L.map ("map1");
			map.setView([55,-1], 2);
			
			for(i=0; i<data.length;i++)
			{
				var lat = data[i].lat;
				var lon = data[i].lon;
				

				var attrib = "Map data copyright OpenStreetMap contributors, Open Database Licence";

				L.tileLayer
					("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
						{ attribution: attrib } ).addTo(map);
				
				//coords
				var pos = [lat, lon];
				
				//MARKER 
				var marker = L.marker(pos).addTo(map);
				
				marker.bindPopup(data[i].name + ", " + data[i].hometown);
			}

		});
		
		xhr2.open("GET" , "http://edward2.solent.ac.uk/wad/artists.php?");
		xhr2.send();
	}
	else
	{
		var xhr2 = new XMLHttpRequest();
		
		xhr2.addEventListener ("load",  (e) =>
		{
			var data = JSON.parse(e.target.responseText);
			var lat = data.lat;
			var lon = data.lon;
			
			map = L.map ("map1");

			var attrib = "Map data copyright OpenStreetMap contributors, Open Database Licence";

			L.tileLayer
				("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
					{ attribution: attrib } ).addTo(map);
			
			//coords
			var pos = [lat, lon];
					
			map.setView(pos, 12);
			
			//MARKER 
			var marker = L.marker(pos).addTo(map);
			
			marker.bindPopup(data.hometown);
			

		});
			xhr2.open("GET" , "http://edward2.solent.ac.uk/wad/artists.php?artist=" + a);
			xhr2.send();

	}
	
	
}