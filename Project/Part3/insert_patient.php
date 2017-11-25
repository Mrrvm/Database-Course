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
        $birthdate = $_REQUEST['birthdate'];
        $address = $_REQUEST['address'];

        $sql = "SELECT      p_number
                FROM        Patient
                ORDER BY    p_number desc";

        $result = $connection->query($sql);
        $i = 0;
        foreach ($result as $row) {
            $p_number[$i] = $row['p_number'];
            $i++;
        }
        $j = 1;
        $patient_number = $p_number[0] + $j;

        $stmt = $connection->prepare("INSERT INTO Patient
                                    VALUES(:p_number, :name, :birthday, :address)");
        $stmt->bindParam(':p_number', $patient_number);
        $stmt->bindParam(':name', $patient_name);
        $stmt->bindParam(':birthday', $birthdate);
        $stmt->bindParam(':address', $address);

        if($stmt->execute()){
            echo("</br><h2>New patient inserted in the database</h2>");
            echo "<ul>Patien name: $patient_name</br></br>
                Patient number: $patient_number</br></br>
                Birthday: $birthdate</br></br>
                Address: $address</br></ul>";
        }else {
            echo "</br><h2>ERROR: inserting new patient</h2>";
        }

        $connection = null;

        echo("</br><h3><a href='index.html'>Home page</a></h3>");
 ?>
    </body>
</html>
