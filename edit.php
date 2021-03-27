<?php
 include_once("config.php");

    if ( isset($_POST['update']))
    {
        $id = mysqli_real_escape_string($mysqli, $_POST['id']);
        $name = mysqli_real_escape_string($mysqli, $_POST['name']);
        $birthdate = mysqli_real_escape_string($mysqli, $_POST['dob']);
        $today = date("Y-m-d");
        $diff = date_diff(date_create($birthdate), date_create($today));
        $diff->format('%y');
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);

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
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
            

        } else {

            $result = mysqli_query($mysqli, "UPDATE users set name='$name', birthdate='$birthdate', email='$email' WHERE id='$id'");
            header("Location: index.php");
        }
    }

?>

<?php

    $id = $_GET['id'];

    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

    while($res = mysqli_fetch_array($result))
    {
        $name = $res['name'];
        $birthdate = $res['birthdate'];
        $email = $res['email'];
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Edit Data</title>
</head>
<body class="bg-primary">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card card-body bg-light mt-5">
                <h1 class="text-center"><?php echo "Edit Data"; ?></h1><br/>
                    <form name="form1" method="post" action="edit.php">
                        <table class="table">
                                <tr>
                                    <td>Name</td>
                                    <td><input type="text" name="name" value="<?php echo $name;?>"></td>
                                </tr>
                                <tr>
                                    <td>Birthdate</td>
                                    <td><input type="date"  id="dob" name="dob" value="<?php echo $birthdate;?>"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" name="email" value="<?php echo $email;?>"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                    </td>
                                    <td><input type="submit" class="btn btn-success btn-sm" name="update" value="Update"></td>
                                </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>