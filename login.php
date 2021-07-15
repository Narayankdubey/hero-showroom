<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$db_name = "hero";

$conn = new mysqli($host,$username,$password,$db_name);
if($conn -> connect_error)
{
    die("connection erroe");
}


    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        .logincontainer {
            border: 1px solid rgba(0, 0, 0, 0.384);
            padding: 25px;
            width: 400px;
            height: 300px;
            position: absolute;
            top: 15px;
            left: 400px;
            box-shadow: 0px 5px 50px black;
        }
        #b2home{
            padding-top: 15px;
            position: absolute;
            right: 28px;
        }
        .error{
            color: red;
            font-size: small;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
    </style>
   
</head>

<body>
    <div class="logincontainer">
        <center><h4>Login</h4></center>
        <?php
            if(!isset($_SESSION['username']))
            {
                if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
                {
                    $user = $_REQUEST['username'];
                    $sqlcheck = "SELECT * FROM login WHERE username ='$user'";
                    
                   
                    $result = mysqli_query($conn,$sqlcheck);
                    $row = mysqli_fetch_assoc($result);
                
                    if(!empty($row))
                    {
                     if($_REQUEST['username'] === $row['username'] && $_REQUEST['password'] === $row['password'])
                         {
            
                          $_SESSION['username'] = $_REQUEST['username'];
                          $_SESSION['password'] = $_REQUEST['password'];
                          echo "<script> location.href= 'database.php'</script>";
                    
                         }else{
                             echo " <span class='error' id='wrongCred'>wrong credential</span> ";
                           
                        
                         }
                    
                }else{
                    echo " <span class='error' id='notFound'>User not found</span> ";
                }
            }
            }else{
                    echo "<script>location.href = 'database.php'</script>";
                }
            
                $conn -> close();
        ?>
        
        
        <form action="" method="post">

            <div class=" mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" name="username" class="form-control" id="username" placeholder="Name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.html" id="b2home">Back to Home</a>

        </form>
    </div>
    
  </body>

</html>