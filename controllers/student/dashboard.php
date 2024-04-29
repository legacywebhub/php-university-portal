<?php

// Authorizing student
$student = student_logged_in();
$student_id = $student['id'];
$student_department_id = $student['department_id'];
$student_level = $student['level'];

// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Dashboard";
$coursemates = query_fetch("SELECT * FROM students WHERE department_id = $student_department_id AND level = $student_level AND id != $student_id");
$my_messages = query_fetch("SELECT * FROM messages WHERE receiver_id = $student_id LIMIT 3");

// Appending extra student details
$student += [
    'faculty_id' => query_fetch("SELECT * FROM departments WHERE id = $student_department_id LIMIT 1")[0]['faculty_id']
];

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

    // Checking if the reply form was sent
    if (isset($data['reply'])) {
        $reply_data = [
            'sender_id'=> $student_id,
            'receiver_id'=> sanitize_input($data['receiver_id']),
            'subject'=> sanitize_input($data['subject']),
            'message'=> sanitize_input($data['reply'])
        ];

        // Process data here
        try {
            $sql = "INSERT INTO messages (sender_id, receiver_id, subject, message) VALUES (:sender_id, :receiver_id, :subject, :message)";
            $query = query_db($sql, $reply_data);
            $response = ['status'=> "success", 'message'=> "Reply was successfully sent"];
        } catch(Exception $e) {
            $response = ['status'=> "failed", 'message'=> "Service unavailable at the moment"];
        }
    }

    // Checking if message form was sent
    if (isset($data['message'])) {
        $matric_number = sanitize_input($data['reg_no']);      
        $receiver_id = query_fetch("SELECT id FROM students WHERE matric_number = '$matric_number' LIMIT 1")[0]['id'];

        if (empty($receiver_id) || is_null($receiver_id)) {
            $response = ['status'=> "failed", 'message'=> "Invalid matric number"];
        } else {
            $message_data = [
                'sender_id'=> $student_id,
                'receiver_id'=> $receiver_id,
                'subject'=> sanitize_input($data['subject']),
                'message'=> sanitize_input($data['message'])
            ];

            // Process data here
            try {
                $sql = "INSERT INTO messages (sender_id, receiver_id, subject, message) VALUES (:sender_id, :receiver_id, :subject, :message)";
                $query = query_db($sql, $message_data);
                $response = ['status'=> "success", 'message'=> "Message was successfully sent"];
            } catch(Exception $e) {
                $response = ['status'=> "failed", 'message'=> "Service unavailable at the moment"];
            }
        }
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
    'student'=> $student,
    'coursemates'=> $coursemates,
    'my_messages'=> $my_messages
];

student_view('dashboard', $context);