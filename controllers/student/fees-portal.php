<?php

// Authorizing student
$student = student_logged_in();

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Pay Fess";


// Handling incoming AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Checking for csrf attack
    if ($data['csrf_token'] != $_SESSION['csrf_token']) {
        // Send response as JSON
        echo json_encode(['status'=> "failed", 'message'=> "Invalid request"]);
        die();
    }

    // Declaring DB parameters as array
    $fee_data = [
        'invoice_id'=> sanitize_input($data['invoice_id']),
        'student_id'=> $student['id'],
        'department_id'=> $student['department_id'],
        'level'=> $student['level'],
        'amount'=> sanitize_input($data['amount']),
        'purpose'=> sanitize_input($data['purpose']),
        'payment_method'=> sanitize_input($data['payment_method']),
    ];

    // Process data here
    try {
        $sql = "INSERT INTO fees (invoice_id, student_id, department_id, level, amount, purpose, payment_method) VALUES (:invoice_id, :student_id, :department_id, :level, :amount, :purpose, :payment_method)";
        $query = query_db($sql, $fee_data);
        $response = ['status'=> "success", 'message'=> "Fee payment was successful"];
    } catch(Exception $e) {
        $response = ['status'=> "failed", 'message'=> "An error was encountered processing your payment"];
    }
    
    // Send response as JSON
    echo json_encode($response);
    die();
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'student'=> $student
];

student_view('fees-portal', $context);