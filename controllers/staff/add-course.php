<?php

// Authorizing staff
$staff = staff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Add Course";
$departments = query_fetch("SELECT * FROM departments");


// Handling add course request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Checking if course image file was sent
    if (!empty($_FILES['course_image']['name'])) {
        // Validate and process course image
        $upload_image = upload_image($_FILES['course_image'], 'users');

        if ($upload_image['status'] == "success") {
            // Setting uploaded image as passort
            $course_image = $upload_image['new_file_name'];
        } else {
            $course_image = null;
        }
        
    } else {
        $course_image = null;
    }

    // Declaring DB variables as PHP array
    $data = [
        'department_id' => sanitize_input($_POST['department']),
        'level' => sanitize_input($_POST['level']),
        'semester' => sanitize_input($_POST['semester']),
        'lecturers' => ucwords(sanitize_input($_POST['lecturers'])),
        'course_image' => $course_image,
        'course_code' => strtoupper(sanitize_input($_POST['course_code'])),
        'title' => ucwords(sanitize_input($_POST['course_title'])),
        'description' => sanitize_input($_POST['course_description']),
    ];
    
    try {
        $query = "INSERT INTO courses (department_id, level, semester, lecturers, course_image, course_code, title, description) 
        VALUES (:department_id, :level, :semester, :lecturers, :course_image, :course_code, :title, :description)";
        $query = query_db($query, $data);
        $message = "Course was successfully added";
        $message_tag = "success";
        redirect('courses', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('add-course', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'staff'=> $staff,
    'departments'=> $departments
];

staff_view('add-course', $context);