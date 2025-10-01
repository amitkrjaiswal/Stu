
<?php

include 'navbar.php';

?>

<?php

include 'connection.php';
$idt=$_GET['id'];

$sql="SELECT * FROM record WHERE id='$idt'";


$result=mysqli_query($conn,$sql);

while ($row=mysqli_fetch_assoc($result)) {
	


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .edit-container {
      max-width: 700px;
      margin: 50px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .edit-container h3 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    button[type="submit"] {
      background-color: #0d6efd;
      border: none;
      color: white;
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      font-weight: bold;
      transition: 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #084298;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="edit-container">
    <h3>✏️ Edit Student Details</h3>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="name" class="form-label">Student Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter student name" value="<?php echo $row['name'];?>" required />
      </div>

      <div class="mb-3">
        <label for="course" class="form-label">Course Name</label>
        <input type="text" class="form-control" id="course" name="course" placeholder="Enter course name" value="<?php echo $row['course'];?>" required />
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="th" class="form-label">Theory (out of 80)</label>
          <input type="number" class="form-control" id="th" name="theory" min="0" max="80" value="<?php echo $row['theory'];?>" required />
        </div>
        <div class="col-md-6 mb-3">
          <label for="ppp" class="form-label">Practical (out of 20)</label>
          <input type="number" class="form-control" id="ppp" name="practical" min="0" max="20"  value="<?php echo $row['practical'];?>"required />
        </div>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Student Image</label>
        <input type="file" class="form-control" id="image" name="image"  />
      </div>

      <button type="submit" name="edit">Update Student</button>
    </form>
  </div>
</div>
<?php } ?>

<?php

include 'connection.php';

if (isset($_POST['edit'])) {
  $name=$_POST['name'];
  $course=$_POST['course'];
  $theory=$_POST['theory'];
  $practical=$_POST['practical'];

  $file=$_FILES['image']['name'];

  $file_doc =$_FILES['image']['tmp_name'];

  move_uploaded_file($file_doc,"img/".$file);

$sql="UPDATE record SET name='$name',course='$course',theory='$theory',practical='$practical',image='$file' WHERE id='$idt'";

  $result=mysqli_query($conn,$sql);
  header("location:addrec.php");
  
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
