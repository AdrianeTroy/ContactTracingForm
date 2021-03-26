<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Script</title>
</head>
<body>
<?php

    $dbhost = 'localhost:3301';
    $dbname = 'test';
    $dbuser = 'root';
    $dbpass = '';
    $mysqli = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
?>

<?php 
    if(isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($mysqli, $_POST['name']);
        $age = mysqli_real_escape_string($mysqli, $_POST['age']);
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);

        if (empty($name) || empty($age) || empty($email)) {

            if(empty($name)) {
                echo "<font color='red'> Name field is empty. </font><br/>";
            }

            if(empty($age)) {
                echo "<font color='red'> Age field is empty. </font><br/>";
            }

            if(empty($email)) {
                echo "<font color='red'> Email field is empty. </font><br/>";
            }
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
            

        } else {

            $result = mysqli_query($mysqli, "INSERT INTO users(name, age, email) VALUES ('$name', '$age', '$email')");
            echo "<font color='green'> Data Added Successfully. </font>";
            echo "<br/> <a href='index.php'> View Result </a>";
        }
    }
?>

</body>
</html>