<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Courses";

if (isset($_GET['search'])) {
    // If a course was searched by title
    $search = $_GET['search'];
    $courses = paginate("SELECT * FROM courses WHERE title LIKE '%$search%'", 15);
} else {
    // Else return all courses
    $courses = paginate("SELECT * FROM courses ORDER BY id DESC", 15);
}

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'courses'=> $courses
];

management_view('courses', $context);