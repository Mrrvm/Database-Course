<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SIBD Project</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include 'header.php';?>
<?php 
    $host = "db.ist.utl.pt";
    $user = "ist180856";
    $pass = "tkeh0706";
    $dsn = "mysql:host=$host; dbname=$user";
    try {
        $connection = new PDO($dsn, $user, $pass);
    } catch (PDOException $exception) {
        echo("<p>Error: ");
        echo($exception->getMessage());
        echo("</p>");
        exit(0);
    }
?>
    <form action="submit_study.php" method = "post">
        <h3>Create a new study:</h3>
        <span class="error">* required field</span>
        <p>Request Number: 
            <select name="request_number" required>
                <option></option>
<!-- Get all request numbers-->  
<?php
    $sql = "SELECT distinct r_number FROM Request ORDER BY r_number";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }
    foreach($result as $row) {
        $r_number = $row['r_number'];
        echo("<option value=\"$r_number\">$r_number</option>");
    }
?>
            </select> 
            <span class="error">* </span>
        </p>  
        <p>Description: <input type="text" name="description" required/>
        <span class="error">* </span>
        </p>
        <p>Date: <input type="date" name="date" required/>
        <span class="error">* </span>
        </p>
        <p>Doctor ID: 
            <select name="doctor_id" required>
                <option></option>
<!-- Get all doctors-->                
<?php
    $sql = "SELECT distinct doctor_id FROM Doctor ORDER BY doctor_id";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }
    foreach($result as $row) {
        $doctor_id = $row['doctor_id'];
        echo("<option value=\"$doctor_id\">$doctor_id</option>");
    }
?>
            </select> 
            <span class="error">* </span>
        </p>       
        <p>Manufacturer: 
            <select name="manufacturer" required>
                <option></option>
<!-- Get all manufacturers-->                
<?php
    $sql = "SELECT distinct manufacturer FROM Device ORDER BY manufacturer";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }
    foreach($result as $row) {
        $manufacturer = $row['manufacturer'];
        echo("<option value=\"$manufacturer\">$manufacturer</option>");
    }
?>
            </select> 
            <span class="error">* </span>
        </p>       
        <p>Serial Number:
            <select name="serial_number" required>
                <option></option>
<!-- Get all serial numbers-->  
<?php
    $sql = "SELECT distinct serialnum FROM Device ORDER BY serialnum";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        $info = $connection->errorInfo();
        echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
        exit(0);
    }
    foreach($result as $row) {
        $serial_number = $row['serialnum'];
        echo("<option value=\"$serial_number\">$serial_number</option>");
    }
?>
            </select> 
            <span class="error">* </span>
        </p>     
        <h3>Create a new serie:</h3>
        <span class="error">* required field</span>
        <p>Series ID: <input type="text" name="series_id" required/>
        <span class="error">* </span>
        </p>
        <p>Name: <input type="text" name="series_name" required/>
        <span class="error">* </span>
        </p>
        <p>Description: <input type="text" name="series_description" required/>
        <span class="error">* </span>
        </p>
        <p><input type="submit" value="Submit"/></p>
    </form>
<?php include 'footer.php';?>
</body>
</html>