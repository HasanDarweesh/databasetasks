<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// السماح فقط للمستخدمين العاديين بالوصول لهذه الصفحة
if ($_SESSION['user_role'] !== 'User') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>ملف المستخدم</title>
</head>
<body>
    <h2>مرحبًا، <?php echo $_SESSION['user_name']; ?> 👋</h2>
    <p>دورك: <?php echo $_SESSION['user_role']; ?></p>
    <a href="logout.php">تسجيل الخروج</a>
</body>
</html>
