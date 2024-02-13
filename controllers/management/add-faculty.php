<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Add Faculty";


// Handling add faculty request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Declaring DB variables as PHP array
    $data = [
        'name' => sanitize_input($_POST['name'])
    ];
    
    try {
        $query = "INSERT INTO faculties (name) VALUES (:name)";
        $query = query_db($query, $data);
        $message = "Faculty was successfully added";
        $message_tag = "success";
        redirect('faculties', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('add-faculty', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
];

management_view('add-faculty', $context);