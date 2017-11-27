<html>
<head>
<meta charset="utf-8">

  <title>Add New Region</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
   <h1>SIBD Project</h1>
   <h2>Studies List</h2>
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
	$sql = "SELECT * FROM Study";
	$result = $connection->query($sql);
	echo("<table style=\"width:100%\">");
	echo("<tr><th>Request Number</th><th>Description</th><th>Date</th><th>Doctor ID</th><th>Serial Number</th><th>Manufacturer</th></tr>");
	foreach($result as $row){
	    $r_number = $row['request_number'];
	    $description = $row['description']; 
	    $s_date = $row['s_date']; 
	    $doctor_id = $row['doctor_id']; 
	    $serial_number = $row['serial_number']; 
	    $manufacturer = $row['manufacturer']; 
	    
	echo("<tr><td><a href= \"series.php?r_number=$r_number\"> $r_number</a></td><td>$description</td><td>$s_date</td><td>$doctor_id</td><td>$serial_number</td><td>$manufacturer</td></tr>");
	}
	echo("</table>"); 


echo("<h3><a href = \"../index.php\">Return</a></h3>");
?>
    </body>
</html>
