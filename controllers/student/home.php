<?php

// Authenticating user
//$admin = admin_logged_in();

// View variables
//$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
//$title = ucfirst($company['name'])." | Vehicles";
/*
// Checking for search in get request
if (isset($_GET['search'])) {
    $search =  strval($_GET['search']);
    $vehicles = paginate("SELECT * FROM vehicles WHERE name LIKE '%$search%' ORDER BY id DESC", 15);
} else {
    $vehicles = paginate("SELECT * FROM vehicles ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'vehicles'=> $vehicles
];
*/
student_view('home', $context);