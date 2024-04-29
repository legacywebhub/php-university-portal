<?php

// Authorizing staff
$staff = staff_logged_in();
$staff_id = $staff['staff_id'];
$staff_department_id = $staff['department_id'];

// View variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Dashboard";
$colleagues = query_fetch("SELECT * FROM staffs WHERE department_id = $staff_department_id AND staff_id != '$staff_id'");

// Appending extra staff details
$staff += [
    'total_professors'=> query_fetch("SELECT COUNT(*) AS total_staffs FROM staffs WHERE role = 'professor' AND department_id = ".$staff['department_id'])[0]['total_staffs'],
    'total_staffs'=> query_fetch("SELECT COUNT(*) AS total_staffs FROM staffs WHERE department_id = ".$staff['department_id'])[0]['total_staffs'],
    'total_students'=> query_fetch("SELECT COUNT(*) AS total_students FROM students WHERE department_id = ".$staff['department_id'])[0]['total_students'],
    'total_courses'=> query_fetch("SELECT COUNT(*) AS total_courses FROM courses WHERE department_id = ".$staff['department_id'])[0]['total_courses'],
];

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'staff'=> $staff,
    'colleagues'=> $colleagues
];

staff_view('dashboard', $context);