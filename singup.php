<?php
include 'config/db.php';
$message = "";

if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']));
    $role = $_POST['role'];

    $query = "INSERT INTO users (name, email, password, role, status)
              VALUES ('$name', '$email', '$password', '$role', 'active')";

    if(mysqli_query($conn, $query)){
        $message = "Account created successfully!";
    } else {
        $message = "Something went wrong";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up | Local Solution Network</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
body{
  min-height:100vh;
  background:linear-gradient(135deg,#20c997,#0d6efd);
  display:flex;
  align-items:center;
  justify-content:center;
  font-family:'Segoe UI',sans-serif;
}
.signup-card{
  max-width:450px;width:100%;
  border-radius:25px;
  box-shadow:0 15px 40px rgba(0,0,0,.25);
}
.form-control, .form-select{
  border-radius:12px;padding:12px
}
.btn{border-radius:50px;padding:12px;font-weight:600}
.icon{
  width:70px;height:70px;
  background:#e9f0ff;color:#0d6efd;
  border-radius:50%;display:flex;
  align-items:center;justify-content:center;
  font-size:32px;margin:-50px auto 15px;
  box-shadow:0 10px 25px rgba(0,0,0,.2)
}
</style>
</head>
<body>

<div class="card signup-card p-4">
  <div class="text-center">
    <div class="icon"><i class="bi bi-person-plus"></i></div>
    <h4 class="fw-bold">Create Account</h4>
    <p class="text-muted">Join Local Solution Network</p>
  </div>

  <?php if($message): ?>
    <div class="alert alert-info text-center"><?= $message ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Select Role</label>
      <select name="role" class="form-select">
        <option value="user">User</option>
        <option value="provider">Solution Provider</option>
        <option value="validator">Problem Validator</option>
      </select>
    </div>
    <button name="signup" class="btn btn-success w-100">Sign Up</button>
  </form>

  <p class="text-center mt-3">
    Already have an account?
    <a href="login.php" class="fw-semibold text-decoration-none">Login here</a>
  </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>