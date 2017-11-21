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

        $request_number = $_REQUEST['request_number'];
        $description = $_REQUEST['description'];
        $day = $_REQUEST['day'];
        $month = $_REQUEST['month'];
        $year = $_REQUEST['year'];
        $date = $year.'-'.$month.'-'.$day;
        $doctor_id = $_REQUEST['doctor_id'];
        $manufacturer = $_REQUEST['manufacturer'];
        $serial_number = $_REQUEST['serial_number'];

        $sql = "SELECT request_number FROM Study WHERE request_number=$request_number";
        $result = $connection->query($sql);
        
        if($result != null)
            echo("study created. ERROR: already exists. ");

        $connection = null;
 ?>
    </body>
</html>
