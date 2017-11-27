<?php
session_start();
?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">

  <title>Add New Region</title>
</head>
 <body>
   <h1>SIBD Project</h1>
   <h2>Elements List</h2>
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
	$r_number = $_SESSION['r_number'];
	$s_id = $_GET['series_id'];
        $_SESSION['series_id'] = $s_id;
	$sql = "select e.elem_index,s.description, count(r.x1) as n_regions from Series as s NATURAL JOIN Element as e left outer join Region as r on EXISTS(select r2.x1 from Element as e2 NATURAL JOIN Region as r2 where r.x1 = r2.x1 and r.x2 = r2.x2 and r.y1 = r2.y1 and r.y2 = r2.y2 and e2.elem_index = e.elem_index and e.series_id = e2.series_id) where e.series_id = $s_id group by e.elem_index";
	$result = $connection->query($sql);
	
	echo("<table style=\"width:100%\">");
	echo("<tr><th>Element Index</th><th>description</th><th>No of Regions</th></tr>");
	foreach($result as $row){
	    $index = $row['elem_index'];
	    $description = $row['description'];
	    $count = $row['n_regions'];
	    
	    
	echo("<tr><td>$index</td><td>$description</td><td><a href =\"regions.php?ind=$index\" >$count</a></td></tr>");
	}
	echo("</table>"); 
 echo("<h3><a href = \"series.php?r_number=$r_number\">Return Series List</a></h3>");
?>
    </body>
</html>
