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
	$e_index = $_SESSION['e_ind'];
	
	$x1 = $_POST['x1'];
	$x2 = $_POST['x2'];
	$y1 = $_POST['y1'];
	$y2 = $_POST['y2'];
	$sql_validation = "SELECT region_overlaps_element($s_id, $e_index, $x1, $y1, $x2, $y2) as verify";
	$result_validation = $connection->query($sql_validation);
	foreach($result_validation as $row){
		$validation = $row['verify'];
	}
	$sql = "SELECT p.p_number, p.name as p_name, req.r_number, s.name as s_name,st.doctor_id FROM Patient as p, Request as req , Study as st , Series as s WHERE p.p_number = req.patient_id and req.r_number = st.request_number and st.request_number = s.request_number and st.description = s.description and s.series_id = $s_id";
	$result = $connection->query($sql);
	
	if($validation == 0){
		$sql2 = "INSERT INTO Region values($s_id, $e_index, $x1, $y1, $x2, $y2)";
		$result_insert = $connection->query($sql2);
		$msg = "SUCCESS - There IS ";

	}else{
		$msg = "ERROR REGION OVERLAP- Could not assign ";	
		
	}	
	foreach($result as $row){
		$p_number = $row['p_number'];	
		$p_name = $row['p_name'];
		$r_number = $row['r_number'];
		$s_name = $row['s_name'];
		$doctor_id = $row['doctor_id'];
	}

	echo("<p>".$msg . "new clinical evidence on Patient $p_name (No. $p_number) in Element $e_index from Series $s_name (ID $s_id) requested by Doctor $doctor_id (Req. No. $r_number).</p>");
	
?>
    </body>
</html>
