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
	$_SESSION['r_number'] = $r_number;
	$_SESSION['description'] = $description;
	$sql = "select s.series_id, s.name, s.description, count(e.elem_index) from Study as st NATURAL JOIN Series as s LEFT OUTER JOIN Element as e on exists(select e2.elem_index from Series natural join Element as e2 where Series.description = st.description and e2.series_id = e.series_id and e.elem_index = e2.elem_index) where st.request_number = $r_number and st.description=$description";
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
	    $count = $row['count(e.elem_index)'];
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
