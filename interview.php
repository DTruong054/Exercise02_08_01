<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Job Interview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <?php
        $hostName = "localhost";
        $username = "adminer";
        $password = "seven-which-26";
        $DBName = "interview";
        $tableName = "Interviews";
        $interviewName = $_POST['position'];
        $position = $_POST['position'];
        $date = $_POST['date'];
        $canidateName = $_POST['canName'];
        $communicationSkills = $_POST['commSkills'];
        $appearance = $_POST['appearance'];
        $computerSkills = $_POST['compSkills'];
        $businessKnowlage = $_POST['busKnowlage'];
        $interviewComments = $_POST['intComments'];

        //if gotten from submit
        if (isset($_POST['submit'])) {
            //Counts the errors
            $error = 0;
            if (empty($_POST['intName'])) {
                echo "This works int";
                ++$error;
            }
            if (empty($_POST['position'])) {
                echo "This works pos";
                ++$error;
            }
            if (empty($_POST['date'])) {
                echo "This works date";
                ++$error;
            }
            if (empty($_POST['canName'])) {
                echo "This works can";
                ++$error;
            }
            if (empty($_POST['commSkills'])) {
                echo "This works skills";
                ++$error;
            }
            if (empty($_POST['appearance'])) {
                echo "This works appa";
                ++$error;
            }
            if (empty($_POST['compSkills'])) {
                echo "This works comp";
                ++$error;
            }
            if (empty($_POST['busKnowlage'])) {
                echo "This works bus";
                ++$error;
            }
            if(empty($_POST['intComments']))
                echo "This works comments";
                ++$error;
        }
        //Connect to the said database
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
                echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
            }
            else {
                echo "<p>Could not select the \"$DBName\" database:" . mysqli_error($DBConnect) . ", creating it.</p>";
                $sql = "CREATE DATABASE $DBName";
                if (mysqli_query($DBConnect, $sql)) {
                    echo "<p>Successfully created the \"$DBName\" database.</p>\n";
                    $success = mysqli_select_db($DBConnect, $DBName);
                    if ($success) {
                        echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
                    }
                }
                else{
                    echo "<p>Could not create the \"$DBName\" database: " . mysqli_error($DBConnect) . "</p>\n";
                }
            }
            return $success;
        }
        function createTable($DBConnect, $tablename){
            $success = false;
            $sql = "SHOW TABLES LIKE '$tablename'";
            $result = mysqli_query($DBConnect, $sql);
            if (mysqli_num_rows($result) === 0) {
                echo "The <strong>$tablename</strong> table does not exist, creating table.<br>\n";
                $sql = "CREATE TABLE $tablename(countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                 lastName VARCHAR(40), firstName VARCHAR(40))";
                 $result = mysqli_query($DBConnect, $sql);
                if ($result === false) {
                    $success = false;
                    echo "<p>Unable to create the $tablename table.</p>";
                    echo "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                }
                else{
                    $success = true;
                    echo "<p>Successfully created the $tablename table.</p>";
                }
            }
            else{
                $success = true;
                echo "The $tablename table already exists.<br>\n";
            }
            return $success;
        }


        //If there was no error
        if ($error == 0) {
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
                $sql = "INSERT INTO $tableName" .
                        "(interviewerName, position, date, candidateName, communicationSkills, professionalAppearance, computerSkills, businessKnowlage, interviewerComments)" .
                        "VALUES ('$interviewName'," .
                        "'$position', '$date', '$canidateName', '$communicationSkills', '$appearance', '$computerSkills', '$businessKnowlage', '$interviewComments')";
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
    ?>
    <h2>Job Interview</h2>
    <form action="interview.php" method="post">
        <p>Interview name</p>
        <input type="text" placeholder="interview's name" name="intName">
        <p>Position</p>
        <input type="text" placeholder="position" name="position">
        <p>Date of Interview</p>
        <input type="date" placeholder="date of interview" name="date">
        <p>Candidate's Name</p>
        <input type="text" placeholder="candidate's name" name="canName">
        <p>Communication Skills</p>
        <input type="text" placeholder="communication skills" name="commSkills">
        <p>Professional Appearance</p>
        <input type="text" placeholder="professional appearance" name="appearance">
        <p>Computer Skills</p>
        <input type="text" placeholder="computer skills" name="compSkills">
        <p>Business Knowledge</p>
        <input type="text" placeholder="business knowledge" name="busKnowlage">
        <p>Interview's Comments</p>
        <input type="text" name="intComments">
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>