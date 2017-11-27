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
    $sql = "SELECT r_date FROM Request
            WHERE r_number = $request_number";
    $result = $connection->query($sql);
    if ($result == FALSE) {
        exit(0);
    }
    $r_date = $result->fetchColumn(0);
    $time=strtotime($r_date);
    $month=date("m",$time);
    $year=date("Y",$time);
    $day=date("d",$time);

    echo("
            <script>
                $( function() {
                    $('#date').datepicker({
                        minDate: new Date($year, $month - 1, $day),
                        dateFormat: 'yy-mm-dd'
                    });
                } );
            </script>
        ");
?>