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
        if (!empty($_POST['subName'])) {
            $subscriberName = stripslashes($_POST['subName']);
            $subscriberName = trim($subscriberName);
            if (strlen($subscriberName) == 0) {
                ++$formErrorCount;
                echo "<p>You must include your <strong>Name</strong></p>\n";
            }
        } else{
            ++$formErrorCount;
            echo "<p>Form submit error, no <strong>Name</strong> field</p>\n";
        }
    if (!empty($_POST['subEmail'])) {
            $subscriberEmail = stripslashes($_POST['subEmail']);
            $subscriberEmail = trim($subscriberEmail);
            if (strlen($subscriberEmail) == 0) {
                ++$formErrorCount;
                echo "<p>You must include your <strong>Email</strong></p>\n";
            }
        } else{
            ++$formErrorCount;
            echo "<p>Form submit error, no <strong>Email</strong> field</p>\n";
        }
        //Validation
        if ($formErrorCount == 0) {
            $showForm = false;
        $DBConnect = mysqli_connect($hostName, $username, $password);
        //If connected or not
        if (!$DBConnect) {
            //Connection has an error
        echo "<p>Connection Error: " . mysql_connect_error() . "</p>\n";
        } else {
            //Creating a database
            if (mysqli_select_db($DBConnect, $DBName)) {
                echo "<p>Successfully selected \"$DBName\"" . "database.</p>\n";
                $subscriberDate = date("Y-m-d");
                $sql = "INSERT INTO $tableName" .
                        "(name, email, subscribeDate)" .
                        "VALUES ('$subscriberName'," .
                        "'$subscriberEmail', '$subscriberDate')";
                $result = mysqli_query($DBConnect, $sql);
                if (!$result) {
                    echo "<p>Unbale to insert the values into the <strong>$tableName</strong> table</p>\n";
                    echo "<p>Error Code <strong>" . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</strong></p>";
                } else {
                    # code...
                }
                
            } else {
                echo "<p>Could not select the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . "</p>\n";
            }
            
        echo "<p>Closing Database connection: " . mysqli_close($DBConnect) . "</p>\n";
        }
        }
        else{
            $showForm = true;
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