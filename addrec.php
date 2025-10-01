<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add Student Records</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .dashboard-container {
      max-width: 900px;
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

    button[type="submit"] {
      background-color: #198754;
      border: none;
      color: white;
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      margin-top: 20px;
      font-weight: bold;
    }

    button[type="submit"]:hover {
      background-color: #146c43;
    }

    img.thumb {
      height: 50px;
      width: 50px;
      object-fit: cover;
      border-radius: 5px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="dashboard-container">
    <div class="dashboard-header">
      <h3>➕ Add Student Records</h3>
      <a href="dashboard.php" class="btn btn-primary btn-custom">Back</a>
      <a href="logout.php" class="btn btn-danger btn-custom">Logout</a>
    </div>

    <form method="POST" action="" enctype="multipart/form-data">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Student Name</label>
          <select name="name" class="form-select" id="name" required>
            <option value="" selected disabled>Select Name</option>
            <?php
              include 'connection.php';
              $sql = "SELECT DISTINCT name FROM student";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
              }
            ?>
          </select>
        </div>

        <div class="col-md-6">
          <label for="course" class="form-label">Course Name</label>
          <select name="course" class="form-select" id="course" required>
            <option value="" selected disabled>Select Course</option>
            <?php
              $sql = "SELECT DISTINCT course FROM student";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['course'].'">'.$row['course'].'</option>';
              }
            ?>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="th" class="form-label">Theory (out of 80)</label>
          <input type="number" class="form-control" id="th" name="theory" min="0" max="80" required />
        </div>

        <div class="col-md-6">
          <label for="ppp" class="form-label">Practical (out of 20)</label>
          <input type="number" class="form-control" id="ppp" name="practical" min="0" max="20" required />
        </div>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Student Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*" required />
      </div>

      <button type="submit" name="upload">Add Student</button>
    </form>
  </div>
</div>

<?php

include 'connection.php';

if (isset($_POST['upload'])) {
  $name=$_POST['name'];
  $course=$_POST['course'];
  $theory=$_POST['theory'];
  $practical=$_POST['practical'];

  $file=$_FILES['image']['name'];

  $file_doc =$_FILES['image']['tmp_name'];

  move_uploaded_file($file_doc,"img/".$file);

  $sql="INSERT INTO record (name,course,theory,practical,image) values('$name','$course','$theory','$practical','$file')";


  $result=mysqli_query($conn,$sql);
  
}


?>






<div class="container my-4">
  <h4 class="text-center mb-3">📋 Student Records</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead class="table-dark">
        <tr>
          <th>Sr No</th>
          <th>Name</th>
          <th>Course</th>
          <th>Theory</th>
          <th>Practical</th>
          <th>Image</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
<?php
include 'connection.php';

if (isset($_POST['delete'])) {
    $del = $_POST['de'];

    $delete = "DELETE FROM record WHERE id = '$del'";
    if (mysqli_query($conn, $delete)) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record');</script>";
    }
}
?>

        <?php




          $sql = "SELECT * FROM record"; // assuming you store records in 'marks' table
          $result = mysqli_query($conn, $sql);
          $i = 1;
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
          <td><?php echo $i++; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['course']; ?></td>
          <td><?php echo $row['theory']; ?>/80</td>
          <td><?php echo $row['practical']; ?>/20</td>
          <td><img src="img/<?php echo $row['image']; ?>" class="thumb"></td>
          <td><a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a></td>
          <td>
<form action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="de" value="<?php echo $row['id']; ?>">
        <button type="submit" name="delete" class="btn btn-danger btn-sm" id="lll" >Delete</button>

      </form>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
