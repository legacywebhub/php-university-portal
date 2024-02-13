<?php

// Variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Staff Login";

// Handling staff sign in request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    // Checking for which form was submitted using the name on the button
    // Returns true or false depending on whether it is set or not

    $staff_id = sanitize_input($_POST['staff_id']);
    $password = sanitize_input($_POST['password']);


    if (empty($staff_id) || empty($password)) {
        redirect('login', "ID or password cannot be empty", 'danger');
    } else {
        $user = authenticate_staff(sanitize_input($staff_id), sanitize_input($password));

        if ($user){
            // Unset any previous session
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']);
            }
            // Set user session id
            $_SESSION['user'] = $user;

            if ($user['is_superuser'] == 0) {
                // If not management staff
                redirect('dashboard');
            } else if ($user['is_superuser'] == 1) {
                // If management staff
                $superstaff_dashboard = ROOT.'/management/dashboard';
                redirect($superstaff_dashboard);
            }
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


include(APP_PATH . "views/staff/login.view.php");

unset_message();