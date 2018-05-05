function httpGet(url)
{
	return new Promise(resolve,reject)=>
	{
		var xhr2 = new XMLHttpRequest();
		xhr2.open('GET', url);
		xhr2.addEventListener("load", (e)=>
		{
			if(e.target.status>=400 & e.target.status<=599)
			{
				reject(e.target.status);
			}
			else
			{
				resolve(e.target);
			}
		});
		xhr2.send();
	});
}

function parseJson(xmlHTTP)
{
	return new Promise((resolve, reject) =>
	{
		var parseData = JSON.parse(xmlHTTP.responseText);
		if(parsedData.length==0)
		{
			reject("No matching results!");
		}
		else
		{
			resolve(parsedData);
		}
	}
	);
}

function showJsonResults(data)
{
	var html = "";
	for (var i=0; i<data.length; i++)
	{
		html = html + `Artist: ${data[i].artist} Song: ${data[i].title} <br />`;
	}
	document.getElementById("results").innerHTML = html;
}

function search()
{
	httpGet('~oldfieldj/wad/search2.php').then(parseJson).then(showJsonResults).catch(handleError);
}