function init()
{
    //FOR THE SEARCH FUNCTIONALITY and avoiding unobtrusive javascript
    document.getElementById("searchBtn").addEventListener("click", search);    
}

function search()
{
    //clear past messages
    document.getElementById("booking-results").innerHTML = "";
    
    var xhr2 = new XMLHttpRequest();
    xhr2.addEventListener("load", e =>
    {
        //if no search term
        if (e.target.responseText == "SEARCH_NOT_SPECIFIED")
        {
            //remove previous correct responses
            document.getElementById("response").innerHTML = "";
            //display error message
            document.getElementById("error").innerHTML = "Please enter a location.";
        }
        else
        {
            //if no results for given place
            if(e.target.responseText == "NO_RESULTS_FOUND")
            {
                //display error
                document.getElementById("error").innerHTML = "No results found.";
                //remove previous working responses
                document.getElementById("response").innerHTML = "";
            }
            else
            {   
                //clear any previous errors
                document.getElementById("error").innerHTML = "";
                var data = JSON.parse(e.target.responseText);
                //Create empty results
                var results = "";
                for(var i = 0; i<data.length; i++)
                {
                    //fill results with places
                    results = results + `${data[i].name} | Type: ${data[i].type} | Location: ${data[i].location} | Description: ${data[i].description} <br/><br/>`;    
                }
                //show places on page
                document.getElementById("response").innerHTML = results;
            }
        }
    });
    
    //location value from input box
    var l = document.getElementById("location").value;
    
    xhr2.open("GET", "/~oldfieldj/accommodationWebService.php?location=" + l);
    xhr2.send();
}