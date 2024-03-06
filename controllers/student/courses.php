<?php

// Authorizing student
$student = student_logged_in();
$student_department = $student['department_id'];
$student_level = $student['level'];

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Courses";

if (isset($_GET['search'])) {
    // If a course was searched by title
    $search = $_GET['search'];
    $courses = paginate("SELECT * FROM courses WHERE title LIKE '%$search%'", 15);
} else {
    // Else return all courses
    $courses = paginate("SELECT * FROM courses WHERE department_id = $student_department AND level = $student_level", 15);
}

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'student'=> $student,
    'courses'=> $courses
];

student_view('courses', $context);