<?php include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    if ($stmt->execute()) {
        echo "<script>alert('Signup successful'); window.location='login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5" style="max-width: 400px;">
    <h2 class="text-center">Sign Up</h2>
    <form method="POST">
      <input class="form-control mb-2" name="name" placeholder="Name" required>
      <input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
      <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>
      <button class="btn btn-primary w-100" type="submit">Sign Up</button>
    </form>
    <div class="mt-3 text-center">
      Already have an account? <a href="login.php">Login</a>
    </div>
  </div>
</body>
</html>