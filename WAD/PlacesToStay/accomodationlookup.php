<!--TASK 1-->
<?php
    
    //Decides whether to search by location or type.
    $option = $_GET["option"];
    //GET USER INPUT
    $value = $_GET["value"];

	/*** mysql hostname ***/
    $hostname = 'localhost';
    /*** mysql username ***/
    $username = 'oldfieldj';
    /*** mysql password ***/
    $password = 'eroshoxe';

    $conn = new PDO("mysql:host=$hostname;dbname=oldfieldj", $username, $password);

    if(isset($_GET["value"]) || $_GET["value"] == '')
    {
        if(isset($_GET["option"]) && ($option == "location") )
        {
            $result = $conn->query("SELECT * FROM accommodation WHERE location='$value'");
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($rows);
        }
        else if(isset($_GET["option"]) && ($option == "type"))
        {
            $result = $conn->query("SELECT * FROM accommodation WHERE type='$value'");
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($rows);
        }
        else
        {
            echo "INVALID_SEARCH_OPTION";

        }
        
    }
    else
    {
        echo "INVALID_VALUE";
    }
?>