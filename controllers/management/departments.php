<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Departments";

if (isset($_GET['search'])) {
    // If a department was searched by name
    $search = $_GET['search'];
    $departments = paginate("SELECT * FROM departments WHERE name = '$search'", 15);
} else {
    // Else return all departments
    $departments = paginate("SELECT * FROM departments ORDER BY id DESC", 15);
}

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'departments'=> $departments
];

management_view('departments', $context);