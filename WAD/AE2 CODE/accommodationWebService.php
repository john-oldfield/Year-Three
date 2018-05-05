<?php
    header("Content-type: application/json");

    //CLIENT LOCATION
    $location = $_GET["location"];
    //CLIENT TYPE
    $type = $_GET["type"];

    //CONNECT TO DATABASE
    $conn = new PDO("mysql:host=localhost;dbname=oldfieldj;", "oldfieldj", "eroshoxe");

    if(isset($location, $type))
    {
        //SEARCH DATABASE
        $result = $conn->query("SELECT * 
                                FROM accommodation
                                WHERE location='$location'
                                AND type='$type'");
        //FETCH ALL MATCHING ROWS INTO AN ARRAY
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        
        if($rows == false)
        {
            echo "NO_RESULTS_FOUND";
        }
        else
        {
            echo json_encode($rows);  
        }  
    }
    else if(isset($location) && !$location == "")
    {
        //SEARCH DATABASE
        $result = $conn->query("SELECT * 
                                FROM accommodation
                                WHERE location='$location'");
        
        //FETCH ALL MATCHING ROWS INTO AN ARRAY
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        if($rows == false)
        {
            echo "NO_RESULTS_FOUND";
        }
        else
        {
            echo json_encode($rows);  
        }  
    }
    else if(isset($type) && !$type == "")
    {
        //SEARCH DATABASE
        $result = $conn->query("SELECT * 
                                FROM accommodation
                                WHERE type='$type'");
        
        //FETCH ALL MATCHING ROWS INTO AN ARRAY
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        if($rows == false)
        {
            echo "NO_RESULTS_FOUND";
        }
        else
        {
            echo json_encode($rows);  
        }  
    }  
    else
    {
        echo "SEARCH_NOT_SPECIFIED"; //ERROR MESSAGE IF NO QUERY STRINGS PROVIDED
    }
?>