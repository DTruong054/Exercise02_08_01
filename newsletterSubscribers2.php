<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Newsletter Subscriber</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>
<body>
  <h2>Newsletter subscriber</h2>
  <?php
  //Stuff for database
    $hostName = "localhost";
    $username = "adminer";
    $password = "seven-which-26";
    $DBName = "newsletter1";
    $tableName = "Subscribers";
    $DBConnect = mysqli_connect($hostName, $username, $password);

    //If connected or not
    if (!$DBConnect) {
        //Connection has an error
      echo "<p>Connection Error: " . mysql_connect_error() . "</p>\n";
    } else {
        //Creating a database
        if (mysqli_select_db($DBConnect, $DBName)) {
            echo "<p>Successfully selected \"$DBName\"" . "database.</p>\n";
            $sql = "SELECT * FROM $tableName";
            $result = mysqli_query($DBConnect, $sql);
            echo "<p>Number of rows in <strong>$tableName</strong>: " . mysqli_num_rows($result) . "</p>\n";
            echo "<table width='100%' border='1'>\n";
            echo "<tr>";
            echo "<th>Subscriber ID</th>";
            echo "<th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Subscriber date</th>";
            echo "<th>Subscriber confirm</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              foreach ($row as $field) {
                  echo "<td>{$field}</td>";
              }
              echo "</tr>\n";
            }
            echo "</table>\n";
            mysqli_free_result($result);
        } else {
            echo "<p>Could not select the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . "</p>\n";
        }
        
      echo "<p>Closing Database connection: " . mysqli_close($DBConnect) . "</p>\n";
    }
  ?>
</body>
</html>