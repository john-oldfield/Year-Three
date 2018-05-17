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
            <section id="searchResults">
            <?php
                //get type from previous page
                $type = $_GET["type"];

                //curl request
                $connection = curl_init();
                curl_setopt($connection, CURLOPT_URL, 
                        "http://edward2.solent.ac.uk/~oldfieldj/accommodationWebService.php?type=$type&location=hampshire");
                curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($connection, CURLOPT_HEADER,0);

                $response = curl_exec($connection);
                curl_close($connection);
                
                //if no results found for search term
                if($response == "NO_RESULTS_FOUND")
                {
                    echo "No Results Found.";
                    echo "<br/><a href='index.php'>Home</a>";
                }
                else
                {
                    //display results
                    $data = json_decode($response, true);
                        echo "<table>";
                        echo "<th>Name</th>";
                        echo "<th>Location</th>";
                        echo "<th>Description</th>";
                        echo "<th>Latitude</th>";
                        echo "<th>Longitude</th>";
                        echo "<th>Download Link</th>";
                            for($i=0; $i<count($data); $i++)
                            {
                                $accID= $data[$i]["ID"];

                                echo "<tr>";
                                echo "<td>" . $data[$i]["name"] . "</td>";
                                echo "<td>" . $data[$i]["location"] . "</td>";
                                echo "<td>" . $data[$i]["description"] . "</td>";
                                echo "<td>" . $data[$i]["latitude"] . "</td>";
                                echo "<td>" . $data[$i]["longitude"] . "</td>";
                                echo "<td>" . "<a href='bookingForm.php?accID=$accID'>Book</a>" . "</td>";
                                echo "</tr>";
                            }
                        echo "</table>";
                }
            ?>
            </section>
        </div>
    </body>
</html>