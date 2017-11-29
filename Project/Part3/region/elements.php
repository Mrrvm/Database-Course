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
    	<h3>Elements List</h3>
<?php
	$r_number = $_SESSION['r_number'];
	$description = $_SESSION['description'];
	$s_id = $_GET['series_id'];
    $_SESSION['series_id'] = $s_id;
	$sql = "SELECT e.elem_index,s.description, count(r.x1) as n_regions
			FROM Series AS s 
			NATURAL JOIN Element AS e 
			LEFT OUTER JOIN Region AS r 
			ON EXISTS(
				SELECT r2.x1 
				FROM Element AS e2 
				NATURAL JOIN Region AS r2 
				WHERE r.x1 = r2.x1 
				AND r.x2 = r2.x2 
				AND r.y1 = r2.y1 
				AND r.y2 = r2.y2 
				AND e2.elem_index = e.elem_index 
				AND e.series_id = e2.series_id) 
			WHERE e.series_id = $s_id 
			GROUP BY e.elem_index";
	$result = $connection->query($sql);
	if ($result== FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }   

	echo("<table style=\"width:100%\">");
	echo("
		<tr>
			<th>Element Index</th>
			<th>description</th>
			<th>No of Regions</th>
		</tr>");

	foreach($result as $row){
	    $index = $row['elem_index'];
	    $description = $row['description'];
	    $count = $row['n_regions'];    
		echo("
			<tr>
				<td>$index</td>
				<td>$description</td>
				<td><a href =\"regions.php?ind=$index\" >$count</a></td>
			</tr>");
	}
	echo("</table>"); 
 	echo("<br><a href = \"series.php?r_number=$r_number&description=$description\">Return Series List</a>");
?>
<?php include '../footer.php';?>
    </body>
</html>
