<?php

// Authorizing management staff
$staff = staff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Students";

if (isset($_GET['search'])) {
    // If a student was searched
    $search = sanitize_input($_GET['search']);
    $students = paginate("SELECT * FROM students WHERE CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', matric_number) LIKE '%$search%'", 15);
} else {
    // Else return all students
    $students = paginate("SELECT * FROM students ORDER BY id DESC", 15);
}

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'staff'=> $staff,
    'students'=> $students
];

staff_view('students', $context);