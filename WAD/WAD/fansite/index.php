<!DOCTYPE html>
<html>
    
    <head>
        <title>EMINEM</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header><div id="logo"><img src="logo.png"></div></header>
        <div id="wrapper">
            <div id="content">
                <h2>Biography</h2>
                <p>Born on October 17, 1972, in St. Joseph, Missouri, rap musician Eminem had a turbulent childhood. He released The Slim Shady LP in early 1999, and the album went multi-platinum, garnering Eminem two Grammy Awards and four MTV Video Music Awards. In 2000, the rapper released The Marshall Mathers LP, which was noted as the fastest-selling album in rap history. More recently, in 2010, Eminem released the Grammy-winning album Recovery, a highly autobiographical attempt to come to terms with his struggles with addiction and experience with rehabilitation. Eminem plans to release his eighth album, MMLP2, in 2013.</p>
                <h2>Eminems Number 1s</h2>
				<?php
					
					// Initialise the cURL connection
					$connection = curl_init();

					// Specify the URL to connect to
					curl_setopt($connection, CURLOPT_URL, "http://edward2.solent.ac.uk/~oldfieldj/wad/search2.php?artist=eminem");

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
					echo "<th>Title</th>";
					echo "<th>Artist</th>";
					echo "<th>Year</th>";
					echo "<th>Downloads</th>";
					echo "<th>Download Link</th>";
						for($i=0; $i<count($data); $i++)
						{
							$songid= $data[$i]["songid"];
							
							echo "<tr>";
							echo "<td>" . $data[$i]["title"] . "</td>";
							echo "<td>" . $data[$i]["artist"] . "</td>";
							echo "<td>" . $data[$i]["year"] . "</td>";
							echo "<td>" . $data[$i]["downloads"] . "</td>";
							echo "<td>" . "<a href='http://edward.solent.ac.uk/~oldfieldj/clientdownload.php?id=$songid'>Download</a>" . "</td>";
							echo "</tr>";
						}
					echo "</table>";
				?>
				<h2>Eminems Top Downloads</h2>
				<?php	
					// Initialise the cURL connection
					$connection = curl_init();

					// Specify the URL to connect to
					curl_setopt($connection, CURLOPT_URL, "http://edward2.solent.ac.uk/~oldfieldj/wad/top40webservice.php?artist=eminem");

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
					echo "<th>Title</th>";
					echo "<th>Artist</th>";
					echo "<th>Year</th>";
					echo "<th>Downloads</th>";
					echo "<th>Download Link</th>";
						for($i=0; $i<count($data); $i++)
						{
							$songid= $data[$i]["songid"];
							
							echo "<tr>";
							echo "<td>" . $data[$i]["title"] . "</td>";
							echo "<td>" . $data[$i]["artist"] . "</td>";
							echo "<td>" . $data[$i]["year"] . "</td>";
							echo "<td>" . $data[$i]["downloads"] . "</td>";
							echo "<td>" . "<a href='http://edward.solent.ac.uk/~oldfieldj/clientdownload.php?id=$songid'>Download</a>" . "</td>";
							echo "</tr>";
						}
					echo "</table>";
				?>
				<h1>Top 40 Search</h1>
				<p>Leave Blank for overall top 40</p>
				<form method="get" action="top40.php">
				Artist:<input name="artist" />
				<input type="submit" value="Go!" />
				</form>
            </div>
        </div>
    </body>
</html>