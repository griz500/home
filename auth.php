<?php
session_start();
$registerMessage = "";
$loginMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $_SESSION['username'] = $_POST['reg_username'];
        $_SESSION['password'] = $_POST['reg_password'];
        $registerMessage = "✅ Registered successfully. You can now log in.";
    }

    if (isset($_POST['login'])) {
        if (
            isset($_SESSION['username'], $_SESSION['password']) &&
            $_POST['login_username'] === $_SESSION['username'] &&
            $_POST['login_password'] === $_SESSION['password']
        ) {
            $_SESSION['logged_in'] = true;
            header("Location: home.php");
            exit();
        } else {
            $loginMessage = "❌ Invalid login credentials.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login & Register</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 40px;
            padding: 50px;
            flex-wrap: wrap;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 320px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .message {
            margin-top: 10px;
            text-align: center;
            color: #2e7d32;
        }

        .error {
            color: #c62828;
        }
    </style>
</head>
<body>

    <!-- Register Form -->
    <div class="form-box">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="reg_username" placeholder="Choose Username" required>
            <input type="password" name="reg_password" placeholder="Choose Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <?php if ($registerMessage): ?>
            <div class="message"><?= $registerMessage ?></div>
        <?php endif; ?>
    </div>

    <!-- Login Form -->
    <div class="form-box">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="login_username" placeholder="Username" required>
            <input type="password" name="login_password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <?php if ($loginMessage): ?>
            <div class="message error"><?= $loginMessage ?></div>
        <?php endif; ?>
    </div>

</body>
</html>
