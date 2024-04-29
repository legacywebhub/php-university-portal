<?php

// Authorizing staff
$staff = staff_logged_in();

// Authenticating view
if (!isset($_GET['lesson_id']) || !is_numeric($_GET['lesson_id'])) {
    // Redirect if no lesson id passed
    redirect("courses");
} else {
    try {
        $lesson_id = intval($_GET['lesson_id']);
        $matched_lessons = query_fetch("SELECT * FROM lessons WHERE id = $lesson_id LIMIT 1");

        if (empty($matched_lessons)) {
            // Redirect if no matching lesson
            redirect("courses");
        } else {
            // Else return lesson
            $lesson = $matched_lessons[0];
            $lesson_id = $lesson['id'];
            // Fetching connected course 
            $course_id = $lesson['course_id'];
            $course = query_fetch("SELECT * FROM courses WHERE id = $course_id LIMIT 1")[0];
            $videos = query_fetch("SELECT * FROM videos WHERE lesson_id = $lesson_id");
            $documents = query_fetch("SELECT * FROM documents WHERE lesson_id = $lesson_id");
        }
    } catch (Exception) {
        redirect("courses");
    }
}
// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Lesson";


// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'staff'=> $staff,
    'course'=> $course,
    'lesson'=> $lesson,
    'videos'=> $videos,
    'documents'=> $documents
];

staff_view('view-lesson', $context);