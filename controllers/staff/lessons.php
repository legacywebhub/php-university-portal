<?php

// Authorizing staff
$staff = staff_logged_in();

// Authenticating view
if (!isset($_GET['course_id']) || !is_numeric($_GET['course_id'])) {
    // Redirect if no course id passed
    redirect("courses");
} else {

    try {
        $course_id = intval($_GET['course_id']);
        $matching_courses = query_fetch("SELECT * FROM courses WHERE id = $course_id LIMIT 1");

        if (empty($matching_courses)) {
            // Redirect if no matching course
            redirect("courses");
        } else {
            // Else return course
            $course = $matching_courses[0];
        }
    } catch (Exception) {
        redirect("courses");
    }
}

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Lessons";

if (isset($_GET['search'])) {
    // If a lesson was searched by title
    $search = $_GET['search'];
    $lessons = paginate("SELECT * FROM lessons WHERE title LIKE '%$search%'", 15);
} else {
    // Else return all lessons
    $lessons = paginate("SELECT * FROM lessons WHERE course_id = $course_id", 15);
}

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'staff'=> $staff,
    'course'=> $course,
    'lessons'=> $lessons
];

staff_view('lessons', $context);