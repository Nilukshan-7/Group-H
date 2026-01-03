<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'validator') {
    header("Location: ../login.php");
    exit();
}

// Approve / Reject actions
if (isset($_GET['approve'])) {
    mysqli_query($conn,
        "UPDATE problems SET status='approved' WHERE id=".$_GET['approve']
    );
    header("Location: dashboard.php");
}

if (isset($_GET['reject'])) {
    mysqli_query($conn,
        "UPDATE problems SET status='rejected' WHERE id=".$_GET['reject']
    );
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Validator Dashboard | LSN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
body{background:#f4f6f9;font-family:'Segoe UI',sans-serif}
.navbar{box-shadow:0 4px 15px rgba(0,0,0,.1)}
.card{border:none;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,.08)}
.badge{border-radius:12px}
.btn{border-radius:50px;font-weight:600}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">LSN Validator</a>
    <div class="ms-auto">
      <a href="../logout.php" class="btn btn-light btn-sm rounded-pill">Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">

  <!-- Stats -->
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <h6 class="text-muted">Pending Problems</h6>
        <h3 class="fw-bold mb-0"><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT id FROM problems WHERE status='pending'")); ?></h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <h6 class="text-muted">Approved Problems</h6>
        <h3 class="fw-bold mb-0"><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT id FROM problems WHERE status='approved'")); ?></h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <h6 class="text-muted">Your Role</h6>
        <h5 class="fw-bold mb-0">Problem Validator</h5>
      </div>
    </div>
  </div>

  <!-- Heading -->
  <h4 class="fw-bold mb-2"><i class="bi bi-clipboard-check"></i> Pending Problem Requests</h4>
  <p class="text-muted mb-4">Review reported problems carefully. Approve only genuine community issues. Reject spam or unclear reports.</p>

  <div class="row g-4">
  <?php
  $result = mysqli_query($conn,
      "SELECT * FROM problems WHERE status='pending'"
  );

  if(mysqli_num_rows($result)==0){
      echo '<div class="col-12"><div class="alert alert-success">No pending problems 🎉</div></div>';
  }

  while ($row = mysqli_fetch_assoc($result)) {
  ?>
    <div class="col-md-6">
      <div class="card p-4">
        <h5 class="fw-bold"><?= $row['title'] ?></h5>
        <p class="text-muted"><?= $row['description'] ?></p>
        <span class="badge bg-secondary mb-3">Pending Review</span>
        <div class="d-flex gap-2">
          <a href="?approve=<?= $row['id'] ?>" class="btn btn-success btn-sm w-50">Approve</a>
          <a href="?reject=<?= $row['id'] ?>" class="btn btn-danger btn-sm w-50">Reject</a>
        </div>
      </div>
    </div>
  <?php } ?>
  </div>

  <!-- Guidelines -->
  <div class="card p-4 mt-5">
    <h5 class="fw-bold mb-2"><i class="bi bi-info-circle"></i> Validation Guidelines</h5>
    <ul class="text-muted mb-0">
      <li>Approve only real and location-based problems.</li>
      <li>Reject duplicate, fake, or unclear submissions.</li>
      <li>Your decision affects solution providers and citizens.</li>
      <li>Maintain fairness and transparency.</li>
    </ul>
  </div>
</div>

<footer class="text-center text-muted py-4">
  © 2025 Local Solution Network • Validation builds trust
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>