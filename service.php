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
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service</title>
  <link rel="stylesheet" href="css/navbtn.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <style>
    .buyNow {
      padding: 15px;
      margin: 10px;
      border: 2px solid rgb(214, 214, 214);
      background-color: rgb(228, 250, 250);
      height: 100%;
      width: 70%;
      box-shadow: 1px 1px 5px 2px black;
    }

    .messagecontainer {
      margin: 0%;
      height: 125%;
      width: 100%;
      background-color: rgb(7, 7, 7);
      opacity: 0.9;
      position: absolute;
      top: 0%;
      z-index: 2;
    }

    .message {
      display: block;
      border: 2px solid black;
      border-radius: 8px;
      background-color: rgb(219, 253, 253);
      height: 400px;
      width: 500px;
      margin-top: 100px;
      box-shadow: 0px 50px 140px rgb(248, 247, 247);
      animation: animation1 0.3s ease-in 0s 1 backwards;
    }

    @keyframes animation1 {
      from {
        width: 200px;
        height: 200px;
      }

      to {
        width: 500px;
        height: 400px;
      }
    }

    .message h1 {
      margin-top: 100px;
    }

    .contactusbtn {
      position: relative;
      top : 45px;
      border: 1px solid black;
      border-radius: 15px;
      background-color: red;
      font-size: 18px;
    }

    .message a {
      text-decoration: none;
      color: white;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">Hero</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.html">Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Products
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="Bikes.html">Bikes</a></li>

              <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="accessories.html">Accessories</a></li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="service.php">Service</a>
        </li>

        </ul>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button class="btn btn-primary me-md-2" type="button"><a href="mailto:heromotor@gmail.com">Email</a></button>
          <button class="btn btn-primary" type="button"><a href="contactus.php">Contact Us</a></button>
        </div>
      </div>
    </div>
  </nav>

  <?php
if(isset($_REQUEST['name']))
{
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];
  $mobile = $_REQUEST['mobile'];
  $address = $_REQUEST['address'];
  $dateforservicing = $_REQUEST['dateforservicing'];
  $bikename = $_REQUEST['bikename'];
  $bikemodel = $_REQUEST['bikemodel'];
  
  $sql = "INSERT INTO service(name,email,mobile,address,date_of_servicing,bike_name,bike_model,date,time) VALUES('$name','$email','$mobile','$address','$dateforservicing','$bikename','$bikemodel',curdate(),curtime())";
  if($conn->query($sql) === TRUE)
  {
    ?>
    
    <div class="messagecontainer">
    <center>
    <div class="message">
      <h1>Thank You</h1>
      <p>Your feedback has been submitted.</p>
      <button class="contactusbtn"><a href="index.html"> Back to home</a></button>
    </div>
  </center>
  </div>
  <?php }
  else{ ?>
  <div class="messagecontainer">

    <center>
      <div class="message">
        <h1>failed</h1>
        <button class="contactusbtn">Back to home</button>
      </div>
    </center>
  </div>

  <?php }} ?>
  <div class="buyNow">
    <h3>Enter Details</h3>
    <form class="row g-3" action="" method="POST">
      <div class="mb-3">
          <label for="formGroupExampleInput" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder=""
            required="required">
        </div>

        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="inputEmail4" required="required">
        </div>
        <div class="col-md-6">
          <label for="inputPhone4" class="form-label">Mobile No.</label>
          <input type="Phone" name="mobile" class="form-control" id="inputPhone4" required="required">
        </div>
        <div class="col-12">
          <label for="inputAddress" class="form-label">Address</label>
          <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St"
            required="required">
        </div>

        <div class="col-md-3">
          <label for="dateforservicing" class="form-label">Date for Servicing</label>
          <input type="date" name="dateforservicing" class="form-control" id="dateforservicing" required="required">
        </div>

        <div class="col-md-12">
          <label for="bikename" class="form-label">Bike Name</label>
          <input type="text" name="bikename" class="form-control" id="bikename" placeholder="" required="required">
        </div>
        <div class="col-md-12">
          <label for="bikemodel" class="form-label">Bike Model</label>
          <input type="text" name="bikemodel" class="form-control" id="bikemodel" placeholder="" required="required">
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
  </div>

  <div class="footer">
    <div class="footercontainer">
      <div class="social-links">
        <a href="www.facebook.com"> <img src="img/fb_icon.png" alt=""></a>
        <a href="www.twitter.com"> <img src="img/twitter_icon.png" alt=""></a>
        <a href="www.youtube.com"> <img src="img/youtube_icon.png" alt=""></a>
        <a href="www.instagram.com"> <img src="img/instagram_icon.png" alt=""></a>
      </div>
      <p class="copytext">
        <a href="#">Terms and conditons</a>
        <a href="#">Declainer</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Rules and Regulations</a>
      </p>
      <p class="copy-text">Copyright Hero MotoCorp Ltd. 2020.<br> All Rights Reserved.</p>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
    crossorigin="anonymous"></script>
</body>

</html>