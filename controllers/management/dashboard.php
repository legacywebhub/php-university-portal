<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// View variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Dashboard";
/*
// Checking for search in get request
if (isset($_GET['search'])) {
    $search =  strval($_GET['search']);
    $vehicles = paginate("SELECT * FROM vehicles WHERE name LIKE '%$search%' ORDER BY id DESC", 15);
} else {
    $vehicles = paginate("SELECT * FROM vehicles ORDER BY id DESC", 15);
}
*/

$context = [
    'uni'=> $uni,
    'title'=>$title,
    'superstaff'=>$superstaff
];

management_view('dashboard', $context);