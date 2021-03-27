<?php
 include_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Add Script</title>
</head>
<body class="bg-primary">
<div class="container">
        <div class="row">
            <div class="col">
                <div class="card card-body bg-light mt-5">
                <h1 class="text-center">Add New Data</h1><br/>
                    <?php 
                        if(isset($_POST['submit'])) {
                            
                            $name = mysqli_real_escape_string($mysqli, $_POST['name']);
                            $email = mysqli_real_escape_string($mysqli, $_POST['email']);
                            $birthdate = mysqli_real_escape_string($mysqli, $_POST['dob']);
                            $today = date("Y-m-d");
                            $diff = date_diff(date_create($birthdate), date_create($today));
                            $diff->format('%y');

                            if (empty($name) || empty($birthdate) || empty($email)) {

                                if(empty($name)) {
                                    echo "<font color='red'> Name field is empty. </font><br/>";
                                }

                                if(empty($birthdate)) {
                                    echo "<font color='red'> Birthdate field is empty. </font><br/>";
                                }

                                if(empty($email)) {
                                    echo "<font color='red'> Email field is empty. </font><br/>";
                                }
                                echo "<br/><form action='javascript:self.history.back();' method='post' name='form1'>
                                    <input type='submit' class='btn btn-success btn-sm' name='submit' value='Go Back'>
                                </form>";
                                

                            } else {
                                $result = mysqli_query($mysqli, "INSERT INTO users(name, birthdate, age, email) VALUES ('$name','$birthdate','$diff->y','$email')");
                                echo "<font color='green'> Data Added Successfully. </font>";
                                echo "<br/><form action='index.php' method='post' name='form1'><input type='submit' class='btn btn-success btn-sm' name='submit' value='View Result'></form>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
</div>

</body>
</html>