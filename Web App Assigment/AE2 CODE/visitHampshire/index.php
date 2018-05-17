<!DOCTYPE html>
<html>
    <head>
        <title>VisitHampshire</title>
        <script type="text/javascript" src="main.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="wrapper">
            <header><h1>Visit Hampshire!</h1></header>
            <section id="form-container">
                <form action="searchResults.php" method="GET">
                    <p>Accommodation Search</p>
                    <select id="accType" name="type">
                        <option disabled selected>Please Select</option>
                        <option value="B&B">B&amp;B</option>
                        <option value="Campsite">Campsite</option>
                        <option value="Hotel">Hotel</option>
                        <option value="Pub">Pub</option>
                    </select><br/>
                    <span>Select a type from the drop down!</span><br/>
                    <input type="submit" value="SEARCH" id="searchBtn">
                </form>
            </section>
        </div>
    </body>
</html>