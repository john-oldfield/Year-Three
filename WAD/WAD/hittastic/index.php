<!DOCTYPE html>
<html>
    
    <head>
        <title>hittastic</title>
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="main.js"></script>
    </head>
    <body>
        <header><h1>HITTASTIC!</h1></header>
        <div id="wrapper">
            <h2>Hitastic Site...</h2>
            <form>
                Artist: <input type="text" name="artist" id="artist">
                <input type="button" value="SEARCH" onclick="ajaxRequest();">
            </form>
            <div id="results"></div>
        </div>
    </body>
</html>