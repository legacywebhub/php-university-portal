<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Students";

if (isset($_GET['search'])) {
    // If a student was searched by matric number
    $search = $_GET['search'];
    $students = paginate("SELECT * FROM students WHERE matric_number = '$search'", 15);
} else {
    // Else return all students
    $students = paginate("SELECT * FROM students ORDER BY id DESC", 15);
}

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'students'=> $students
];

management_view('students', $context);