<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Add Lesson";


// Handling add lesson request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Declaring DB variables as PHP array
    $data = [
        'course_id' => sanitize_input($_POST['course']),
        'title' => sanitize_input($_POST['title'])
    ];
    
    try {
        $query = "INSERT INTO lessons (course_id, title) VALUES (:course_id, :title)";
        $query = query_db($query, $data);
        redirect('lessons', "Lesson was successfully added", "success");
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('lessons', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff
];

management_view('lessons', $context);