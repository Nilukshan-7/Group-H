<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'provider') {
    header("Location: ../login.php");
    exit();
}

$provider_id = $_SESSION['user_id'];
$message = "";

if (isset($_POST['submit_solution'])) {
    $pid = $_POST['problem_id'];
    $solution = trim($_POST['solution']);

    mysqli_query($conn,
        "INSERT INTO solutions(problem_id,provider_id,solution)
         VALUES('$pid','$provider_id','$solution')"
    );

    mysqli_query($conn,
        "UPDATE problems SET status='solved' WHERE id='$pid'"
    );

    $message = "Solution submitted successfully";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Provider Dashboard | LSN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
body{background:#f4f6f9;font-family:'Segoe UI',sans-serif}
.navbar{box-shadow:0 4px 15px rgba(0,0,0,.1)}
.card{border:none;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,.08)}
.form-control, textarea{border-radius:12px;padding:10px}
.btn{border-radius:50px;font-weight:600}
.badge{border-radius:12px}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">LSN Provider</a>
    <div class="ms-auto">
      <a href="../logout.php" class="btn btn-light btn-sm rounded-pill">Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">
  <!-- Quick Stats -->
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <h6 class="text-muted">Approved Problems</h6>
        <h3 class="fw-bold mb-0"><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT id FROM problems WHERE status='approved'")); ?></h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <h6 class="text-muted">Solved by You</h6>
        <h3 class="fw-bold mb-0"><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT id FROM solutions WHERE provider_id='$provider_id'")); ?></h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <h6 class="text-muted">Your Role</h6>
        <h5 class="fw-bold mb-0">Solution Provider</h5>
      </div>
    </div>
  </div>
  <h4 class="fw-bold mb-2"><i class="bi bi-check2-circle"></i> Approved Problems</h4>
  <p class="text-muted mb-4">Below problems are verified and approved by validators. Please provide clear and practical solutions so the community can benefit.</p>

  <?php if($message): ?>
    <div class="alert alert-success"><?= $message ?></div>
  <?php endif; ?>

  <div class="row g-4">
  <?php
  $result = mysqli_query($conn,
      "SELECT * FROM problems WHERE status='approved'"
  );

  while ($row = mysqli_fetch_assoc($result)) {
  ?>
    <div class="col-md-6">
      <div class="card p-4">
        <h5 class="fw-bold"><?= $row['title'] ?></h5>
        <p class="text-muted"><?= $row['description'] ?></p>
        <span class="badge bg-warning text-dark mb-3">Approved</span>

        <form method="post">
          <input type="hidden" name="problem_id" value="<?= $row['id'] ?>">
          <div class="mb-3">
            <textarea name="solution" class="form-control" rows="3" placeholder="Enter your solution" required></textarea>
          </div>
          <button name="submit_solution" class="btn btn-success w-100">Submit Solution</button>
        </form>
      </div>
    </div>
  <?php } ?>
    <!-- Help Section -->
  <div class="card p-4 mt-5">
    <h5 class="fw-bold mb-2"><i class="bi bi-info-circle"></i> Provider Guidelines</h5>
    <ul class="text-muted mb-0">
      <li>Give step-by-step and realistic solutions.</li>
      <li>Avoid offensive or unclear language.</li>
      <li>Once submitted, the problem will be marked as solved.</li>
      <li>Your contribution helps improve the local community.</li>
    </ul>
  </div>
</div>

<footer class="text-center text-muted py-4">
  © 2025 Local Solution Network • Working together for better communities
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
