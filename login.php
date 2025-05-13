<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userId, $hashedPassword);
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $userId;
            echo "<script>alert('Login successful'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Incorrect password');</script>";
        }
    } else {
        echo "<script>alert('Email not found');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f1f1f1;
    }
    .login-box {
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      max-width: 400px;
      margin: auto;
      margin-top: 100px;
    }
    .form-control {
      background: #ccc;
      border: none;
      border-radius: 8px;
    }
    .form-control:focus {
      box-shadow: none;
      background: #ddd;
    }
    .btn-dark {
      border-radius: 25px;
    }
    .form-label {
      margin-bottom: 4px;
    }
    a {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
<div class="login-box">
  <h3 class="text-center fw-bold mb-4">Login</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input class="form-control" type="email" name="email" placeholder="Enter your email" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input class="form-control" type="password" name="password" placeholder="Enter your password" required>
    </div>
    <div class="mb-3">
      <a href="forgot_password.php">Forgot your password?</a>
    </div>
    <button class="btn btn-dark w-100" type="submit">Login</button>
  </form>
</div>
</body>
</html>
