<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

if (isset($_POST['post'])) {
    $title = trim($_POST['title']);
    $desc  = trim($_POST['description']);

    if(mysqli_query($conn,
        "INSERT INTO problems(user_id,title,description)
         VALUES('$user_id','$title','$desc')")){
        $message = "Problem posted successfully";
    } else {
        $message = "Something went wrong";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Dashboard | LSN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
body{
  background:#f4f6f9;
  font-family:'Segoe UI',sans-serif;
}
.navbar{
  box-shadow:0 4px 15px rgba(0,0,0,.1)
}
.card{
  border:none;
  border-radius:20px;
  box-shadow:0 10px 30px rgba(0,0,0,.08)
}
.form-control, textarea{
  border-radius:12px;
  padding:12px
}
.btn{border-radius:50px;font-weight:600}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">LSN User</a>
    <div class="ms-auto">
      <a href="../logout.php" class="btn btn-light btn-sm rounded-pill">Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card p-4">
        <h4 class="fw-bold mb-3">
          <i class="bi bi-exclamation-circle"></i> Report a Problem
        </h4>

        <?php if($message): ?>
          <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="post">
          <div class="mb-3">
            <label class="form-label">Problem Title</label>
            <input type="text" name="title" class="form-control" placeholder="Eg: Broken street light" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control" placeholder="Describe the problem clearly" required></textarea>
          </div>

          <button name="post" class="btn btn-primary w-100">Post Problem</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>