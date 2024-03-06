<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// View variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Dashboard";

// Appending extra staff details
$superstaff += [
    'total_students'=> query_fetch("SELECT COUNT(*) AS total_students FROM students")[0]['total_students'],
    'total_staffs'=> query_fetch("SELECT COUNT(*) AS total_staffs FROM staffs")[0]['total_staffs'],
    'total_superstaffs'=> query_fetch("SELECT COUNT(*) AS total_superstaffs FROM staffs WHERE is_superuser = 1")[0]['total_superstaffs'],
    'total_faculties'=> query_fetch("SELECT COUNT(*) AS total_faculties FROM faculties")[0]['total_faculties'],
    'total_departments'=> query_fetch("SELECT COUNT(*) AS total_departments FROM departments")[0]['total_departments'],
    'total_courses'=> query_fetch("SELECT COUNT(*) AS total_courses FROM courses")[0]['total_courses'],
    'total_lessons'=> query_fetch("SELECT COUNT(*) AS total_lessons FROM lessons")[0]['total_lessons'],
    'total_messages'=> query_fetch("SELECT COUNT(*) AS total_messages FROM messages")[0]['total_messages'],
    //'total_revenue'=> query_fetch("SELECT SUM(amount) AS total_revenue FROM deposits WHERE status = 'approved'")[0]['total_revenue']
];

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'superstaff'=> $superstaff
];

management_view('dashboard', $context);