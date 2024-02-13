<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Add Staff";
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
            $passport = null;
        }
        
    } else {
        $passport = null;
    }

    // Declaring post variables as PHP array
    $data = [
        'passport' => $passport,
        'staff_id' => generate_staff_ID($_POST['department']),
        'department_id' => sanitize_input($_POST['department']),
        'role' => sanitize_input($_POST['role']),
        'title' => sanitize_input($_POST['title']),
        'firstname' => sanitize_input($_POST['fname']),
        'middlename' => sanitize_input($_POST['mname']),
        'lastname' => sanitize_input($_POST['lname']),
        'gender' => sanitize_input($_POST['gender']),
        'dob' => strrev(sanitize_input($_POST['dob'])),
        'email' => sanitize_input($_POST['email']),
        'phone' => sanitize_input($_POST['phone']),
        'password' => password_hash("password", PASSWORD_DEFAULT),
        'is_superuser' => sanitize_input($_POST['is_superuser'])
    ];

    // Validation
    if (empty($data['firstname'])) {
        redirect('add-staff', "First name cannot be blank or have spaces", 'danger');
    } else if (is_numeric($data['firstname'])) {
        redirect('add-staff', "First name cannot be numeric", 'danger');
    } else if (strlen($data['firstname']) < 3 || strlen($data['firstname']) > 60) {
        redirect('add-staff', "First name cannot be less than 3 or more than 60 characters", 'danger');
    }

    if (empty($data['lastname'])) {
        redirect('add-staff', "Last name cannot be blank or have spaces", 'danger');
    } else if (is_numeric($data['lastname'])) {
        redirect('add-staff', "Last name cannot be numeric", 'danger');
    } else if (strlen($data['lastname']) < 3 || strlen($data['lastname']) > 60) {
        redirect('add-staff', "Last name cannot be less than 3 or more than 60 characters", 'danger');
    }

    if (empty($data['email'])) {
        redirect('add-staff', "Email is not valid", 'danger');
    } else if (strlen($data['email']) > 60) {
        redirect('add-staff', "Email cannot be more than 60 characters", 'danger');
    } else if (staff_email_exists($data['email'])) {
        redirect('add-staff', "Email has already been used", 'danger');
    }
    

    // Saving data to DB
    try {
        $query = "INSERT INTO staffs (passport, staff_id, department_id, role, gender, title, firstname, middlename, lastname, dob, email, phone, password, is_superuser) 
        VALUES (:passport, :staff_id, :department_id, :role,  :gender, :title, :firstname, :middlename, :lastname, :dob, :email, :phone, :password, :is_superuser)";
        $query = query_db($query, $data);
        $message = "Staff was registered successfully";
        $message_tag = "success";
        redirect('staffs', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('add-staff', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'departments'=> $departments
];

management_view('add-staff', $context);