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
<?php
	$s_id = $_SESSION['series_id'];
	$e_index = $_GET['ind'];
	$_SESSION['e_ind'] = $e_index;
	$sql = "SELECT name  
			FROM Series 
			WHERE series_id = $s_id";
	$result = $connection->query($sql);
	if ($result== FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }   
    $name = $result->fetchColumn(0);		
	
	echo("<h3>Regions List for Series $name - Element $e_index </h3>");
	
	$sql_count = "SELECT count(r.x1) AS count 
				  FROM Region AS r 
				  WHERE r.series_id = $s_id 
				  AND r.elem_index = $e_index";
	$result_count = $connection->query($sql_count);
	if ($result_count == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    } 
	$counter = $result_count->fetchColumn(0);
	if($counter == 0){
		echo("<h3><span style='color:red'>The selected Element has no Region assigned</span></h3>");		
	}
	else {
		$sql = "SELECT * 
				FROM Element AS e 
				NATURAL JOIN Region AS r 
				WHERE r.series_id = $s_id 
				AND r.elem_index = $e_index";
		$result = $connection->query($sql);
		if ($result== FALSE) {
	        $info = $connection->errorInfo();
	        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
	        exit(0);
	    }  
		echo("<table style=\"width:100%\">");
		echo("
			<tr>
				<th>x1</th>
				<th>y1</th>
				<th>x2</th>
				<th>y2</th>
			</tr>");
		foreach($result as $row) {
		    $x1 = $row['x1'];
		    $y1 = $row['y1'];
		    $x2 = $row['x2'];
		    $y2 = $row['y2'];
		    echo("
		    	<tr>
		    		<td>$x1</td>
		    		<td>$y1</td>
		    		<td>$x2</td>
		    		<td>$y2</td>
		    	</tr>");
		}
	}
	echo("</table>"); 	
?>
    <h4>Add New Region</h4>
    <form method="post" action="region_result.php">
    	<p>Series ID: <?php echo($s_id)?> |  Element Index: <?php echo($e_index);?></p>
    	<p>x1: <input value="" type="text" name="x1" required/> y1: <input value="" type="text" name="y1" required/></p>
    	<p>x2: <input value="" type="text" name="x2" required/> y2: <input value="" type="text" name="y2" required/></p>
    	<p><input type="submit" value="Submit"/></p>
    </form>
<?php echo("<a href = \"elements.php?series_id=$s_id\">Return Elements List</a>");?>
<?php include '../footer.php';?>
    </body>
</html>
