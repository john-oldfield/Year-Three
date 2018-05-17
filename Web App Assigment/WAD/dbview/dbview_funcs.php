<?php
function display_results($table,$db)
{

    $result = $db->query("SELECT * FROM $table ORDER BY ID");
    $allResults = $result->fetchAll(PDO::FETCH_ASSOC);

    echo "<p>Contents of table $table</p>";

    $first=true;

    echo "<table>";
    foreach($allResults as $row)
    {
        if($first==true)
        {
            print_header($row);
            $first=false;
        }
            
        print_row($row);
    }
    echo "</table>";
}

function print_header($row)
{
        echo "<tr>";
        foreach($row as $k=>$v)
            echo "<th>$k</th>";
        echo "</tr>";
}


function print_row($row)
{
    echo "<tr>";
    foreach($row as $k=>$v)
        echo "<td>$v</td>";
    echo "</tr>";
}
?>
