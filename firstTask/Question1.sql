
CREATE TABLE Students (
    student_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(300) NOT NULL,
    last_name VARCHAR(300) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    date_of_birth TIMESTAMP NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    major VARCHAR(100),
    enrollment_year YEAR NOT NULL
);

CREATE TABLE Courses (
    -- course_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(300) NOT NULL,
    course_code VARCHAR(20) UNIQUE NOT NULL,
    credits INT CHECK (credits > 0 AND credits <= 10),
    department VARCHAR(100) NOT NULL
);

CREATE TABLE Instructors (
    instructor_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(300) NOT NULL,
    last_name VARCHAR(300) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    hire_date TIMESTAMP NOT NULL,
    department VARCHAR(100) NOT NULL
);

CREATE TABLE Enrollments (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    course_id INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id),
    grade VARCHAR(5)
);

CREATE TABLE CourseAssignments (
    assignment_id INT AUTO_INCREMENT PRIMARY KEY,
    instructor_id INT NOT NULL,
    FOREIGN KEY (instructor_id) REFERENCES Instructors(instructor_id),
    course_id INT NOT NULL,
    semester VARCHAR(10) NOT NULL,
    year YEAR NOT NULL,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);