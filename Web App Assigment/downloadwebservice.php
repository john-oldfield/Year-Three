<?php

	$a = $_POST["id"];
	$user = $_SERVER["PHP_AUTH_USER"];
	$pass = $_SERVER["PHP_AUTH_PW"];
	
	$conn = new PDO("mysql:host=localhost;dbname=dftitutorials;","dftitutorials", "dftitutorials");
	
	$result = $conn->query("SELECT * FROM ht_users WHERE username ='$user' AND password = '$pass'");
	$row = $result->fetch();
	
	if(!isset($_POST["id"]))
	{
		header("HTTP/1.1 400 Bad Request");
	}
	else
	{
		if($row == false)
		{
			header("HTTP/1.1 401 Unauthorized");
		}
		else
		{
			if($row["balance"] >= 0.79)
			{
				// .. increase the number of downloads ..
				$conn->query("UPDATE wadsongs
							  SET downloads = downloads + 1
							  WHERE songid = $a");
							  
				$conn->query("UPDATE ht_users
							  SET balance = balance - 0.79
							  WHERE username = 'EdwardWilson'");
							  
				header("HTTP/1.1 200 OK");
				//echo "SONG_PURCHASED";
			}
			else
			{
				header("HTTP/1.1 402 Payment Required");
				//echo "INSUFFICIENT_FUNDS";
			}
		}
	}

?>