<html>
    <body>
        <style>
            .error {color: #FF0000;}
        </style>
<?php
echo('<form action="insert_patient.php" method = "post">
        <h2>Insert a new patient:</h2>
        <span class="error">* required field</span>
        <p>Patient name: <input type="text" name="patient_name" required/>
            <span class="error">* </span>
        </p>
        <p>Birth date: <input type = "date" name="birthdate" required/>
            <span class="error">* </span>
        </p>
        <p>Address: <input type="text" name="address" required/>
            <span class="error">* </span>
        </p>
        <p><input type="submit" value="Submit"/></p>
    </form>');
?>
    </body>
</html>
