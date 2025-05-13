<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(16));
    $expire = date("Y-m-d H:i:s", strtotime('+10 minutes'));

    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expire = ? WHERE email = ?");
    $stmt->bind_param("sss", $token, $expire, $email);
    if ($stmt->execute()) {
        $resetLink = "http://localhost/project-folder/reset_password.php?token=$token";
        echo "<script>alert('Reset link: $resetLink');</script>"; // Simulate sending email
    } else {
        echo "Something went wrong.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5" style="max-width: 400px;">
    <h2 class="text-center">Forgot Password</h2>
    <form method="POST">
      <input class="form-control mb-2" name="email" placeholder="Enter your email" required>
      <button class="btn btn-primary w-100" type="submit">Send Reset Link</button>
    </form>
  </div>
</body>
</html>