<?php
session_start();
require 'database.php'; // استدعاء ملف الاتصال بقاعدة البيانات

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {
        // التحقق من وجود المستخدم في قاعدة البيانات
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // إنشاء الجلسة وتخزين بيانات المستخدم
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            // توجيه المستخدم حسب دوره
            if ($user['role'] == "Super Admin") {
                header("Location: super_admin_dashboard.php");
            } elseif ($user['role'] == "Admin") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_profile.php");
            }
            exit;
        } else {
            $message = "❌ البريد الإلكتروني أو كلمة المرور غير صحيحة!";
        }
    } else {
        $message = "❌ الرجاء إدخال جميع البيانات!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
</head>
<body>
    <h2>تسجيل الدخول</h2>
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="البريد الإلكتروني" required><br><br>
        <input type="password" name="password" placeholder="كلمة المرور" required><br><br>
        <button type="submit">تسجيل الدخول</button>
    </form>
    <p><?php echo $message; ?></p>
</body>
</html>