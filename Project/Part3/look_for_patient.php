<html>
    <body>
        <style>
            .error {color: #FF0000;}
        </style>
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

        /* Get patient */

        $patient_name = $_REQUEST['patient_name'];
        $sql = "SELECT name FROM Patient WHERE name = '$patient_name'";
        $result = $connection->query($sql);
        $nrows = $result->rowCount();

        if($nrows == 0){
            echo("There is no patient named $patient_name.\n");

            echo('<form action="insert_patient.php" method = "post">
                    <h3>Insert a new patient:</h3>
                    <span class="error">* required field</span>
                    <p>Patient name: <input type="text" name="patient_name" required/>
                        <span class="error">* </span>
                    </p>');
            echo('<p>Birth date:
                    <select name = "day" required>
                        <option value="00">---day---</option>');
            for($d = 1; $d <= 31; $d++){
                echo("<option value=\"$d\">$d</option>");
            }

            echo('</select>
            <select name = "month" required>
                <option value = "00">---month---</option>
                <option value = "01">January</option>
                <option value = "02">February</option>
                <option value = "03">March</option>
                <option value = "04">April</option>
                <option value = "05">May</option>
                <option value = "06">June</option>
                <option value = "07">July</option>
                <option value = "08">August</option>
                <option value = "09">September</option>
                <option value = "10">October</option>
                <option value = "11">November</option>
                <option value = "12">December</option>
            </select>
            <select name = "year" required>
            <option value = "0000">---year---</option>');
                
            for($y = date('Y'); $y >= 1915; $y--){
                echo("<option value=\"$y\">$y</option>");
            }
                echo('</select>
                    <span class="error">* </span>
                </p>
                <p>Address: <input type="text" name="address" required/>
                    <span class="error">* </span>
                </p>
                <p><input type="submit" value="Submit"/></p>
            </form>');
        }
        else {
            echo("List of Patients:\n\n");
            foreach ($result as $row) {
                $p_name = $row['name'];
                echo("<option value=\"p_name\">$p_name</option>");
            }
        }
        $connection = null;
    ?>
    </body>
</html>
