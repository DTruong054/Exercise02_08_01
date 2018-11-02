<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Newsletter Subscribe</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>
<body>
  <h2>Newsletter Subscribe</h2>
  <?php
  //Stuff for database
    $hostName = "localhost";
    $username = "adminer";
    $password = "seven-which-26";
    $DBName = "newsletter1";
    $tableName = "Subscribers";
    $subscriberName = "";
    $subscriberEmail = "";
    $showForm = false;
    //if came form submit
    if (isset($_POST['submit'])) {
        $formErrorCount = 0;
        $DBConnect = mysqli_connect($hostName, $username, $password);

        //If connected or not
        if (!$DBConnect) {
            //Connection has an error
        echo "<p>Connection Error: " . mysql_connect_error() . "</p>\n";
        } else {
            //Creating a database
            if (mysqli_select_db($DBConnect, $DBName)) {
                echo "<p>Successfully selected \"$DBName\"" . "database.</p>\n";
                $sql = "SHOW TABLES LIKE '$tableName'";
                $result = mysqli_query($DBConnect, $sql);
                if (mysqli_num_rows($result) == 0) {
                    //if table doesn't exist create new one
                    echo "The <strong>$tableName</strong> table does not exist, creating table";
                    $sql = "CREATE TABLE $tableName (subscribersID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(80), email VARCHAR(100), subscribeDate DATE, confirmedDate DATE)";
                    $result = mysqli_query($DBConnect, $sql);
                    if (!$result) {
                        echo "<p>Unable to create the <strong>$tableName</strong> table.</p>\n";
                        echo "<p>Error: " . mysqli_error($DBConnect) . "</p>\n";
                    } else {
                        echo "<p>Successfully created the <strong>$tableName</strong> table.</p>\n";
                    }
                } else {
                    echo "The <strong>$tableName</strong> table already exists";
                }
                
            } else {
                echo "<p>Could not select the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . "</p>\n";
            }
            
        echo "<p>Closing Database connection: " . mysqli_close($DBConnect) . "</p>\n";
        }
    } else {
        $showForm = true;
    }
    
    $tableName = "Subscribers";
    if ($showForm) {
  ?>
  <form action="newsLetterSubscribe.php" method="post">
      <p><strong>Your name: </strong><br><input type="text" name="subName" value="<?php echo $subscriberName; ?>"></p>
      <p><strong>Your Email: </strong><br><input type="email" name="subEmail" value="<?php echo $subscriberEmail; ?>"></p>
      <p><input type="submit" name="submit" value="submit"></p>
  </form>
</body>
</html>
<?php
    }
?>