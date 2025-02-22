<?php
$host = "localhost";  // Change this if your database is on a different server
$dbname = "anas";  // Replace with your database name
$username = "root";  // Default for localhost (change if needed)
$password = "";  // Leave blank if no password is set

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";  // Message if connection works=

    // 5. List all courses along with the number of students enrolled
    echo "<h3>Students that have more than three courses:</h3>";
    $stmt = $pdo->query("
        SELECT C.course_name, COUNT(E.student_id) AS student_count
        FROM Courses C
        LEFT JOIN Enrollments E ON C.course_id = E.course_id
        GROUP BY C.course_id, C.course_name
    ");
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "{$row['course_name']} - Enrolled Students: {$row['student_count']}<br>";
    }

    // 6. Find the students who were enrolled in a course with a grade of 'A'
    echo "<h3>Students with Grade 'A':</h3>";
    $stmt = $pdo->query("
        SELECT S.first_name, S.last_name, C.course_name
        FROM Students S
        JOIN Enrollments E ON S.student_id = E.student_id
        JOIN Courses C ON E.course_id = C.course_id
        WHERE E.grade = 'A'
    ");
    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //     echo "{$row['first_name']} {$row['last_name']} - Course: {$row['course_name']}<br>";
    // }
     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<pre>";  // Preformatted text for better readability
        print_r($row); // Prints all columns and values in the row
        echo "</pre>";
    }

    // 7. Retrieve courses and instructors assigned for a specific semester
    $semester = "Spring";
    $year = 2025;
    echo "<h3>Courses & Instructors for $semester $year:</h3>";
    $stmt = $pdo->prepare("
        SELECT C.course_name, I.first_name, I.last_name
        FROM Courses C
        JOIN CourseAssignments CA ON C.course_id = CA.course_id
        JOIN Instructors I ON CA.instructor_id = I.instructor_id
        WHERE CA.semester = :semester AND CA.year = :year
    ");
    $stmt->execute(['semester' => $semester, 'year' => $year]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Course: {$row['course_name']} - Instructor: {$row['first_name']} {$row['last_name']}<br>";
    }

    // 8. Find the average grade for a particular course (Example: 'Frontend Development')
    $course_name = "Frontend Development";
    echo "<h3>Average Grade for $course_name:</h3>";
    $stmt = $pdo->prepare("
        SELECT C.course_name, AVG(CASE 
            WHEN E.grade = 'A' THEN 4.0 
            WHEN E.grade = 'B' THEN 3.0 
            WHEN E.grade = 'C' THEN 2.0 
            WHEN E.grade = 'D' THEN 1.0 
            WHEN E.grade = 'F' THEN 0.0 
            ELSE NULL END) AS average_gpa
        FROM Courses C
        JOIN Enrollments E ON C.course_id = E.course_id
        WHERE C.course_name = :course_name
        GROUP BY C.course_id, C.course_name
    ");
    $stmt->execute(['course_name' => $course_name]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['average_gpa'] !== null) {
        echo "Average GPA: " . round($row['average_gpa'], 2) . "<br>";
    } else {
        echo "No grades available for $course_name.<br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}