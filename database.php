<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "hero";

$conn = new mysqli($host,$username,$password,$db_name);
if($conn -> connect_error)
{
    die("connection erroe");
}

session_start();
if(isset($_SESSION['username']))
    {
    // echo $_SESSION['username'] ."<BR>";
    // echo $_SESSION['password'] ;
    // echo "Welcome to database";
    }
    else{
        echo "<script> location.href='login.php'</script>";
    }
if(isset($_REQUEST['logout']))
{
    session_unset();
    session_destroy();
    echo "<script> location.href = 'login.php'</script>";
}
if(isset($_REQUEST['admin_submits']))
{
    $sl_no = $_REQUEST['sl_no'];
    $admin_feedback = $_REQUEST['admin_feedbacks'];
    $sql = "UPDATE service SET admin_feedback = '$admin_feedback' WHERE sl_no = {$_REQUEST['sl_no']}" ;
    $conn -> query($sql);
}
if(isset($_REQUEST['admin_submitb']))
{
    $sl_no = $_REQUEST['sl_no'];
    $admin_feedback = $_REQUEST['admin_feedbackb'];
    $sql = "UPDATE buynow SET admin_feedback = '$admin_feedback' WHERE sl_no = {$_REQUEST['sl_no']}" ;
    $conn -> query($sql);
}
if(isset($_REQUEST['admin_submitc']))
{
    $sl_no = $_REQUEST['sl_no'];
    $admin_feedback = $_REQUEST['admin_feedbackc'];
    $sql = "UPDATE contactus SET admin_feedback = '$admin_feedback' WHERE sl_no = {$_REQUEST['sl_no']}" ;
    $conn -> query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/navbtn.css">
    <style>
        .databasecontainer{
            margin: 0%;
            padding: 0%;
            display: grid;
            grid-template-columns: 0.5fr 4.5fr ;
            
        }
        #left{
            height: 580px;
            border: 1px solid rgb(172, 170, 170) ;
            position: sticky;
            top: 0px;
        }
        #topscript{
           
            
            position: relative;
            left: 14px;
            font-size: large;
            font-weight: bolder;
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: blue;
        }
        .admin_feedback{
            color: green;
            font-family:Verdana, Geneva, Tahoma, sans-serif;
            
        }
        
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" id="home" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="sDatabaseBtn" href="#">Servicing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="bDatabaseBtn" href="#">Buy Now</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="cDatabaseBtn" href="#">Contact Us</a>
        </li>
        
      </ul>
      <form class="d-flex" action="" method= "POST">
        <button class="btn btn-outline-danger" type="submit" name ="logout" value = "logout">Log Out</button>
      </form>
    </div>
  </div>
</nav>

