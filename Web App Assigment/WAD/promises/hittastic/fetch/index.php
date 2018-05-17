<!DOCTYPE html>
<html>
    
    <head>
        <title>hittastic</title>
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="fetch.js"></script>
    </head>
    <body>
        <header><h1>HITTASTIC!</h1></header>
        <div id="wrapper">
            <h2>Hitastic Site...</h2>
            <form>
                Artist: <input type="text" name="artist" id="artist" value="oasis">
                <input type="button" value="SEARCH" onclick="ajaxrequest()">
            </form>
            <div id="results"></div>
        </div>
    </body>
</html>