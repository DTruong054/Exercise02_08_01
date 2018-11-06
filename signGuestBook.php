<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign Guestbook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Sign GuestBook</h1>
    <?php
    //todo Move this later
    function connectToDB($hostName, $userName, $password){
        $DBConnect = mysqli_connect($hostName, $userName, $password);
        if (!$DBConnect) {
            echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
        }
        return $DBConnect;
    }
    
    function selectDB($DBConnect, $DBName){
        $success = mysqli_select_db($DBConnect, $DBName);
        if ($success) {
            echo "<p>Successfully selected the \"$DBName\" database</p>\n";
        } else{
            echo "<p>Could not select the \"$DBName\" database: " . mysqli_error($DBConnect) . ", creating it.</p>\n";
            $sql = "CREATE DATABASE $DBName";
            if (mysqli_query($DBConnect, $sql)) {
                echo "<p>Successfully created the \"$DBName\" database</p>\n";
                $success = mysqli_select_db($DBConnect, $DBName);
                if ($success) {
                    echo "<p>Successfully selected the \"$DBName\" database</p>\n";
                }
            } else {
                echo "<p>Could not create the \"$DBName\" database: " . mysqli_error($DBConnect) . "</p>\n";
            }
        }
        return $success;
    }

    function createTable($DBConnect, $tableName){
        $success = false;
        $sql = "SHOW TABLES LIKE '$tableName'";
        $result = mysqli_query($DBConnect, $sql);
        if (mysqli_num_rows($result) === 0) {
            echo "The <strong>$tableName</strong> table does not, exist creating table<br>\n";
            $sql = "CREATE TABLE $tableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY lastName VARCHAR(40), firstName VARCHAR(40))";
            $result = mysqli_query($DBConnect, $sql);
            if ($result === false) {
                $success = false;
                echo "<p>Unbale to create the $tableName table</p>";
                echo "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
            } else {
                $success = true;
                echo "<p>Successfully created the $tableName table</p>";
            }
        } else {
            $success = true;
            echo "The $tableName table already exists<br>\n";
        }
        return $success;
    }
    //todo Stop move later

        $hostName = "localhost";
        $userName = "root";
        $password = "seven-which-26";
        $DBName = "guestbook";
        $tableName = "visitors";
        $firstName = "";
        $lastName = "";
        $formErrorCount = 0;
        if (isset($_POST['submit'])) {
            $firstName = stripslashes($_POST['firstName']);
            $firstName = trim($firstName);
            $firstName = stripslashes($_POST['lastName']);
            $firstName = trim($lastName);
            if (empty($firstName) || empty($lastName)) {
                echo "<p>You must enter your first and last <strong>name</strong>.</p>\n";
                ++$formErrorCount;
            }
            if ($formErrorCount === 0) {
                $DBConnect = connectToDB($hostName, $userName, $password);
                if ($DBConnect) {
                    if (selectDB($DBConnect, $DBName)) {
                        if (createTable($DBConnect, $tableName)) {
                            echo "<p>Connection successful!</p>\n";
                            $sql = "INSERT INTO $tableName VALUES(NULL, '$lastName', '$firstName')";
                            $result = mysqli_query($DBConnect, $sql);
                            if ($result === false) {
                                echo "<p>Unable to execute the query</p>";
                                echo "<p>Error code" . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                            } else {
                                echo "<h3>Thank you for sgning out guest book!</h3>";
                                $firstName = "";
                                $lastName = "";
                            }
                        }
                    }
                    mysqli_close($DBConnect);
                }
            }
    ?>
    <form action="signGuestBook.php" method="post">
        <p><strong>First Name: </strong></p><br>
        <input type="text" name="firstName" value="<?php echo "$firstName";?>">
        <p><strong>Last Name: </strong></p><br>
        <input type="text" name="firstName" value="<?php echo "$lastName";?>">
        <p><input type="submit" name="submit" value="submit"></p>
    </form>
    <?php
        $DBConnect = connectToDB()
    ?>
</body>
</html>