<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 40px 20px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      color: #555;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border-radius: 3px;
      border: 1px solid #ccc;
      transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      outline: none;
      border-color: #337ab7;
    }

    input[type="submit"] {
      background-color: #337ab7;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 3px;
      cursor: pointer;
    }

    .error-message {
      margin-top: 20px;
      background-color: #f2dede;
      color: #a94442;
      border: 1px solid #ebccd1;
      padding: 10px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Admin Login</h1>
    <?php
    $host = "45.137.205.154:3306";
    $username = "u26_essLdYbUxL";
    $password = "0M9fFlxfMzyG.B71nj@@^PPm";
    $dbname = "s26_admins";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $adminname = $_POST['adminname'];
      $password = $_POST['password'];

      $sql = "SELECT * FROM admins WHERE adminname = '$adminname' AND password = '$password'";

      $result = $conn->query($sql);

      if ($result === false) {
        $message = '<div class="error-message">Error executing query: ' . $conn->error . '</div>';
      } else {
        if ($result->num_rows > 0) {
          $message = '<div class="success-message">Login successful! Welcome, ' . $adminname . '!</div>';
        } else {
          $message = '<div class="error-message">Invalid adminname or password</div>';
        }
      }
    }

    $conn->close();
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="adminname">Adminname</label>
        <input type="text" id="adminname" name="adminname" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <input type="submit" value="Login">
    </form>

    <?php echo $message; ?>
  </div>
</body>
</html>
