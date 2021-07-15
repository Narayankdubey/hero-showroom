<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "hero";

    $conn = new mysqli($host,$username,$password,$database);
    if(($conn->connect_error))
    {
        die('connection failed');
    }
   
    
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $mobile = $_REQUEST['mobile'];
    $address = $_REQUEST['address'];
    $city = $_REQUEST['city'];
    
    $zip = $_REQUEST['zip'];
    $bikename = $_REQUEST['bikename'];
  
    
   
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>message</title>
    <style>
        body{
            background-color: rgb(253, 198, 198);
        }
        .container{
            background-color: rgb(38, 117, 117);
            border: 2px solid black;
            border-radius: 8px;
            display: inline-block;
            font-size: 25px;
            width: 750px;
            height: 400px;
            box-shadow: 0px 100px 80px black;
        }
        h2{
            margin-top: 100px;
        }
        p{
            margin: 5px;
        }
        .databasebtn{
            width: 155px;
            height: 45px;
            background-color: brown;
            border: 1px solid black;
            border-radius: 15px;
            box-shadow: 1px 1px 3px black;

        }
        .databasebtn:hover{
           
            background-color: rgb(175, 55, 55);
            box-shadow: 0px 0px 15px black;
            cursor: pointer;
        }
        .databasebtn a{
           
           
            text-decoration: none;
            color: white;
            font-size: 16px;
        }
        #thank{
            color: rgb(5, 253, 5);
            text-shadow: 2px 2px 4px black;
        }
    </style>
</head>
<body>
    <?php
    
    $sql ="INSERT INTO buynow(name,email,mobile,address,city,zip,bike,date,time) values('$name','$email','$mobile','$address','$city','$zip','$bikename',curdate(),curtime())";
    if($conn -> query($sql) === TRUE)
    {
    ?>
    <center>
        <div class="container">
            <h2 id="thank">Thank You !!</h2>
            <p>Your request has been sent successfully.</p><br>
            <p>Our executive will contact you soon.</p><br>
            <button class="databasebtn">
                <a href="index.html">Back to homepage</a>
            </button>
            
        </div>
    </center>
        <?php   
    }
    else{ ?>
        <center>
            <div class="container">
                <h2 style="color: rgba(255, 0, 0, 0.795);">Sorry!</h2>
                <p>Failed to submit.</p><br>
                <button class="databasebtn"><a href="index.html">Back to homepage</a></a></button>
            </div>
        </center>
    <?php
    }
    ?>
</body>
</html>

