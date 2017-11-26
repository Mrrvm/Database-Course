<html lang="en">
<head>
    <meta charset="utf-8">
     <title>SIBD Project</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function(){
           
           $("#manufacturer").change(function(){
                 var manufacturer=$("#manufacturer").val();
                 $.ajax({
                    type:"post",
                    url:"dropdown/get_snum.php",
                    data:"manufacturer="+manufacturer,
                    success:function(result){
                          $("#snum").html(result);
                    }
                 });
           });
           $("#request_number").change(function(){
                 var request_number=$("#request_number").val();
                 $.ajax({
                    type:"post",
                    url:"dropdown/get_doctor_id.php",
                    data:"request_number="+request_number,
                    success:function(result){
                          $("#doctor_id").html(result);
                    }
                 });
           });
       });
    </script>
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
            <select id="request_number" name="request_number" required>
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
            <select id="doctor_id" name="doctor_id" required>
                <option></option>
<!-- Get all doctors-->                
            </select> 
            <span class="error">* </span>
        </p>       
        <p>Manufacturer: 
            <select id="manufacturer" name="manufacturer" required>
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
            <select id="snum" name="serial_number" required>
                <option></option>
<!-- Get all serial numbers-->  
            </select> 
            <span class="error">* </span>
        </p>     
        <h3>Create a new serie:</h3>
        <span class="error">* required field</span>
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