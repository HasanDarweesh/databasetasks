<?php
session_start();

// التحقق من تسجيل الدخول ومن أن المستخدم هو "Admin"
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المسؤول</title>
</head>
<body>
    <h2>مرحبًا، <?php echo $_SESSION['user_name']; ?> 👋</h2>
    <h3>أنت الآن في لوحة تحكم المسؤول.</h3>
    <a href="logout.php">تسجيل الخروج</a>
</body>
</html>
