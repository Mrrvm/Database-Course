<html>
    <head>
        <meta charset="utf-8">
        <title>SIBD Project</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
<?php include '../header.php';?>
<?php include '../database/db.php';?>
<?php

    $patient = $_GET['patient'];
    $start = $_GET['start'];
    $end = $_GET['end'];
    $new_snum = $_GET['new_snum'];
    $manuf = $_GET['manuf'];

    $today = date("Y-m-d");

    $connection->beginTransaction();

    /* check how many entries in table Wears have the same period */
    $sql = "SELECT  COUNT(patient)
            FROM    Wears
            WHERE   p_start = '$start' AND p_end = '$end'";

    $result = $connection->query($sql);
    $period_count = $result->fetchColumn(0);

    if ($period_count > 1) {
        $sql = "INSERT INTO Period values('$start', '$today')";
        $result = $connection->exec($sql);
        if(!$result){
            $info = $connection->errorInfo();
            echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
            exit(0);
        }

        $sql = "UPDATE  Wears
                SET     p_end = '$today'
                WHERE   p_start = '$start'
                AND     (p_end = '2500-01-01' OR p_end = '$end')
                AND     patient = $patient";
        $result = $connection->exec($sql);
        if(!$result){
            $info = $connection->errorInfo();
            echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
            exit(0);
        }
    }
    else{
        $sql = "UPDATE  Period
                SET     p_end = '$today'
                WHERE   p_start = '$start' 
                AND     (p_end = '2500-01-01' OR p_end = '$end')";

        $result = $connection->exec($sql);
        if(!$result){
            $info = $connection->errorInfo();
            echo("<p>ERROR: {$info[0]} {$info[1]} {$info[2]}</p>");
            exit(0);
        }
    }
    
    $sql = "INSERT INTO Period VALUES('$today', '2500-01-01')";

    $result_period = $connection->exec($sql);

    $sql = "INSERT INTO Wears values('$today', '2500-01-01', $patient, '$new_snum', '$manuf')";

    $result_wears = $connection->exec($sql);

    echo "<h3> Device successfully updated!</h3>";

    if ($result_period && $result_wears) {
        $connection->commit();
    }
    else{
        $connection->rollback();
    }

    $connection = null;

?>
   </body>
<?php include '../footer.php';?>
</html>
