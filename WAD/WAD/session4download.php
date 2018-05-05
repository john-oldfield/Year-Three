<?php

	$a = $_POST["id"];
	
	$conn = new PDO("mysql:host=localhost;dbname=dftitutorials;","dftitutorials", "dftitutorials");
	
	$result = $conn->query("SELECT * FROM ht_users WHERE username ='EdwardWilson'");
	$row = $result->fetch();
	
	if($row["balance"] >= 0.79)
	{
		// .. increase the number of downloads ..
		$conn->query("UPDATE wadsongs
					  SET downloads = downloads + 1
					  WHERE songid = $a");
					  
		$conn->query("UPDATE ht_users
					  SET balance = balance - 0.79
					  WHERE username = 'EdwardWilson'");
		
		echo "SONG_PURCHASED";
	}
	else
	{
		echo "INSUFFICIENT_FUNDS";
	}

?>