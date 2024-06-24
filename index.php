<?php
session_start();

// Cek jika sudah login, redirect ke dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard_admin.php");
    exit();
}

$error = "";

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Database connection
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'nstore';

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menggunakan prepared statement
    $stmt = $conn->prepare("SELECT id_admin, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Gunakan password_verify jika password di-hash
        if ($password === $row['password']) {
            $_SESSION['admin_id'] = $row['id_admin'];
            header("Location: dashboard_admin.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NST Store Login</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: url('assets/bg2.jpg') no-repeat center center fixed;
            background-size: cover;
            opacity: 90%;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            height: 100vh;
            padding: 0 20px;
            box-sizing: border-box;
        }
        .header {
            font-size: 60px;
            color: white;
            font-weight: bold;
            text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            position: absolute;
            top: 20px;
            left: 20px;
            margin-left: 60px;
            margin-top: 20px;
        }
         .login-box {
            background: #FBFBFB;
            padding: 30px 25px;
            border-radius: 30px;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: absolute;
            top: 100px;
            left: 20px;
            margin-top: 50px;
            margin-left: 80px;
            width: 300px;
        }

        .login-box h2 {
            color: #07B2FB;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        }

        .login-box input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border-radius: 20px;
            border: 1px solid rgba(140, 140, 140, 0.5);
            font-size: 16px;
            color: rgba(140, 140, 140, 0.5);
            box-sizing: border-box;
            outline: none;
        }

        .login-box a {
            font-size: 14px;
            margin-bottom: 15px;
            text-decoration: none;
        }

        .login-box button {
            width: 100%;
            padding: 10px 15px;
            border-radius: 20px;
            background-color: #7E96A0;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            box-sizing: border-box;
        }
        .not-admin {
            color: black;
        }
        .user-login {
            color: #07B2FB;
        }
    
        .analysis-text {
            font-size: 30px;
            color: white;
            font-weight: bold;
            text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            margin-top: 50px;
            text-align: center;
            position: absolute;
            top: 200px;
            right: 20px;
            width: 60%;
            margin-right: 80px;
            margin-top: 40px;
        }
        .footer {
            color: white;
            font-size: 18px;
            font-weight: bold;
            position: absolute;
            bottom: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">NST STORE</div>
        <div class="login-box">
            <h2>Login</h2>
            <?php
            if (!empty($error)) {
                echo "<p style='color: red;'>$error</p>";
            }
            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="dashboard_user.php">
                    <span class="not-admin">Not an Admin?</span> 
                    <span class="user-login">User login</span>
                </a>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
        <div class="analysis-text">
            ANALISIS KERUSAKAN HP ANDA<br>DI WEBSITE KAMI
        </div>
        <div class="footer">project by manda gagang sapu</div>
    </div>
</body>
</html>
