<?php
    //CLIENT ACCOMMODATION ID
    $accID = $_POST["accID"];
    //CLIENT DATE
    $date = $_POST["date"];
    //CLIENT USERNAME
    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        $user = $_POST['user']; 
        $pass = $_POST['pass'];
    }
    else
    {
        $user = $_SERVER['PHP_AUTH_USER'];
        $pass = $_SERVER['PHP_AUTH_PW'];
    }

    //CLIENT NO. OF PEOPLE
    $people = $_POST["nPeople"];

    $datetime = new DateTime($date);
    $new_date = $datetime->format('ymd');


    if(!isset($accID) || $accID == '') //CHECK IF ACCOMMODATION ID HAS BEEN PROVIDED
    {
        echo "ACCOMMODATION_ID_NOT_PROVIDED";
    }
    else if(!isset($date) || $date == '') //CHECK IF DATE HAS BEEN PROVIDED
    {
        echo "DATE_NOT_PROVIDED";
    }
    else if(!isset($user) || $user == '') //CHECK IF USERNAME HAS BEEN PROVIDED
    {
        echo "USERNAME_NOT_PROVIDED";
    }
    else if(!isset($pass) || $pass == '') //CHECK IF USERNAME HAS BEEN PROVIDED
    {
        echo "PASSWORD_NOT_PROVIDED";
    }
    else if(!isset($people) || $people == '') //CHECK IF NO. OF PEOPLE HAS BEEN PROVIDED
    {
        echo "NUMBER_OF_PEOPLE_NOT_PROVIDED";
    }
    else if($people == 0)
    {
        echo "INVALID_PEOPLE";
    }
    else if(isset($accID, $date, $user, $pass, $people))
    {
        //CONNECT TO DATABASE
        $conn = new PDO("mysql:host=localhost;dbname=oldfieldj;", "oldfieldj", "eroshoxe");
        
        //SEARCH FOR USER IN THE DATABASE
        $exist = $conn->query("SELECT *
                                 FROM acc_users
                                 WHERE username = '$user'
                                 AND password = '$pass'");
        $exists = $exist->fetch();
        if($exists == false)
        {
            echo "INVALID_USER_DETAILS";
        }
        else
        {
            //SEARCH DATABASE FOR CLIENT ACCOMMODATION AND DATE
            $result = $conn->query("SELECT *
                                    FROM acc_dates
                                    WHERE accID = $accID
                                    AND thedate = $new_date"); 
            $row = $result->fetch();
            if($row == false)
            {
                echo "DATE_NOT_AVAILABLE";
            }
            else
            {
                if($row["availability"] - $people >= 0) //CHECK AVAILABILITY AGAINST CLIENT NO. OF PEOPLE AND DATE
                {
                    $conn->query("INSERT INTO acc_bookings(ID, accID, thedate, username, npeople)
                                  VALUES (NULL, $accID, $new_date, '$user', $people)");

                    $conn->query("UPDATE acc_dates
                                  SET availability = availability - $people
                                  WHERE accID = $accID
                                  AND thedate = $new_date");
                    echo "BOOKING_SUCCESSFUL"; // SUCCESS MESSAGE
                }
                else
                {
                    echo "NO_AVAILABLILITY"; //UNSUCCESSFUL MESSAGE
                }
            }
        }
    }
    else
    {
        echo "PARAMETERS_NOT_PROVIDED";
    }
    
?>