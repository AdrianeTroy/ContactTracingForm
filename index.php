<?php

  //initialize session
  session_start();

  if( !isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: login.php');
    exit;
  }
?>
<?php

include_once("config.php");

$result = mysqli_query($mysqli, "SELECT * FROM users");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Homepage</title>
</head>
<style>
    .tr1 {
        font-weight: bold;
        font-size: 20px;
        text-align: center;
        background-color:#cccccc;
    }
    .welcome {
      font-size: 20px;
    }
</style>
<body class="bg-primary">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card card-body bg-light mt-5">
                  <p class="welcome">Welcome to the dashboard, <b>Admin</b>!</p>
                  <p><a href="logout.php" class="btn btn-danger btn-sm">Logout</a></p>
                    <h1 class="text-center"><?php echo "Contact Tracing Form"; ?></h1><br/>
                        <table class="table">
                            <tr class="tr1">
                                <td>Name</td>
                                <td>Birthdate</td>
                                <td>Age</td>
                                <td>Email</td>
                                <td>Date Visited</td>
                                <td>Update</td>
                            </tr>
                            <?php

                                while( $res = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>".$res['name']."</td>";
                                    echo "<td>".$res['birthdate']."</td>";
                                    echo "<td>".$res['age']."</td>";
                                    echo "<td>".$res['email']."</td>";
                                    echo "<td>".$res['date_created']."</td>";
                                    echo "<td>
                                    <a href=\"edit.php?id=$res[id]\">Edit</a> | 
                                    <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </table> <br/>
                                    <form action="add.html" method="post" name="form1">
                                    <input type="submit" class="btn btn-success btn-sm" value="Add New Data">
                                    </form>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>