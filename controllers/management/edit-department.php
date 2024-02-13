<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Authenticating view
if (!isset($_GET['id'])) {
    // Redirect if no department id passed
    redirect("departments");
} else {

    try {
        $id = intval($_GET['id']);
        $matching_departments = query_fetch("SELECT * FROM departments WHERE id = $id LIMIT 1");

        if (empty($matching_departments)) {
            // Redirect if no matching department
            redirect("departments");
        } else {
            // Else return department
            $department = $matching_departments[0];
        }
    } catch (Exception) {
        redirect("departments");
    }
}

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Edit Department";
$faculties = query_fetch("SELECT * FROM faculties");

// Handling edit department request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Declaring DB variables as PHP array
    $data = [
        'id' => $id,
        'faculty_id' => sanitize_input($_POST['faculty_id']),
        'department_code' => sanitize_input($_POST['department_code']),
        'name' => sanitize_input($_POST['name']),
        'short_name' => sanitize_input($_POST['short_name']),
        'start_level' => sanitize_input($_POST['start_level']),
        'end_level' => sanitize_input($_POST['end_level']),
        'head_of_department' => sanitize_input($_POST['HOD'])
    ];
    
    try {
        $query = "UPDATE departments SET faculty_id = :faculty_id, department_code = :department_code, name = :name, short_name = :short_name, start_level = :start_level, end_level = :end_level, head_of_department = :head_of_department WHERE id = :id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Department was successfully updated";
        $message_tag = "success";
        redirect('departments', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect("edit-department?id=$id", $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'faculties'=> $faculties,
    'superstaff'=> $superstaff,
    'department'=> $department
];

management_view('edit-department', $context);