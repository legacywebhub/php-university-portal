<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Add Department";
$faculties = query_fetch("SELECT * FROM faculties");

// Handling add department request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Declaring DB variables as PHP array
    $data = [
        'faculty_id' => sanitize_input($_POST['faculty_id']),
        'department_code' => sanitize_input($_POST['department_code']),
        'name' => sanitize_input($_POST['name']),
        'short_name' => sanitize_input($_POST['short_name']),
        'start_level' => sanitize_input($_POST['start_level']),
        'end_level' => sanitize_input($_POST['end_level']),
        'head_of_department' => sanitize_input($_POST['HOD'])
    ];
    
    try {
        $query = "INSERT INTO departments (faculty_id, department_code, name, short_name, start_level, end_level, head_of_department) 
        VALUES (:faculty_id, :department_code, :name, :short_name, :start_level, :end_level, :head_of_department)";
        $query = query_db($query, $data);
        $message = "Department was successfully added";
        $message_tag = "success";
        redirect('departments', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('add-department', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'faculties'=> $faculties
];

management_view('add-department', $context);