<!DOCTYPE html>
<html>
    
    <head>
        <title>EMINEM</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
			<h1>Top 40</h1>
<?php

	$a = $_GET["artist"];
	// Initialise the cURL connection
	$connection = curl_init();

	// Specify the URL to connect to
	curl_setopt($connection, CURLOPT_URL, "http://edward2.solent.ac.uk/~oldfieldj/wad/top40webservice.php?artist=$a");

	// This option ensures that the HTTP response is *returned* from curl_exec(),
	// (see below) rather than being output to screen.  
	curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);

	// Do not include the HTTP header in the response.
	curl_setopt($connection,CURLOPT_HEADER, 0);

	// Actually connect to the remote URL. The response is 
	// returned from curl_exec() and placed in $response.
	$response = curl_exec($connection);

	// Close the connection.
	curl_close($connection);
	
	$data = json_decode($response, true);
	echo "<table>";
	echo "<th>Rank</th>";
	echo "<th>Title</th>";
	echo "<th>Artist</th>";
	echo "<th>Year</th>";
	echo "<th>Downloads</th>";
	echo "<th>Download Link</th>";
		for($i=0; $i<count($data); $i++)
		{
			$songid= $data[$i]["songid"];
			
			echo "<tr>";
			echo "<td>" . ($i + 1) . "</td>";
			echo "<td>" . $data[$i]["title"] . "</td>";
			echo "<td>" . $data[$i]["artist"] . "</td>";
			echo "<td>" . $data[$i]["year"] . "</td>";
			echo "<td>" . $data[$i]["downloads"] . "</td>";
			echo "<td>" . "<a href='http://edward.solent.ac.uk/~oldfieldj/clientdownload.php?id=$songid'>Download</a>" . "</td>";
			echo "</tr>";
		}
	echo "</table>";
?>

		</div>
		</div>
	</body>
</html>