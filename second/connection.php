<?php
$host = 'localhost';
$db = 'uni';
$user = 'root';
$pass = '';


$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// $student_id=$_POST["student_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $major = $_POST["major"];
    $enrollment_year = $_POST["enrollment_year"];

    try {
        $stmt = $conn->prepare("INSERT INTO Students (first_name, last_name, email, date_of_birth, gender, major, enrollment_year) 
                               VALUES (:first_name, :last_name, :email, :dob, :gender, :major, :enrollment_year)");


        $stmt->execute([
// ":student_id"=>$student_id,
            ":first_name" => $first_name,
            ":last_name" => $last_name,
            ":email" => $email,
            ":dob" => $dob,
            ":gender" => $gender,
            ":major" => $major,
            ":enrollment_year" => $enrollment_year
        ]);

        echo "<p style='color: green;'>Student added successfully!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Information Form</title>
</head>
<body>
    <form action="" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br>

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" required><br>

        <label for="major">Major:</label>
        <input type="text" id="major" name="major" required><br>

        <label for="enrollment_year">Enrollment Year:</label>
        <input type="number" id="enrollment_year" name="enrollment_year" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

