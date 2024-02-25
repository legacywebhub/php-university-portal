<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Authenticating view
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect if no faculty id passed
    redirect("faculties");
} else {

    try {
        $id = intval($_GET['id']);
        $matching_faculties = query_fetch("SELECT * FROM faculties WHERE id = $id LIMIT 1");

        if (empty($matching_faculties)) {
            // Redirect if no matching faculty
            redirect("faculties");
        } else {
            // Else return faculty
            $faculty = $matching_faculties[0];
        }
    } catch (Exception) {
        redirect("faculties");
    }
}

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Edit faculty";

// Handling edit faculty request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Declaring DB variables as PHP array
    $data = [
        'id' => $faculty['id'],
        'name' => sanitize_input($_POST['name'])
    ];
    
    try {
        $query = "UPDATE faculties SET name = :name WHERE id = :id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Faculty was successfully updated";
        $message_tag = "success";
        redirect('faculties', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect("edit-faculty?id=$id", $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'faculty'=> $faculty
];

management_view('edit-faculty', $context);