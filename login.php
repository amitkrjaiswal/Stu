<?php require 'navbar.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2 {
      color: #333;
      text-align: center;
      font-size: 38px;
      margin: 40px 0 20px;
    }

    .login-container {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 30px;
    }

    .profile-img {
      height: 100px;
      width: 100px;
      object-fit: cover;
      border-radius: 50%;
      display: block;
      margin: 0 auto 20px;
    }

    input[type="email"],
    input[type="password"] {
      height: 45px;
      border-radius: 8px;
    }

    button {
      background-color: #198754;
      color: #fff;
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #157347;
    }

    @media (max-width: 768px) {
      .col-md-6 img {
        height: 250px;
        object-fit: cover;
      }
    }
    p{
      text-align: center;
      
    }
    a{
      text-decoration: none;
    }
  </style>
</head>
<body>

<h2>Smart College of Engineering & Technology</h2>

<div class="container">
  <div class="row justify-content-center align-items-center">
    <div class="col-md-6 mb-4">
      <img src="https://images.pexels.com/photos/164660/pexels-photo-164660.jpeg?cs=srgb&dl=pexels-pixabay-164660.jpg&fm=jpg" class="img-fluid rounded">
    </div>

<?php
include 'connection.php';
session_start();

if($_SERVER['REQUEST_METHOD']=="POST"){

$email=mysqli_real_escape_string($conn,$_POST['email']);


$password=mysqli_real_escape_string($conn,$_POST['pass']);


$sql="SELECT id FROM faculty Where email='$email' AND password='$password'";


$result=mysqli_query($conn,$sql);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

$count=mysqli_num_rows($result);

if($count==1){
  $_SESSION['user_name']=$email;

  header("location:dashboard.php");

  die();
}else{
  echo "Email and password Not match";
}
}


?>


    <div class="col-md-6">
      <div class="login-container">
        <form action="" method="post">
          <img src="https://static.vecteezy.com/system/resources/previews/005/129/844/non_2x/profile-user-icon-isolated-on-white-background-eps10-free-vector.jpg" class="profile-img">

          <div class="mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email ID" required>
          </div>

          <div class="mb-3">
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>
          </div>

          <button type="submit" name="btn">Login</button>
          <p>New Registration?<a href="Registration.php">Click here</a></p>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
