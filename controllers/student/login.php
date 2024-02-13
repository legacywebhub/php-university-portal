<?php

// Variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Student Login";

// Handling sign in request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    // Checking for which form was submitted using the name on the button
    // Returns true or false depending on whether it is set or not

    $matric_number = $_POST['matric_number'];
    $password = $_POST['password'];

    if (empty($matric_number) || empty($password)) {
        redirect('login', "Matric ID or password cannot be empty", 'danger');
    } else {
        $user = authenticate_student(sanitize_input($matric_number), sanitize_input($password));

        if ($user){
            // Unset any previous session
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']);
            }
            // Set user session id
            $_SESSION['user'] = $user;
            redirect('dashboard');
        } else {
            redirect('login', "Invalid credentials", 'danger');
        }
    }
        
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
];


include(APP_PATH . "views/student/login.view.php");

unset_message();