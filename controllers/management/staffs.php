<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Staffs";

if (isset($_GET['search'])) {
    // If a student was searched by staff_id
    $search = $_GET['search'];
    $staffs = paginate("SELECT * FROM staffs WHERE staff_id = '$search'", 15);
} else {
    // Else return all staffs
    $staffs = paginate("SELECT * FROM staffs ORDER BY id DESC", 15);
}

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'staffs'=> $staffs
];

management_view('staffs', $context);