<?php
require 'database.php'; // استدعاء ملف الاتصال بقاعدة البيانات

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $role = trim($_POST["role"]); // التقاط الدور من الفورم


    // التحقق من إدخال جميع البيانات
    if (!empty($name) && !empty($email) && !empty($password)) {
        // تشفير كلمة المرور باستخدام BCRYPT
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        try {
            // إدخال البيانات في قاعدة البيانات
            $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashed_password,
                ':role' => $role
            ]);
            $message = "✅ تم التسجيل بنجاح! يمكنك تسجيل الدخول الآن.";
        } catch (PDOException $e) {
            $message = "❌ خطأ: " . $e->getMessage();
        }
    } else {
        $message = "❌ الرجاء ملء جميع الحقول!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل مستخدم جديد</title>
</head>
<body>
    <h2>تسجيل مستخدم جديد</h2>
    <form action="register.php" method="POST">
        <input type="text" name="name" placeholder="الاسم بالكامل" required><br><br>
        <input type="email" name="email" placeholder="البريد الإلكتروني" required><br><br>
        <input type="password" name="password" placeholder="كلمة المرور" required><br><br>
        <button type="submit">تسجيل</button>
    </form>
    <p><?php echo $message; ?></p>
</body>
</html>