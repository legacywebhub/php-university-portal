<?php

// Authorizing student
$student = student_logged_in();
$student_id = $student['id'];

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Fees";
$fees = query_fetch("SELECT * FROM fees WHERE student_id = $student_id");


$context = [
    'uni'=> $uni,
    'title'=> $title,
    'student'=> $student,
    'fees'=> $fees
];

student_view('fees', $context);