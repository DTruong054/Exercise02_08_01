<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Create Newsletter</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>
<body>
  <h2>Create Newsletter</h2>
  <?php
  //Stuff for database
    echo "<p>MySQL Client Version: " . mysqli_get_client_info() . "</p>\n";
    $hostName = "localhost";
    $username = "adminer";
    $password = "seven-which-26";
    $DBName = "newsletter1";
    $DBConnect = mysqli_connect($hostName, $username, $password);

    //If connected or not
    if (!$DBConnect) {
        //Connection has an error
      echo "<p>Connection Error: " . mysqli_connect_error() . "</p>\n";
    } else {
        //Creating a database
        $sql = "CREATE DATABASE $DBName";
        if (mysqli_query($DBConnect, $sql)) {
            echo "<p>Successfully created \"$DBName\"" . "database.</p>\n";
        } else {
            echo "<p>Could not create \"$DBName\"" . "database: " . mysqli_error($DBConnect) . "</p>\n";
        }
        
      echo "<p>Closing Database connection: " . mysqli_close($DBConnect) . "</p>\n";
    }
  ?>
</body>
</html>