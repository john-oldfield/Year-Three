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
            <div id="content">
            <?php
                //Variables
                $accID = $_POST["accID"];
                $username = $_POST["username"];
                $password = $_POST["password"];
                $nPeople = $_POST["nPeople"];
                $date = $_POST["date"];

                //curl request
                $connection = curl_init();
                curl_setopt($connection, CURLOPT_URL, "http://edward2.solent.ac.uk/~oldfieldj/bookAccommodationWebService.php");
                $dataToPost = array
                    ("accID" => $accID ,
                     "nPeople" => $nPeople,
                     "date" => $date);
                curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($connection,CURLOPT_USERPWD,"$username:$password");
                curl_setopt($connection,CURLOPT_POSTFIELDS,$dataToPost);
                curl_setopt($connection, CURLOPT_HEADER,0);
                $response = curl_exec($connection);
                curl_close($connection);

                //error handling
                if($response == "DATE_NOT_PROVIDED")
                {
                    echo "Please provide a date. <a href='bookingForm.php'>Back</a>";
                }
                else if($response == "USERNAME_NOT_PROVIDED")
                {
                    echo "Please provide a username. <a href='bookingForm.php'>Back</a>";
                }
                else if($response == "PASSWORD_NOT_PROVIDED")
                {
                    echo "Please provide a password. <a href='bookingForm.php'>Back</a>";    
                }
                else if($response == "NUMBER_OF_PEOPLE_NOT_PROVIDED")
                {
                    echo "Please provide a number of people to book for. <a href='bookingForm.php'>Back</a>";    
                }
                else if($response == "INVALID_PEOPLE")
                {
                    echo "Number of people cannot be 0. <a href='bookingForm.php'>Back</a>";    
                }
                else if($response == "DATE_NOT_AVAILABLE")
                {
                    echo "Accommodation not available on that date. <a href='bookingForm.php'>Back</a>";    
                }
                else if($response == "NO_AVAILABLILITY")
                {
                    echo "Not enough rooms available at that accommodation. <a href='bookingForm.php'>Back</a>";    
                }
                else if($response == "BOOKING_SUCCESSFUL")
                {
                    echo "Your booking has been confirmed! <a href='index.php'>Back</a>";
                }
                else
                {
                    //shouldnt come up but incase show response
                    echo $response;
                } 
            ?>
                </div>
        </div>
    </body>
</html>