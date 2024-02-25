<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Authenticating view
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect if no course id passed
    redirect("courses");
} else {

    try {
        $id = intval($_GET['id']);
        $matching_courses = query_fetch("SELECT * FROM courses WHERE id = $id LIMIT 1");

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
$title = ucfirst($uni['name'])." | Edit Course";
$departments = query_fetch("SELECT * FROM departments");


// Handling edit course request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Checking if course image file was sent
    if (!empty($_FILES['course_image']['name'])) {
        // Validate and process course image
        $upload_image = upload_image($_FILES['course_image'], 'users');

        if ($upload_image['status'] == "success") {
            // Setting uploaded image as course image
            $course_image = $upload_image['new_file_name'];
        } else {
            $course_image = $course['course_image'];
        }
        
    } else {
        $course_image = $course['course_image'];
    }

    // Declaring DB variables as PHP array
    $data = [
        'id'=> $id,
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
        $query = "UPDATE courses SET department_id = :department_id, level = :level, semester = :semester, lecturers = :lecturers, course_image = :course_image, course_code = :course_code, title = :title, description = :description WHERE id = :id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Course was successfully updated";
        $message_tag = "success";
        redirect('courses', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect("edit-course?id=$id", $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'departments'=> $departments,
    'course'=> $course
];

management_view('edit-course', $context);