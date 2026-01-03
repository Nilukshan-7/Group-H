<?php
session_start();
include 'config/db.php';

$error = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']));

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='active'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') header("Location: admin/dashboard.php");
        if ($user['role'] == 'user') header("Location: user/dashboard.php");
        if ($user['role'] == 'provider') header("Location: provider/dashboard.php");
        if ($user['role'] == 'validator') header("Location: validator/dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login | Local Solution Network</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
body{
  min-height:100vh;
  background:linear-gradient(135deg,#0d6efd,#6610f2);
  display:flex;
  align-items:center;
  justify-content:center;
  font-family:'Segoe UI',sans-serif;
}
.login-card{
  max-width:420px;
  width:100%;
  border-radius:25px;
  box-shadow:0 15px 40px rgba(0,0,0,.25);
}
.form-control{border-radius:12px;padding:12px}
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

<div class="card login-card p-4">
  <div class="text-center">
    <div class="icon"><i class="bi bi-person-lock"></i></div>
    <h4 class="fw-bold">Welcome Back</h4>
    <p class="text-muted">Login to continue</p>
  </div>

  <?php if($error): ?>
    <div class="alert alert-danger text-center"><?= $error ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button name="login" class="btn btn-primary w-100">Login</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>