function ajaxRequest()
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
            
            var textNode = document.createTextNode("Song Title: " + data[i].title);
            var button = document.createElement("INPUT");
            button.type = "button";
            button.value = "DOWNLOAD";
            button.id = "button" + data[i].songid;
            
            button.addEventListener("click", (e) =>
            {
                alert("Downloaded");    
            });
            
            p.appendChild(textNode);
            p.appendChild(button);
        } 
    });
    
    var a = document.getElementById("artist").value;

    xhr2.open("GET" , "/~oldfieldj/wad/search2.php?artist=" + a);
    xhr2.send();
}