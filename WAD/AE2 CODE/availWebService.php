<?php 
    //CLIENT ACCOMMODATION ID
    $accID = $_GET["accID"];
    $date = $_GET["date"];
    
    //CONNECT TO DATABASE
    $conn = new PDO("mysql:host=localhost;dbname=oldfieldj;", "oldfieldj", "eroshoxe");
    
    if(!isset($accID) || $accID == '') //CHECK IF ACCOMMODATION ID HAS BEEN PROVIDED
    {
        echo "ACCOMMODATION_ID_NOT_PROVIDED";
    }
    else if(!isset($date) || $date == '') //CHECK IF DATE HAS BEEN PROVIDED
    {
        echo "DATE_NOT_PROVIDED";
    }
    else
    {
        //SEARCH DATABASE FOR CLIENT ACCOMMODATION AND DATE
        $result = $conn->query("SELECT *
                                FROM acc_dates
                                WHERE accID = $accID
                                AND thedate = $date"); 
        $row = $result->fetch();
        if($row == false)
        {
            echo "DATE_NOT_AVAILABLE";
        }
        else
        {
            if($row["availability"] == 0) 
            {
                echo "FULLY_BOOKED";
            }
            else
            {
                echo "AVAILABLE"; //UNSUCCESSFUL MESSAGE
            }
        }
    }
?>