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
    $request_number = $_POST["request_number"];

    $sql = "SELECT distinct doctor_id FROM Doctor
            WHERE doctor_id NOT 
            IN (SELECT doctor_id FROM Request
                WHERE r_number = $request_number)
            ORDER BY doctor_id";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        exit(0);
    }
    echo("<option></option>");
    foreach($result as $row) {
        $doctor_id = $row['doctor_id'];
        echo("<option value=\"$doctor_id\">$doctor_id</option>");
    }

?>