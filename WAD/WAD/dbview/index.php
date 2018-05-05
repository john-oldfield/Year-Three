<html>
<head>
<style type='text/css'>
td, th { border: 1px solid black; border-collapse: collapse; }
table { border-collapse: collapse; }
body { font-family: helvetica, arial,sans-serif; }
th { background-color : #c0c0ff;  }
td { background-color: #ffffc0; }
</style>
</head>
<body>
<h1>Your Database</h1>
<?php

include ('include.php');
include ('dbview_funcs.php');

$db = new PDO("mysql:host=localhost;dbname=".USERNAME, USERNAME, PASSWORD);

display_results("places", $db);
display_results("users", $db);
display_results("reviews", $db);


?>
</body>
</html>
