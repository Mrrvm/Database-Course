<html>
    <head>
        <meta charset="utf-8">
        <title>SIBD Project</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    	<link rel="stylesheet" type="text/css" href="../css/table_style.css">
    </head>
    <body>
<?php include '../header.php';?>
<?php include '../database/db.php';?>
    	<h3>Studies List</h3>
<?php
	$sql = "SELECT * FROM Study";
	$result = $connection->query($sql);
	if ($result== FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }   

	echo("<table style=\"width:100%\">");
	echo("
		<tr>
			<th>Request Number</th>
			<th>Description</th>
			<th>Date</th>
			<th>Doctor ID</th>
			<th>Serial Number</th>
			<th>Manufacturer</th>
		</tr>");

	foreach($result as $row) {
	    $r_number = $row['request_number'];
	    $description = $row['description']; 
	    $s_date = $row['s_date']; 
	    $doctor_id = $row['doctor_id']; 
	    $serial_number = $row['serial_number']; 
	    $manufacturer = $row['manufacturer']; 
		echo("
			<tr>
				<td><a href= \"series.php?r_number=$r_number\"> $r_number</a></td>
				<td>$description</td>
				<td>$s_date</td>
				<td>$doctor_id</td>
				<td>$serial_number</td>
				<td>$manufacturer</td>
			</tr>");
	}
	echo("</table>"); 
?>
<?php include '../footer.php';?>
    </body>
</html>
