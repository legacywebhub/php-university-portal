<?php

// Authorizing student
$student = student_logged_in();

// Authenticating view
if (!isset($_GET['invoice_id'])) {
    // Redirect if no invoice id passed
    redirect("fees");
} else {
    try {
        $invoice_id = sanitize_input($_GET['invoice_id']);
        $matched_fees = query_fetch("SELECT * FROM fees WHERE invoice_id = $invoice_id LIMIT 1");

        if (empty($matched_fees)) {
            // Redirect if no matching fee
            redirect("fees");
        } else {
            // Else return fee
            $fee = $matched_fees[0];
        }
    } catch (Exception) {
        redirect("fees");
    }
}
// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Receipt";


// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'student'=> $student,
    'fee'=> $fee,
];

student_view('fee-receipt', $context);