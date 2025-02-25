<?php
$host = "localhost"; // اسم السيرفر
$dbname = "user_auth_system"; // اسم قاعدة البيانات
$username = "root"; // اسم المستخدم الافتراضي في XAMPP
$password = ""; // كلمة المرور (فارغة في XAMPP)

try {
    // إنشاء اتصال PDO
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // إنشاء قاعدة البيانات إذا لم تكن موجودة
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    $pdo->exec($sql);
    echo "✅ قاعدة البيانات '$dbname' تم إنشاؤها بنجاح.<br>";

    // الاتصال بقاعدة البيانات بعد إنشائها
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // إنشاء جدول المستخدمين إذا لم يكن موجودًا
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        profile_image VARCHAR(255) DEFAULT 'default-avatar.png',
        role ENUM('Super Admin', 'Admin', 'User') DEFAULT 'User',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "✅ جدول 'users' تم إنشاؤه بنجاح.";

} catch (PDOException $e) {
    die("❌ فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>