<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Faculties";

if (isset($_GET['search'])) {
    // If a faculty was searched by name
    $search = $_GET['search'];
    $faculties = paginate("SELECT * FROM faculties WHERE name = '$search'", 15);
} else {
    // Else return all faculties
    $faculties = paginate("SELECT * FROM faculties ORDER BY id DESC", 15);
}

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff,
    'faculties'=> $faculties
];

management_view('faculties', $context);