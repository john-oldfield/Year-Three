//initialise map
var map;

function init()
{
    //FOR THE SEARCH FUNCTIONALITY and avoiding unobtrusive javascript
    document.getElementById("searchBtn").addEventListener("click", search);
    document.getElementById("bookBtn").addEventListener("click", book);
    
    //FOR THE MAP FUNCTIONALITY
    map = L.map("map");
    var attrib="Map data copyright OpenStreetMap contributors, Open Database Licence";
    
    L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {attribution: attrib}).addTo(map);
    
    //set initial map position
    var pos = [50.8966, -1.39];
    map.setView(pos, 14);

}

    /*if(navigator.geolocation) QUESTION 5 COMMENTED OUT AS DOESNT WORK WITHOUT HTTPS
    {
        navigator.geolocation.getCurrentPosition (processPosition, handleError);
    }
    else
    {
        alert("GeoLocation not supported in this browser");
    }*/

/*function processPosition(gpspos)
{
    var info = 'Lat: ' + gpspos.coords.latitude + ' lon: ' + gpspos.coords.longitude;
    document.getElementById('info').innerHTML = info;
    
    var pos = [gpspos.coords.latitude, gpspos.coords.longitude];
    map.setView(pos, 14);
}

function handleError(err)
{
    alert('An error occurred: ' + err.code);
}*/

function search()
{
    //remove any previous messages
    document.getElementById("booking-results").innerHTML = "";
    
    var xhr2 = new XMLHttpRequest();
    xhr2.addEventListener("load", e =>
    {
        //if search not provided
        if (e.target.responseText == "SEARCH_NOT_SPECIFIED")
        {
            //hide any previous messages
            document.getElementById("response").innerHTML = "";
            //show error
            document.getElementById("error").innerHTML = "Please enter a location.";
        }
        else
        {
            //if no places found for given term
            if(e.target.responseText == "NO_RESULTS_FOUND")
            {
                //show error
                document.getElementById("error").innerHTML = "No results found.";
                //hide any previous messages
                document.getElementById("response").innerHTML = "";
            }
            else
            {   
                //hide previous error messages
                document.getElementById("error").innerHTML = "";
                //parse json
                var data = JSON.parse(e.target.responseText);
                var results = "";
                var markerArray = [];
                for(var i = 0; i<data.length; i++)
                {
                    results = results + `${data[i].name} | Type: ${data[i].type} | Location: ${data[i].location} | Description: ${data[i].description} <br/><br/>`;
                    
                    //CODE TO PUT MARKERS ON THE MAP (TASK 6)
                    var pos = [data[i].latitude, data[i].longitude];
                    var marker = L.marker(pos).addTo(map);
                    var accID = data[i].ID;
                    
                    markerArray.push(marker);
                    map.setView(pos);
                    
                    //CREATE P ELEMENT
                    var p = document.createElement("p");
                    //CREATE TEXT FOR P
                    var text = document.createTextNode(`${data[i].name} | Type: ${data[i].type} | Location: ${data[i].location} | `);
                    //APPEND TEXT TO P
                    p.appendChild(text);
                    //CREATE A ELEMENT
                    var l = document.createElement("a");
                    
                    //CREATE ACTUAL TEXT FOR LINK
                    var lText = document.createTextNode("Book ");
                    //MAKE BOOK LINK GO TO FORM
                    l.setAttribute('href', "#booking-form");
                    //GIVE UNIQUE ID TO LINK
                    l.setAttribute('id', 'link' + accID);
                    //ADD TEXT TO LINK
                    l.appendChild(lText);
                    //ADD LISTENER TO SHOW FORM
                    l.addEventListener("click", handleBooking);
                    
                    //CHECK AVAILABILITY FOR Q9
                    var c = document.createElement("a");
                    var cText = document.createTextNode("Check Availbility");
                    c.setAttribute('id', 'acc' + accID);
                    c.setAttribute('href', "#myCanvas"); 
                    c.addEventListener("click", loadCanvas)
                    c.appendChild(cText);
                    //ASSIGN LINK TO P IN MARKER
                    p.appendChild(l);
                    p.appendChild(c);
                    
                    //add pop ups to marker
                    marker.bindPopup(p);
                    
                    //automatic zoom to fit all markers
                    var group = L.featureGroup(markerArray);
                    map.fitBounds(group.getBounds());
                }
                
                //show messages
                document.getElementById("response").innerHTML = results;
            }
        }
    });
    
    //value from input box
    var l = document.getElementById("location").value;
    
    xhr2.open("GET", "/~oldfieldj/accommodationWebService.php?location=" + l);
    xhr2.send();
}

