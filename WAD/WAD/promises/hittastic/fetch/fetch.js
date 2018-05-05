function ajaxrequest() 
{
    var a = document.getElementById("artist").value;

    fetch('/~oldfieldj/wad/search2.php?artist=' + a).then(ajaxresponse).then(parseJSON).catch(ajaxerror);
}


function ajaxresponse(response) 
{
    return response.json();
}

function ajaxerror(code) 
{
    alert('error; ' + code);
}

function parseJSON(jsonData) 
{
    var html = "";
    for(var i=0; i<jsonData.length; i++) 
	{
        html = html + `Artist: ${jsonData[i].artist} <br /> Song: ${jsonData[i].title} <br /> <br />`;
    }
    document.getElementById("results").innerHTML = html;
}
