<?php
session_start();
?>
<html>
<head>
<meta charset="utf-8">

  <title>Add New Region</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
   <h1>SIBD Project</h1>
   <h2>Series List</h2>
<?php
	$host = "db.ist.utl.pt";
        $user = "ist190989";
        $pass = "wkfi3575";
        $dsn = "mysql:host=$host; dbname=$user";
	try {
            $connection = new PDO($dsn, $user, $pass);
        } catch (PDOException $exception) {
            echo("<p>Error: ");
            echo($exception->getMessage());
            echo("</p>");
            exit();
        }
	$r_number = $_GET['r_number'];
	$_SESSION['r_number'] = $r_number;
	$sql = "SELECT *, count(e.series_id) FROM Series as s NATURAL JOIN Element as e WHERE s.request_number = $r_number";
	$result = $connection->query($sql);
	
	echo("<table style=\"width:100%\">");
	echo("<tr><th>Series ID</th><th>Name</th><th>Description</th><th>Elements</th></tr>");
	foreach($result as $row){
	    $series_id = $row['series_id'];
	    $name = $row['name'];
	    $description = $row['description'];
	    $count = $row['count(e.series_id)'];
	    
	echo("<tr><td>$series_id</td><td>$name</td><td>$description</td><td><a href =\"elements.php?series_id=$series_id\" >$count</a></td></tr>");
	}
	echo("</table>"); 
	

?>
<h3><a href = "studies.php">Return Studies List</a></h3>
    </body>
</html>