function handleBooking()
{
    //get id from link id
    var ID = this.id.substring(4);
    //show booking form
    document.getElementById("booking-form").style.display = "block";
    //set hidden field value to id
    document.getElementById("hiddenField").value = ID;
}

function book()
{ 
    //get required values from form
    var user = document.getElementById("username").value;
    var pass = document.getElementById("password").value;
    var npeople = document.getElementById("npeople").value;
    var accID = document.getElementById("hiddenField").value;
    var date = document.getElementById("date").value;
    
    var xhr2 = new XMLHttpRequest();
    var data = new FormData();
    data.append("accID", accID);
    data.append("date", date);
    data.append("nPeople", npeople);
    data.append("user", user);
    data.append("pass", pass);
    xhr2.addEventListener("load", responseReceived);
    xhr2.open("POST", "/~oldfieldj/bookAccommodationWebService.php");
    //comment out when not in uni
    //xhr2.setRequestHeader("Authorization","Basic " + btoa(user+":"+pass));
    xhr2.send(data);   
}

//callback from booking form
function responseReceived(e)
{
    //response from web service
    var response = e.target.responseText;
    //get results div
    var results = document.getElementById("booking-results");
    results.style.color = "red";
    
    //error handling
    if(response == "DATE_NOT_PROVIDED")
    {
        results.innerHTML = "Please provide a date.";
    }
    else if(response == "USERNAME_NOT_PROVIDED")
    {
        results.innerHTML = "Please provide a username.";
    }
    else if(response == "PASSWORD_NOT_PROVIDED")
    {
        results.innerHTML = "Please provide a password.";    
    }
    else if(response == "NUMBER_OF_PEOPLE_NOT_PROVIDED")
    {
        results.innerHTML = "Please provide a number of people to book for.";    
    }
    else if(response == "INVALID_PEOPLE")
    {
        results.innerHTML = "Number of people cannot be 0.";    
    }
    else if(response == "DATE_NOT_AVAILABLE")
    {
        results.innerHTML = "Accommodation not available on that date.";    
    }
    else if(response == "NO_AVAILABLILITY")
    {
        results.innerHTML = "Not enough rooms available at that accommodation.";    
    }
    else if(response == "BOOKING_SUCCESSFUL")
    {
        results.innerHTML = "Your booking has been confirmed!";
        document.getElementById("booking-form").style.display = "none";
        results.style.color = "green";  
    }
    else
    {
        results.innerHTML = response;
    } 
}

