

<?php require 'navbar.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Faculty Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .registration-container {
      max-width: 600px;
      background-color: white;
      padding: 30px;
      margin: 50px auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    button[type="submit"] {
      background-color: #198754;
      color: white;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #146c43;
    }
  </style>
</head>
<body>

  <div class="registration-container">
    <h2>Faculty Registration</h2>
    <form method="POST" action="">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
      </div>

      <div class="mb-3">
        <label for="mobile" class="form-label">Mobile No</label>
        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile No" required>
      </div>

      <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="dob" name="dob" required>
      </div>

      <div class="mb-3">
        <label for="qualification" class="form-label">Qualification</label>
        <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email ID</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email ID" required>
      </div>

      <div class="mb-3">
        <label for="pass" class="form-label">Password</label>
        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
      </div>

      <button type="submit" class="btn btn-success w-100" name="rrr">Register</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php
include 'connection.php';

if (isset($_POST['rrr'])) {
	$name=$_POST['name'];
	$mobile=$_POST['mobile'];
	$dob=$_POST['dob'];
	$qqq=$_POST['qualification'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];


	$sql="INSERT INTO faculty (name,mobileno,date,qualification,email,password) values ('$name','$mobile','$dob','$qqq','$email','$pass')";

	$done=mysqli_query($conn,$sql);


	header("location:login.php");
	

	// code...
}


?>
</html>
