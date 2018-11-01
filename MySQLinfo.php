<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>My SQL info</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>
<body>
  <h2>MySQL Database Server Information</h2>
  <?php
  //Stuff for database
    echo "<p>MySQL Client Version: " . mysqli_get_client_info() . "</p>\n";
    $hostName = "localhost";
    $username = "adminer";
    $password = "seven-which-26";
    $DBConnect = mysqli_connect($hostName, $username, $password);

    //If connected or not
    if (!$DBConnect) {
      echo "<p>Connection failed</p>\n";
    } else {
      echo "<p>MySQL conection: " . mysql_get_host_info($DBConnect) . "</p>\n";
      echo "<p>Closing Database connection</p>\n";
      mysqli_close($DBConnect);
    }
  ?>
</body>
</html>