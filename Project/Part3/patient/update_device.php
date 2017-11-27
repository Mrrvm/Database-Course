<html>
    <head>
        <meta charset="utf-8">
        <title>SIBD Project</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
<?php include '../header.php';?>
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
            exit();
        }

        $patient = $_GET['patient'];
        $start = $_GET['start'];
        $new_snum = $_GET['new_snum'];
        $manuf = $_GET['manuf'];

        $today = date("Y-m-d");

        $sql = "UPDATE Period
                SET p_end = '$today'
                WHERE p_start = '$start' 
                    AND p_end = '2500-01-01'";

        $nrows = $connection->exec($sql);

        $sql = "INSERT INTO Period VALUES('$today', '2500-01-01')";

        $nrows_period = $connection->exec($sql);

        $sql = "INSERT INTO Wears values('$today', '2500-01-01', $patient, '$new_snum', '$manuf')";

        $nrows_wears = $connection->exec($sql);

        echo "<h3> Device successfully updated!</h3>";

        $connection = null;

?>
   </body>
<?php include '../footer.php';?>
</html>
