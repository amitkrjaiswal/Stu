<?php include 'navbar.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .dashboard-container {
      max-width: 800px;
      margin: 40px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .dashboard-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .btn-custom {
      border-radius: 30px;
      margin: 10px 5px;
      padding: 10px 25px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    select, input[type="text"] {
      height: 45px;
    }

    button[type="submit"] {
      background-color: #198754;
      border: none;
      color: white;
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      margin-top: 20px;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #146c43;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="dashboard-container">
    <div class="dashboard-header">
      <h3>🎓 Add New Student</h3>
      <a href="addrec.php" class="btn btn-primary btn-custom">➕ Add Records</a>
      <a href="logout.php" class="btn btn-danger btn-custom">🚪 Logout</a>
    </div>

    <form method="POST" action="">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Student Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required />
        </div>
        <div class="col-md-6">
          <label for="roll" class="form-label">Roll No</label>
          <input type="text" class="form-control" id="roll" name="roll" placeholder="Roll Number" required />
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="course" class="form-label">Course</label>
          <select name="course" id="course" class="form-select" required>
            <option value="">Select Course</option>
            <option value="Web Development">Web Development</option>
            <option value="AI">AI</option>
            <option value="ML">ML</option>
            <option value="Digital Marketing">Digital Marketing</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="sem" class="form-label">Semester</label>
          <select name="semester" id="sem" class="form-select" required>
            <option value="">Select Semester</option>
            <?php for($i=1; $i<=8; $i++): ?>
              <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
          </select>
        </div>
      </div>

      <div class="mb-4">
        <label for="branch" class="form-label">Branch</label>
        <select name="branch" id="branch" class="form-select" required>
          <option value="">Select Branch</option>
          <option value="BCA">BCA</option>
          <option value="BTech">BTech</option>
          <option value="BBA">BBA</option>
          <option value="BSc">BSc</option>
        </select>
      </div>

      <button type="submit" name="add">Add Student</button>
    </form>
  </div>
</div>
<?php
include 'connection.php';

if(isset($_POST['add'])){
	$name=$_POST['name'];
	$roll=$_POST['roll'];
	$course=$_POST['course'];
	$semester=$_POST['semester'];
	$branch=$_POST['branch'];

	$sql="INSERT INTO student (name,rollno,course,semester,branch) values ('$name','$roll','$course','$semester','$branch')";


	$done=mysqli_query($conn,$sql);
}


?>

<div class="container my-4">
  <h4 class="text-center mb-3">📋 Student Records</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead class="table-dark">
        <tr>
          <th scope="col">Sr No</th>
          <th scope="col">Name</th>
          <th scope="col">Roll No</th>
          <th scope="col">Course</th>
          <th scope="col">Semester</th>
          <th scope="col">Branch</th>
        </tr>
      </thead>
      
        <!-- Sample row (Replace this with PHP dynamic rows) -->
        	<?php
include 'connection.php'; // Make sure this is included before running the query

$sql = "SELECT * FROM student";  // FIX 1: Correct SQL syntax
$result = mysqli_query($conn, $sql);

$i = 1;
if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {  // FIX 2: Missing closing )
?>
  <tr>
    <td><?php echo $i++; ?></td>  <!-- FIX 3: Proper counter display -->
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['rollno']; ?></td>
    <td><?php echo $row['course']; ?></td>
    <td><?php echo $row['semester']; ?></td>
    <td><?php echo $row['branch']; ?></td>
  </tr>
<?php
  } // end while
} else {
  echo "<tr><td colspan='6' class='text-center'>No records found.</td></tr>";
}
?>

  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
