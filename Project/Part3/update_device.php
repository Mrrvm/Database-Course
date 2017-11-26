<html>
    <body>
<?php

        $host = "db.ist.utl.pt";
        $user = "ist178755";
        $pass = "jagx2469";
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

        $sql = "UPDATE  Period
                SET     p_end = '$today'
                WHERE   p_start = '$start' AND p_end = '2500-01-01'";

        $nrows = $connection->exec($sql);

        $sql = "INSERT INTO Period VALUES('$today', '2500-01-01')";

        $nrows_period = $connection->exec($sql);

        $sql = "INSERT INTO Wears values('$today', '2500-01-01', $patient, '$new_snum', '$manuf')";

        $nrows_wears = $connection->exec($sql);

        echo "<h2> Device successfully updated!</h2>";

        $connection = null;

        echo("</br><h3><a href='index.html'>Home page</a></h3>");
?>
   </body>
</html>
