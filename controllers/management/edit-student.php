<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Authenticating view
if (!isset($_GET['id'])) {
    // Redirect if no student id passed
    redirect("students");
} else {

    try {
        $id = intval($_GET['id']);
        $matching_students = query_fetch("SELECT * FROM students WHERE id = $id LIMIT 1");

        if (empty($matching_students)) {
            // Redirect if no matching students
            redirect("students");
        } else {
            // Else return student
            $student = $matching_students[0];
        }
    } catch (Exception) {
        redirect("students");
    }
}

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Edit Student";
$departments = query_fetch("SELECT * FROM departments");


// Handling add service request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Checking if passport file was sent
    if (!empty($_FILES['passport']['name'])) {
        // Validate and process logo image
        $upload_image = upload_image($_FILES['passport'], 'users');

        if ($upload_image['status'] == "success") {
            // Setting uploaded image as passort
            $passport = $upload_image['new_file_name'];
        } else {
            $passport = $student['passport'];
        }
        
    } else {
        $passport = $student['passport'];
    }

    // Declaring post variables as PHP array
    $data = [
        'id' => $id,
        'passport' => $passport,
        'department_id' => sanitize_input($_POST['department']),
        'level' => sanitize_input($_POST['level']),
        'firstname' => sanitize_input($_POST['fname']),
        'middlename' => sanitize_input($_POST['mname']),
        'lastname' => sanitize_input($_POST['lname']),
        'gender' => sanitize_input($_POST['gender']),
        'dob' => sanitize_input($_POST['dob']),
        'email' => sanitize_input($_POST['email']),
        'phone' => sanitize_input($_POST['phone']),
    ];
    
    // Saving data to DB
    try {
        $query = "UPDATE students SET passport=:passport, department_id=:department_id, level=:level, firstname=:firstname, middlename=:middlename, lastname=:lastname, gender=:gender, dob=:dob, email=:email, phone=:phone WHERE id=:id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Student was successfully updated";
        $message_tag = "success";
        redirect('students', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect("edit-student?id=$id", $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'departments'=> $departments,
    'student'=> $student
];

management_view('edit-student', $context);