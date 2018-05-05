<!DOCTYPE html>

<html>
	<head>
		<title>Search Results!</title>
	</head>
	<body>
		<h1>Search Results!</h1>
		
		<?php
		$a = $_GET["artist"];
		
		$conn = new PDO("mysql:host=localhost;dbname=dftitutorials;","dftitutorials", "dftitutorials");
		
		$result = $conn->query("SELECT * 
								FROM wadsongs 
								WHERE artist = '$a'");
							   
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		
		//print_r($rows);
		
		foreach($rows as $row)
		{
			echo "Artist: ";
			echo $row[artist];
			echo "<br />";
			
			echo "Song: ";
			echo $row[title];
			echo "<br />";
			
			echo "Likes: ";
			echo $row[likes];
			echo "<br />";
		}
		
		?>
	</body>
</html>
