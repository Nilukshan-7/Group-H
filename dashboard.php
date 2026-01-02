<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// User status actions
if (isset($_GET['block'])) {
    mysqli_query($conn, "UPDATE users SET status='blocked' WHERE id=".$_GET['block']);
    header("Location: dashboard.php");
}
if (isset($_GET['active'])) {
    mysqli_query($conn, "UPDATE users SET status='active' WHERE id=".$_GET['active']);
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard | LSN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
body{background:#f4f6f9;font-family:'Segoe UI',sans-serif}
.navbar{box-shadow:0 4px 15px rgba(0,0,0,.1)}
.card{border:none;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,.08)}
.badge{border-radius:12px}
.btn{border-radius:50px;font-weight:600}
.table{background:#fff;border-radius:15px;overflow:hidden}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">LSN Admin</a>
    <div class="ms-auto">
      <a href="../logout.php" class="btn btn-light btn-sm rounded-pill">Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">

  <!-- Stats -->
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card p-3 text-center">
        <h6 class="text-muted">Total Users</h6>
        <h3 class="fw-bold mb-0"><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT id FROM users")); ?></h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 text-center">
        <h6 class="text-muted">Active Users</h6>
        <h3 class="fw-bold mb-0"><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT id FROM users WHERE status='active'")); ?></h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 text-center">
        <h6 class="text-muted">Blocked Users</h6>
        <h3 class="fw-bold mb-0"><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT id FROM users WHERE status='blocked'")); ?></h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 text-center">
        <h6 class="text-muted">Admins</h6>
        <h3 class="fw-bold mb-0"><?php echo mysqli_num_rows(mysqli_query($conn,"SELECT id FROM users WHERE role='admin'")); ?></h3>
      </div>
    </div>
  </div>

  <!-- Heading -->
  <h4 class="fw-bold mb-2"><i class="bi bi-people"></i> User Management</h4>
  <p class="text-muted mb-4">Manage all users, control access, and maintain system integrity.</p>

  <!-- User Table -->
  <div class="card p-4">
    <div class="table-responsive">
      <table class="table align-middle">
        <thead class="table-light">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM users");
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><span class="badge bg-info text-dark"><?= ucfirst($row['role']) ?></span></td>
            <td>
              <?php if($row['status']=='active'): ?>
                <span class="badge bg-success">Active</span>
              <?php else: ?>
                <span class="badge bg-danger">Blocked</span>
              <?php endif; ?>
            </td>
            <td>
              <?php if($row['status']=='active'): ?>
                <a href="?block=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm">Block</a>
              <?php else: ?>
                <a href="?active=<?= $row['id'] ?>" class="btn btn-outline-success btn-sm">Activate</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Admin Info -->
  <div class="card p-4 mt-5">
    <h5 class="fw-bold mb-2"><i class="bi bi-shield-check"></i> Admin Responsibilities</h5>
    <ul class="text-muted mb-0">
      <li>Ensure only valid users remain active.</li>
      <li>Block suspicious or abusive accounts.</li>
      <li>Maintain role-based system integrity.</li>
      <li>Your actions directly affect platform trust.</li>
    </ul>
  </div>
</div>

<footer class="text-center text-muted py-4">
  © 2025 Local Solution Network • Admin Control Panel
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>