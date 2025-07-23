<?php
session_start();

$errMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // بيانات الدخول الثابتة (يمكن تعديلها لاحقاً)
    $adminUser = 'admin';
    $adminPass = 'admin1234';

    if ($username === $adminUser && $password === $adminPass) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_appointments.php');
        exit;
    } else {
        $errMsg = 'اسم المستخدم أو كلمة المرور غير صحيحة.';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>تسجيل دخول المشرف</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background: rgba(255, 255, 255, 0.15);
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(8.5px);
            -webkit-backdrop-filter: blur(8.5px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #fff;
        }
        .error-message {
            background-color: rgba(255, 0, 0, 0.7);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 600;
        }
        label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-top: 8px;
            border-radius: 10px;
            border: none;
            box-sizing: border-box;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #a18cd1;
            background: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 8px #a18cd1;
        }
        button {
            background: #6a11cb;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            font-weight: 700;
            border: none;
            cursor: pointer;
            margin-top: 25px;
            width: 100%;
            padding: 12px 0;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(101, 41, 255, 0.4);
            transition: all 0.3s ease;
        }
        button:hover {
            background: linear-gradient(45deg, #2575fc, #6a11cb);
            box-shadow: 0 6px 20px rgba(101, 41, 255, 0.7);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>تسجيل دخول المشرف</h1>
        <?php if ($errMsg): ?>
            <div class="error-message"><?php echo htmlspecialchars($errMsg); ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label for="username">اسم المستخدم:</label>
            <input type="text" id="username" name="username" required autofocus />

            <label for="password">كلمة المرور:</label>
            <input type="password" id="password" name="password" required />

            <button type="submit">دخول</button>
        </form>
    </div>
</body>
</html>
