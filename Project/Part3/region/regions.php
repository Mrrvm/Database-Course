<?php
session_start();
?>
<html>
<head>
<meta charset="utf-8">

  <title>Add New Region</title>

        <style>
            .error {color: #FF0000;}
	table, th, td {
	    border: 1px solid black;
	    padding: 5px;
	    text-align:center;
	}
	table {
	    border-spacing: 5px;
	}
        </style>
<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
   <h1>SIBD Project</h1>
   
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
	$s_id = $_SESSION['series_id'];
	$e_index = $_GET['ind'];
	$_SESSION['e_ind'] = $e_index;
	$sql = "SELECT s.name as name, max(e.elem_index) as max from Series as s NATURAL JOIN Element as e where e.series_id = $s_id";
	$result = $connection->query($sql);
	foreach($result as $row){
		    $index = $row['max'];
		    $name = $row['name'];		
		}
	echo("<h2>Regions List for Series $name - Element $index </h2>");
	$sql_count = "SELECT count(r.x1) as count from Region as r WHERE r.series_id = $s_id and r.elem_index = $e_index";
	$result_count = $connection->query($sql_count);

	foreach($result_count as $row){
	    $counter = $row['count'];
	}
	
	if( $counter == "0"){
		echo("<h3>The selected Element has no Region assigned</h3>");
		
			
	}else{
		$sql = "SELECT * FROM Element as e NATURAL JOIN Region as r WHERE r.series_id = $s_id and r.elem_index = $e_index";
		$result = $connection->query($sql);
		echo("<table style=\"width:100%\">");
		echo("<tr><th>x1</th><th>y1</th><th>x2</th><th>y2</th></tr>");
		foreach($result as $row){
		    $x1 = $row['x1'];
		    $y1 = $row['y1'];
		    $x2 = $row['x2'];
		    $y2 = $row['y2'];
		    echo("<tr><td>$x1</td><td>$y1</td><td>$x2</td><td>$y2</td></a></tr>");
		}
	     }
	
	echo("</table>"); 	
	
?>
    <h4>Add New Region</h4>
    <form method="post" action="region_result.php">
    <p>Series ID: <?php echo($s_id)?>  Element Index: <?php echo($e_index);?></p>
    <p>x1: <input value="" type="text" name="x1" required/> y1: <input value="" type="text" name="y1" required/></p>
    <p>x2: <input value="" type="text" name="x2" required/> y2: <input value="" type="text" name="y2" required/></p>
    <p><input type="submit" value="Submit"/></p>
    </form>
<?php echo("<h3><a href = \"elements.php?series_id=$s_id\">Return Elements List</a></h3>");
?>
    </body>
</html>