function loadCanvas()
{
    //show canvas
    document.getElementById("canvas-container").style.display = "block";
    //hide previous messages
    document.getElementById("canvas-message").style.display = "none";
    //get id from check availability link
    var ID = this.id.substring(3);
    //get canvas element
    var canvas = document.getElementById("myCanvas");
    //add event listener to avoid unobstrusive javascript
    canvas.addEventListener("mousedown", mouseDownHandler);
    //add ID to hidden field
    document.getElementById("canvasAccID").value = ID;
    
    var ctx = canvas.getContext('2d');
    
    //Title
    ctx.fillStyle="black";
    ctx.font = '16pt Helvetica';
    
    //DO AJAX FOR EACH CORRESPONDING DATE ON CALENDAR
    var xhr2 = new XMLHttpRequest();
    xhr2.addEventListener("load", e =>
    {
        var av = e.target.responseText;
        
        //COLOR CODE SQUARE DEPENDING ON AVAILABILITY
        if(av == "DATE_NOT_AVAILABLE")
        {
            ctx.fillStyle = "GREY";
        }
        else if(av == "AVAILABLE")
        {
            ctx.fillStyle = "green";
        }
        else
        {
            ctx.fillStyle = "RED";
        }
        
        ctx.fillRect(10, 10, 50,50);
        ctx.fillStyle = "white";
        //SHOW DATE AS TEXT
        ctx.fillText("1", 30, 45);
        
    });
    xhr2.open("GET", "/~oldfieldj/availWebService.php?accID=" + ID + "&date=" + 180401);
    xhr2.send();
    
    var xhr2 = new XMLHttpRequest();
    xhr2.addEventListener("load", e =>
    {
        var av = e.target.responseText;
        
        //2nd April
        if(av == "DATE_NOT_AVAILABLE")
        {
            ctx.fillStyle = "GREY";
        }
        else if(av == "AVAILABLE")
        {
            ctx.fillStyle = "green";
        }
        else
        {
            ctx.fillStyle = "RED";
        }
        
        ctx.fillRect(70, 10, 50,50);
        ctx.fillStyle = "white";
        ctx.fillText("2", 90, 45);
        
    });
    xhr2.open("GET", "/~oldfieldj/availWebService.php?accID=" + ID + "&date=" + 180402);
    xhr2.send();   
    
    var xhr2 = new XMLHttpRequest();
    xhr2.addEventListener("load", e =>
    {
        var av = e.target.responseText;
        
        //3rd April
        if(av == "DATE_NOT_AVAILABLE")
        {
            ctx.fillStyle = "GREY";
        }
        else if(av == "AVAILABLE")
        {
            ctx.fillStyle = "green";
        }
        else
        {
            ctx.fillStyle = "RED";
        }
        
        ctx.fillRect(130, 10, 50,50);
        ctx.fillStyle = "white";
        ctx.fillText("3", 150, 45);
        
    });
    xhr2.open("GET", "/~oldfieldj/availWebService.php?accID=" + ID + "&date=" + 180403);
    xhr2.send();
    
    var xhr2 = new XMLHttpRequest();
    xhr2.addEventListener("load", e =>
    {
        var av = e.target.responseText;
        
        //4th April
        if(av == "DATE_NOT_AVAILABLE")
        {
            ctx.fillStyle = "GREY";
        }
        else if(av == "AVAILABLE")
        {
            ctx.fillStyle = "green";
        }
        else
        {
            ctx.fillStyle = "RED";
        }
        
        ctx.fillRect(190, 10, 50,50);
        ctx.fillStyle = "white";
        ctx.fillText("4", 210, 45);
        
    });
    xhr2.open("GET", "/~oldfieldj/availWebService.php?accID=" + ID + "&date=" + 180404);
    xhr2.send();
    
    var xhr2 = new XMLHttpRequest();
    xhr2.addEventListener("load", e =>
    {
        var av = e.target.responseText;
        
        //5th
        if(av == "DATE_NOT_AVAILABLE")
        {
            ctx.fillStyle = "GREY";
        }
        else if(av == "AVAILABLE")
        {
            ctx.fillStyle = "green";
        }
        else
        {
            ctx.fillStyle = "RED";
        }
        
        ctx.fillRect(250, 10, 50,50);
        ctx.fillStyle = "white";
        ctx.fillText("5", 270, 45);
        
    });
    xhr2.open("GET", "/~oldfieldj/availWebService.php?accID=" + ID + "&date=" + 180405);
    xhr2.send();
}