<div class="databasecontainer">
    <div class="left" id="left">
        <div class="list-group" id="listgroup">
            <a href="#todayservicing" class="list-group-item list-group-item-action" aria-current="true">
                Today's Servicing
            </a>
            <a href="#servicingdatabase" class="list-group-item list-group-item-action" >Servicing</a>
            <a href="#buynowdatabase" class="list-group-item list-group-item-action">Buy Now</a>
            <a href="#contactusdatabase" class="list-group-item list-group-item-action">Contact Us</a>
            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">Details</a>
        </div>
        <div class="topscript"  id="topscript">
          <p id="timeshow"></p>
          <script>
              
            setInterval(updateTime, 1000);
            function updateTime() {
                var dt = new Date();
                var tdate = (dt.getDate() ); 
                var tmonth = (dt.getMonth() ); 
                var tyear = dt.getFullYear();
                var thours = dt.getHours();
                var tminutes = dt.getMinutes ();
                var tsec = dt.getSeconds();
                  timeshow.innerHTML = tdate + "-"+ (tmonth +1) + "-" + tyear + "<br>" + thours + "-"+ tminutes + "-" + tsec + "<br>";
            }
          </script>
             
      </div>
    </div>
    <div class="mid" style="padding: 0px 5px 0px 5px;">
        <div class="todayservicing" id="todayservicing">
        <H3>TODAY'S SERVICING</H3>
        <?php
        //Show data or retrive data from database
             $sql = "SELECT * FROM service WHERE date = curdate()";
             $result = mysqli_query($conn,$sql);
             if(mysqli_num_rows($result)>0)
             {
                 echo '<table class="table">';
                 echo "<thead>";
                 echo "<tr>";
                 echo "<th>DATE</th>";
                 echo "<th>NAME</th>";
                 echo "<th>EMAIL</th>";
                 echo "<th>MOBILE</th>";
                 echo "<th>ADDRESS</th>";
                 echo "<th>BIKE</th>";
                 echo "<th>ADMIN FEEDBACK</th>";
                 echo "</tr>";
                 echo "</thead>";
                 echo "<tbody>";
                     while($row = mysqli_fetch_assoc($result))
                     {
                         echo "<tr>";
                         echo "<td>" . $row['date'] . "</td>";
                          echo "<td>" . $row['name'] . "</td>";
                          echo "<td>" . $row['email'] . "</td>";
                          echo "<td>" . $row['mobile'] . "</td>";
                          echo "<td>" . $row['address'] . "</td>";
                          echo "<td>" . $row['bike_name'] . "</td>";
                          echo "<td class = 'admin_feedback' >" . $row['admin_feedback'] . "</td>";
                          echo '<td> <form action="" method="post"><textarea class="form-control" name="admin_feedbacks" id="" rows="1"></textarea></td>';
                          echo '<td> <input type="hidden" name = "sl_no" value='. $row['sl_no'].'> <input type="submit" class="btn btn-primary" name="admin_submits" value="Submit"></td> ';
                          
                         
                          echo '</form>';
                         echo "</tr>";
                     }
                     echo "</tbody>";
     
                 echo '</table>';
             }
             else
             {
                 
                 echo "0 result found!";
             }
             ?>
             
             </div>
             <div class="servicingdatabase" id="servicingdatabase">
                <H3>SERVICING DATABASE</H3>
                <?php
                //Show data or retrive data from database
                     $sql = "SELECT * FROM service";
                     $result = mysqli_query($conn,$sql);
                     if(mysqli_num_rows($result)>0)
                     {
                         echo '<table class="table">';
                         echo "<thead>";
                         echo "<tr>";;
                         echo "<th>DATE</th>";
                         echo "<th>NAME</th>";
                         echo "<th>EMAIL</th>";
                         echo "<th>MOBILE</th>";
                         echo "<th>ADDRESS</th>";
                         echo "<th>BIKE</th>";
                         echo "<th>ADMIN FEEDBACK</th>";
                         echo "<th>FEEDBACK</th>";
                         echo "</tr>";
                         echo "</thead>";
                         echo "<tbody>";
                             while($row = mysqli_fetch_assoc($result))
                             {
                                 echo "<tr>";
                                 echo "<td>" . $row['date'] . "</td>";
                                  echo "<td>" . $row['name'] . "</td>";
                                  echo "<td>" . $row['email'] . "</td>";
                                  echo "<td>" . $row['mobile'] . "</td>";
                                  echo "<td>" . $row['address'] . "</td>";
                                  echo "<td>" . $row['bike_name'] . "</td>";
                                  echo "<td class='admin_feedback'>" . $row['admin_feedback'] . "</td>";
                                  echo '<td> <form action="" method="post"><textarea class="form-control" name="admin_feedbacks" id="" rows="1"></textarea></td>';
                                  echo '<td> <input type="hidden" name = "sl_no" value='. $row['sl_no'].'> <input type="submit" class="btn btn-primary" name="admin_submits" value="Submit"></td> ';
                                  
                                 
                                  echo '</form>';
                                 echo "</tr>";
                             }
                             echo "</tbody>";
             
                         echo '</table>';
                     }
                     else
                     {
                         
                         echo "0 result found!";
                     }
                     ?>
             </div>
             <div class="buynowdatabase" id="buynowdatabase">
                <H3>BUY NOW DATABASE</H3>
                <?php
                //Show data or retrive data from database
                     $sql = "SELECT * FROM buynow";
                     $result = mysqli_query($conn,$sql);
                     if(mysqli_num_rows($result)>0)
                     {
                         echo '<table class="table">';
                         echo "<thead>";
                         echo "<tr>";
                         echo "<th>DATE</th>";
                         echo "<th>NAME</th>";
                         echo "<th>EMAIL</th>";
                         echo "<th>MOBILE</th>";
                         echo "<th>ADDRESS</th>";
                         echo "<th>ZIP</th>";
                         echo "<th>BIKE</th>";
                         echo "<th>ADMIN FEEDBACK</th>";
                         echo "<th>FEEDBACK</th>";
                         echo "</tr>";
                         echo "</thead>";
                         echo "<tbody>";
                             while($row = mysqli_fetch_assoc($result))
                             {
                                 echo "<tr>";
                                 echo "<td>" . $row['date'] . "</td>";
                                  echo "<td>" . $row['name'] . "</td>";
                                  echo "<td>" . $row['email'] . "</td>";
                                  echo "<td>" . $row['mobile'] . "</td>";
                                  echo "<td>" . $row['address'] . "</td>";
                                  echo "<td>" . $row['zip'] . "</td>";
                                  echo "<td>" . $row['bike'] . "</td>";
                                  echo "<td class='admin_feedback'>" . $row['admin_feedback'] . "</td>";
                                  echo '<td> <form action="" method="post"><textarea class="form-control" name="admin_feedbackb" id="" rows="1"></textarea></td>';
                                  echo '<td> <input type="hidden" name = "sl_no" value='. $row['sl_no'].'> <input type="submit" class="btn btn-primary" name="admin_submitb" value="Submit"></td> ';
                                  
                                 
                                  echo '</form>';
                                 echo "</tr>";
                             }
                             echo "</tbody>";
             
                         echo '</table>';
                     }
                     else
                     {
                         
                         echo "0 result found!";
                     }
                     ?>
             </div>
             <div class="contactusdatabase" id="contactusdatabase">
                <H3>CONTACT US DATABASE</H3>
                <?php
                //Show data or retrive data from database
                     $sql = "SELECT * FROM contactus";
                     $result = mysqli_query($conn,$sql);
                     if(mysqli_num_rows($result)>0)
                     {
                         echo '<table class="table">';
                         echo "<thead>";
                         echo "<tr>";
                         echo "<th>DATE</th>";
                         echo "<th>NAME</th>";
                         echo "<th>EMAIL</th>";
                         echo "<th>FEEDBACK</th>";
                         echo "<th>ADMIN FEEDBACK</th>";
                         echo "<th>FEEDBACK</th>";
                         echo "</tr>";
                         echo "</thead>";
                         echo "<tbody>";
                             while($row = mysqli_fetch_assoc($result))
                             {
                                 echo "<tr>";
                                 echo "<td>" . $row['date'] . "</td>";
                                  echo "<td>" . $row['name'] . "</td>";
                                  echo "<td>" . $row['email'] . "</td>";
                                  echo "<td>" . $row['feedback'] . "</td>";
                                  echo "<td class='admin_feedback'>" . $row['admin_feedback'] . "</td>";

                                  echo '<td> <form action="" method="post"><textarea class="form-control" name="admin_feedbackc" id="" rows="1"></textarea></td>';
                                  echo '<td> <input type="hidden" name = "sl_no" value='. $row['sl_no'].'> <input type="submit" class="btn btn-primary" name="admin_submitc" value="Submit"></td> ';
                                  
                                 
                                  echo '</form>';
                                 echo "</tr>";
                             }
                             echo "</tbody>";
             
                         echo '</table>';
                     }
                     else
                     {
                         
                         echo "0 result found!";
                     }
                     ?>
             </div>
    </div>
    <div class="right">
       
    </div>
