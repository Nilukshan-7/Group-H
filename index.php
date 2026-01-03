<?php
// homeee.php – Modern UI version
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Local Solution Network</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body{
      background: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }
    .hero{
      background: linear-gradient(135deg, #0d6efd, #6610f2);
      color: white;
      padding: 80px 20px;
      border-radius: 0 0 40px 40px;
    }
    .card-modern{
      border: none;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.08);
      transition: 0.3s;
    }
    .card-modern:hover{
      transform: translateY(-5px);
    }
    .icon-box{
      width: 55px;
      height: 55px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background: #e9f0ff;
      color: #0d6efd;
      font-size: 24px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">LSN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Report</a></li>
        <li class="nav-item"><a class="nav-link" href="signup.php">signup</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
<section class="hero text-center">
  <div class="container">
    <h1 class="fw-bold mb-3">Local Solution Network</h1>
    <p class="lead">Report local problems • Track solutions • Build community</p>
    <a href="#" class="btn btn-light btn-lg rounded-pill mt-3">Report a Problem</a>
  </div>
</section>

<!-- Features -->
<div class="container my-5">
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card card-modern p-4 text-center">
        <div class="icon-box mx-auto"><i class="bi bi-camera"></i></div>
        <h5 class="fw-bold">Report Issues</h5>
        <p class="text-muted">Upload photos and describe problems easily.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-modern p-4 text-center">
        <div class="icon-box mx-auto"><i class="bi bi-geo-alt"></i></div>
        <h5 class="fw-bold">Track Status</h5>
        <p class="text-muted">Know whether it is pending or solved.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-modern p-4 text-center">
        <div class="icon-box mx-auto"><i class="bi bi-people"></i></div>
        <h5 class="fw-bold">Community Driven</h5>
        <p class="text-muted">Citizens and providers work together.</p>
      </div>
    </div>
  </div>
</div>

<footer class="text-center py-4 text-muted">
  © 2025 Local Solution Network
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