//handle date square being clicked
function mouseDownHandler(e)
{
    //get required variables
    var canvas = document.getElementById("myCanvas");
    var msg = document.getElementById("canvas-message");
    var cc = document.getElementById("canvas-container");
    var ID = document.getElementById("canvasAccID").value;
    
    //get relative mouseclick
    var X = (e.pageX - canvas.offsetLeft);
    var Y = (e.pageY - canvas.offsetTop);
    
    //Do appropiate booking based on square being clicked
    if(X >= 10 && X <= 60 && Y >= 10 && Y <= 60)
    {
        //auto fill in username and pass as was not a requirement in brief
        var xhr2 = new XMLHttpRequest();
        var data = new FormData();
        data.append("accID", ID);
        data.append("date", "04/01/2018");
        data.append("nPeople", 1);
        data.append("user", "kate");
        data.append("pass", "kate123");
        xhr2.addEventListener("load", e =>
        {
            var response = e.target.responseText;
            
            //error handling
            if(response == "DATE_NOT_AVAILABLE")
            {
                msg.style.color = "red";
                msg.style.display = "block";
                msg.innerHTML = "This accommodation is unavailable on this day."; 
            }
            else if(response == "BOOKING_SUCCESSFUL")
            {
                msg.style.color = "green";
                msg.style.display = "block";
                msg.innerHTML = "Your booking has been confirmed.";
                cc.style.display = "none";   
            }
            else if(response == "NO_AVAILABLILITY")
            {
                msg.style.color = "red";
                msg.style.display = "block";
                msg.innerHTML = "This accommodation is fully booked on this day."; 
            }
        });
        xhr2.open("POST", "/~oldfieldj/bookAccommodationWebService.php");
        xhr2.send(data);
    }
    else if(X >= 70 && X <= 120 && Y >= 10 && Y <= 60)
    {
        var xhr2 = new XMLHttpRequest();
        var data = new FormData();
        data.append("accID", ID);
        data.append("date", "04/02/2018");
        data.append("nPeople", 1);
        data.append("user", "kate");
        data.append("pass", "kate123");
        xhr2.addEventListener("load", e =>
        {
            var response = e.target.responseText;
            
            if(response == "DATE_NOT_AVAILABLE")
            {
                msg.style.color = "red";
                msg.style.display = "block";
                msg.innerHTML = "This accommodation is unavailable on this day."; 
            }
            else if(response == "BOOKING_SUCCESSFUL")
            {
                msg.style.color = "green";
                msg.style.display = "block";
                msg.innerHTML = "Your booking has been confirmed.";
                cc.style.display = "none";   
            }
            else if(response == "NO_AVAILABLILITY")
            {
                msg.style.color = "red";
                msg.style.display = "block";
                msg.innerHTML = "This accommodation is fully booked on this day."; 
            }
        });
        xhr2.open("POST", "/~oldfieldj/bookAccommodationWebService.php");
        xhr2.send(data);
    }
    else if(X >= 130 && X <= 180 && Y >= 10 && Y <= 60)
    {
        var xhr2 = new XMLHttpRequest();
        var data = new FormData();
        data.append("accID", ID);
        data.append("date", "04/03/2018");
        data.append("nPeople", 1);
        data.append("user", "kate");
        data.append("pass", "kate123");
        xhr2.addEventListener("load", e =>
        {
            var response = e.target.responseText;
            
            if(response == "DATE_NOT_AVAILABLE")
            {
                msg.style.color = "red";
                msg.style.display = "block";
                msg.innerHTML = "This accommodation is unavailable on this day."; 
            }
            else if(response == "BOOKING_SUCCESSFUL")
            {
                msg.style.color = "green";
                msg.style.display = "block";
                msg.innerHTML = "Your booking has been confirmed.";
                cc.style.display = "none";   
            }
            else if(response == "NO_AVAILABLILITY")
            {
                msg.style.color = "red";
                msg.style.display = "block";
                msg.innerHTML = "This accommodation is fully booked on this day."; 
            }
        });
        xhr2.open("POST", "/~oldfieldj/bookAccommodationWebService.php");
        xhr2.send(data);
    }
    else if(X >= 190 && X <= 240 && Y >= 10 && Y <= 60)
    {
        var xhr2 = new XMLHttpRequest();
        var data = new FormData();
        data.append("accID", ID);
        data.append("date", "04/04/2018");
        data.append("nPeople", 1);
        data.append("user", "kate");
        data.append("pass", "kate123");
        xhr2.addEventListener("load", e =>
        {
            var response = e.target.responseText;
            
            if(response == "DATE_NOT_AVAILABLE")
            {
                msg.style.color = "red";
                msg.style.display = "block";
                msg.innerHTML = "This accommodation is unavailable on this day."; 
            }
            else if(response == "BOOKING_SUCCESSFUL")
            {
                msg.style.color = "green";
                msg.style.display = "block";
                msg.innerHTML = "Your booking has been confirmed.";
                cc.style.display = "none";   
            }
            else if(response == "NO_AVAILABLILITY")
            {
                msg.style.color = "red";
                msg.style.display = "block";
                msg.innerHTML = "This accommodation is fully booked on this day."; 
            }
        });
        xhr2.open("POST", "/~oldfieldj/bookAccommodationWebService.php");
        xhr2.send(data);
    }
    else if(X >= 250 && X <= 300 && Y >= 10 && Y <= 60)
    {
        var xhr2 = new XMLHttpRequest();
        var data = new FormData();
        data.append("accID", ID);
        data.append("date", "04/05/2018");
        data.append("nPeople", 1);
        data.append("user", "kate");
        data.append("pass", "kate123");
        xhr2.addEventListener("load", e =>
        {
           var response = e.target.responseText;
            
            if(response == "DATE_NOT_AVAILABLE")
            {
                msg.style.color = "red";
                msg.style.display = "block";
                msg.innerHTML = "This accommodation is unavailable on this day."; 
            }
            else if(response == "BOOKING_SUCCESSFUL")
            {
                msg.style.color = "green";
                msg.style.display = "block";
                msg.innerHTML = "Your booking has been confirmed.";
                cc.style.display = "none";   
            }
            else if(response == "NO_AVAILABLILITY")
            {
                msg.style.color = "red";
                msg.style.display = "block";
                msg.innerHTML = "This accommodation is fully booked on this day."; 
            }
        });
        xhr2.open("POST", "/~oldfieldj/bookAccommodationWebService.php");
        xhr2.send(data);
    }
}