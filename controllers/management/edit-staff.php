<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Authenticating view
if (!isset($_GET['id'])) {
    // Redirect if no staff id passed
    redirect("staffs");
} else {

    try {
        $id = intval($_GET['id']);
        $matching_staffs = query_fetch("SELECT * FROM staffs WHERE id = $id LIMIT 1");

        if (empty($matching_staffs)) {
            // Redirect if no matching staffs
            redirect("staffs");
        } else {
            // Else return staff
            $staff = $matching_staffs[0];
        }
    } catch (Exception) {
        redirect("staffs");
    }
}

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Edit Staff";
$departments = query_fetch("SELECT * FROM departments");


// Handling edit staff request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    //print_r($_FILES); die();
    // Checking if passport file was sent
    if (!empty($_FILES['passport']['name'])) {
        // Validate and process logo image
        $upload_image = upload_image($_FILES['passport'], 'users');

        if ($upload_image['status'] == "success") {
            // Setting uploaded image as passort
            $passport = $upload_image['new_file_name'];
        } else {
            $passport = $staff['passport'];
        }
        
    } else {
        $passport = $staff['passport'];
    }

    // Declaring post variables as PHP array
    $data = [
        'id' => $id,
        'passport' => $passport,
        'department_id' => sanitize_input($_POST['department']),
        'role' => sanitize_input($_POST['role']),
        'title' => sanitize_input($_POST['title']),
        'firstname' => sanitize_input($_POST['fname']),
        'middlename' => sanitize_input($_POST['mname']),
        'lastname' => sanitize_input($_POST['lname']),
        'gender' => sanitize_input($_POST['gender']),
        'dob' => sanitize_input($_POST['dob']),
        'email' => sanitize_input($_POST['email']),
        'phone' => sanitize_input($_POST['phone']),
        'is_superuser' => sanitize_input($_POST['is_superuser'])
    ];
    
    // Saving data to DB
    try {
        $query = "UPDATE staffs SET passport=:passport, department_id=:department_id, role=:role,  gender=:gender, title=:title, firstname=:firstname, middlename=:middlename, lastname=:lastname, dob=:dob, email=:email, phone=:phone, is_superuser=:is_superuser WHERE id=:id LIMIT 1";
        $query = query_db($query, $data);
        $message = "Staff was successfully updated";
        $message_tag = "success";
        redirect('staffs', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect("edit-staff?id=$id", $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'departments'=> $departments,
    'staff'=> $staff
];

management_view('edit-staff', $context);