<!-- IST MySQL Connection Test -- 2015.09.19 -->

<html>
<body>
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist180856";	// <== replace istxxx by your IST identity
	$password="tkeh0706";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	echo("<p>Connected to MySQL database $dbname on $host as user $user</p>\n");

	$sql = "SELECT * FROM account;";

	echo("<p>Query: " . $sql . "</p>\n");

	$result = $connection->query($sql);
	
	$num = $result->rowCount();

	echo("<p>$num records retrieved:</p>\n");

	echo("<table border=\"1\">\n");
	echo("<tr><td>account_number</td><td>branch_name</td><td>balance</td></tr>\n");
	foreach($result as $row)
	{
		echo("<tr><td>");
		echo($row["account_number"]);
		echo("</td><td>");
		echo($row["branch_name"]);
		echo("</td><td>");
		echo($row["balance"]);
		echo("</td></tr>\n");
	}
	echo("</table>\n");
		
        $connection = null;
	
	echo("<p>Connection closed.</p>\n");

	echo("<p>Test completed successfully. Now you know how to connect to your MySQL database.</p>\n");

?>
</body>
</html>
