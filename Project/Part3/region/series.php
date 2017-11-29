<?php
	session_start();
?>
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
    	<h3>Series List</h3>
<?php
	$r_number = $_GET['r_number'];
	$description = $_GET['description'];
	echo "$description";
	$_SESSION['r_number'] = $r_number;
	$sql = "SELECT *, count(e.series_id) 
			FROM Series AS s 
			NATURAL JOIN Element AS e 
			WHERE s.request_number = $r_number
			AND s.description = $description";
	$result = $connection->query($sql);
	if ($result== FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }   

	echo("<table style=\"width:100%\">");
	echo("
		<tr>
			<th>Series ID</th>
			<th>Name</th>
			<th>Description</th>
			<th>Elements</th>
		</tr>");
	foreach($result as $row){
	    $series_id = $row['series_id'];
	    $name = $row['name'];
	    $description = $row['description'];
	    $count = $row['count(e.series_id)'];
		echo("
			<tr>
				<td>$series_id</td>
				<td>$name</td>
				<td>$description</td>
				<td><a href =\"elements.php?series_id=$series_id\" >$count</a></td>
			</tr>");
	}
	echo("</table>"); 

?>
	<br><a href = "studies.php">Return Studies List</a>
<?php include '../footer.php';?>
    </body>
</html>
