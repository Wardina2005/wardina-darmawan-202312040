<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HiiStyle | Elegance in Every Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      background: linear-gradient(to right, #e0f7fa, #fce4ec);
      font-family: 'Segoe UI', sans-serif;
    }
    .hero {
      background: url('../assets/img/hero-bg.jpg') no-repeat center center;
      background-size: cover;
      height: 100vh;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      text-shadow: 1px 1px 3px #000;
    }
    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
    }
    .hero p {
      font-size: 1.3rem;
    }
    .btn-primary {
      background-color: #ff4081;
      border: none;
    }
    .btn-primary:hover {
      background-color: #f50057;
    }
    footer {
      background: #222;
      color: #ddd;
      padding: 20px 0;
      text-align: center;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="#">HiiStyle</a>
      <div class="ms-auto">
        <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
        <a href="register.php" class="btn btn-primary">Register</a>
      </div>
    </div>
  </nav>

  <div class="hero text-center">
    <div>
      <h1>Welcome to HiiStyle</h1>
      <p>Discover luxury bags with timeless elegance.</p>
      <a href="login.php" class="btn btn-primary mt-3 px-4 py-2">Get Started</a>
    </div>
  </div>

  <footer>
    <div class="container">
      <p>&copy; <?= date("Y") ?> HiiStyle. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>