</div>
<script>
    var left = document.getElementById("left");
    var tsData = document.getElementById("todayservicing");
    var sData = document.getElementById("servicingdatabase");
    var bData = document.getElementById("buynowdatabase");
    var cData = document.getElementById("contactusdatabase");
    var homeBtn = document.getElementById("home");
    var sDataBtn = document.getElementById("sDatabaseBtn");
    var bDataBtn = document.getElementById("bDatabaseBtn");
    var cDataBtn = document.getElementById("cDatabaseBtn");

    if(homeBtn.addEventListener("click",()=>{
        left.style.display = "block";
        sData.style.display = "block";
        tsData.style.display = "block";
        bData.style.display = "block";
        cData.style.display = "block";
    }));

    if(sDataBtn.addEventListener("click",()=>{

        sData.style.display = "block";
        tsData.style.display = "none";
        bData.style.display = "none";
        cData.style.display = "none";
        left.style.display = "none";
    }));

    if(bDataBtn.addEventListener("click",()=>{
        bData.style.display = "block";
        tsData.style.display = "none";
        sData.style.display = "none";
        cData.style.display = "none";
        left.style.display = "none";
    }));

    if(cDataBtn.addEventListener("click",()=>{
        cData.style.display = "block";
        tsData.style.display = "none";
        bData.style.display = "none";
        sData.style.display = "none";
        left.style.display = "none";
    }));
   
    
</script>
</body>
</html>