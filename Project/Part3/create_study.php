<html>
<body>
    <style>
        .error {color: #FF0000;}
    </style>
    <?php
$host = "db.ist.utl.pt";
$user = "ist178755";
$pass = "jagx2469";
$dsn  = "mysql:host=$host; dbname=$user";

try {
    $connection = new PDO($dsn, $user, $pass);
}
catch (PDOException $exception) {
    echo ("<p>Error: ");
    echo ($exception->getMessage());
    echo ("</p>");
    exit();
}

echo ('<form action="submit_study.php" method = "post">
                <h3>Create a new study:</h3>
                <span class="error">* required field</span>
                <p>Request Number: <input type="text" name="request_number" required/>
                    <span class="error">* </span>
                </p>
                <p>Description: <input type="text" name="description" required/>
                    <span class="error">* </span>
                </p>');
echo ('<p>Date:
                <select name = "day" required>
                    <option value="00">---day---</option>');
for ($d = 1; $d <= 31; $d++) {
    echo ("<option value=\"$d\">$d</option>");
}
echo ('</select>
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
for ($y = date('Y'); $y >= 1915; $y--) {
    echo ("<option value=\"$y\">$y</option>");
}
echo ('</select>');
echo ('<p>Doctor ID: <input type="text" name="doctor_id" required/>
                <span class="error">* </span></p>
              <p>Manufaturer: <input type="text" name="manufacturer" required/>
                <span class="error">* </span></p>
              <p>Serial Number: <input type="text" name="serial_number" required/>
                    <span class="error">* </span></p></form>');

echo ('<form action="submit_study.php" method = "post">
                <h3>Create a new serie:</h3>
                <span class="error">* required field</span>
                <p>Series ID: <input type="text" name="series_id" required/>
                    <span class="error">* </span>
                </p>
                <p>Name: <input type="text" name="series_name" required/>
                    <span class="error">* </span>
                </p>
                <p>Description: <input type="text" name="series_description" required/>
                    <span class="error">* </span>
                </p></form>');

$connection = null;
        ?>
   </body>
</html>