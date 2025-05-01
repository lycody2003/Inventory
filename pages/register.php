<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Inventory</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #6dd5fa, #2980b9);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .register-box h2 {
            margin-bottom: 30px;
            color: #333;
        }

        .register-box input[type="text"],
        .register-box input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .register-box button {
            width: 100%;
            padding: 12px;
            background: #2980b9;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .register-box button:hover {
            background: #2573a6;
        }

        .register-box a {
            display: inline-block;
            margin-top: 15px;
            color: #2980b9;
            text-decoration: none;
        }

        .register-box a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Create Account</h2>
        <form action="../backend/register.php" method="post">
            <input type="text" name="username" placeholder="Username" autocomplete="off" required>
            <input type="password" name="password" placeholder="Password" autocomplete="off" required>
            <button type="submit">Register</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>
