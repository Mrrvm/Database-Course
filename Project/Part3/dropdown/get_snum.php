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
    $manufacturer = $_POST["manufacturer"];

    $sql = "SELECT distinct serialnum FROM Device 
            WHERE manufacturer='$manufacturer' 
            ORDER BY serialnum";
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