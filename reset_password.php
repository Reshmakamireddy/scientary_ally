<?php
include 'db.php';

$token = $_GET['token'] ?? '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expire = NULL WHERE reset_token = ?");
    $stmt->bind_param("ss", $newPass, $token);
    if ($stmt->execute()) {
        echo "<script>alert('Password reset successful'); window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5" style="max-width: 400px;">
    <h2 class="text-center">Reset Password</h2>
    <form method="POST">
      <input class="form-control mb-2" type="password" name="password" placeholder="New password" required>
      <button class="btn btn-success w-100" type="submit">Reset</button>
    </form>
  </div>
</body>
</html>