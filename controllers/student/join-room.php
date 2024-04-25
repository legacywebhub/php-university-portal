<?php

// Variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Join room";

// Handling join room request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    $room = sanitize_input($_POST['room']);
    $matched_rooms = query_fetch("SELECT * FROM rooms WHERE name = '$room' LIMIT 1");

    if (!empty($matched_rooms) && time() <= strtotime($matched_rooms[0]['expires'])) {
        // redirect user to room if room exists and not expired
        $room_page = ROOT."/connect/room?name=".$matched_rooms[0]['name'];
        header("Location: $room_page");
    } else {
        redirect('join-room', "Invalid room", "danger");
    }
       
}

$context = [
    'uni'=> $uni,
    'title'=> $title
];

student_view('join-room', $context);