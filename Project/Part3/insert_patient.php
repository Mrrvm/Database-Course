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

        $patient_name = $_REQUEST['patient_name'];
        $day = $_REQUEST['day'];
        $month = $_REQUEST['month'];
        $year = $_REQUEST['year'];
        $birthdate = $year.'-'.$month.'-'.$day;
        $address = $_REQUEST['address'];

        echo "<p>$patient_name, $birthdate, $address</p>";

        $sql = "SELECT p_number FROM Patient ORDER BY p_number desc";
        $result = $connection->query($sql);
        $i = 0;
        foreach ($result as $row) {
            $p_number[$i] = $row['p_number'];
            $i++;
        }
        $j = 1;
        $patient_number = $p_number[0] + $j;
        echo"<p>$patient_number</p>";

        $sql = "INSERT INTO Patient VALUES('$patient_number', '$patient_name',
                                            '$birthdate', '$address')";
        echo("<p>$sql</p>");
        $nrows = $connection->exec($sql);
        echo("<p>Rows inserted: $nrows</p>");

        $connection = null;
 ?>
    </body>
</html>
