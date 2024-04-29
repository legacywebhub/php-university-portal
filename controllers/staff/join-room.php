<?php

// Authorizing staff
$staff = staff_logged_in();

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
    } else if (!empty($matched_rooms) && time() > strtotime($matched_rooms[0]['expires'])) {
        // Delete expired room and redirect user 
        $room = $matched_rooms[0]['name'];
        query_fetch("DELETE FROM rooms WHERE name = '$room' LIMIT 1");
        redirect('join-room', "Room is expired", "danger");
    } else {
        // Create room and redirect user
        try {
            $room_expiry = date("Y-m-d H:i:s", time() + 24 * 60 * 60); // 24 hours after creation
            $query = "INSERT INTO rooms (name, expires) VALUES (:name, :expires)";
            query_db($query, ['name'=> $room, 'expires'=> $room_expiry]);
            $room_page = ROOT."/connect/room?name=".$room;
            header("Location: $room_page");
        } catch(Exception $e) {
            redirect('join-room', "A room already exist with this name", "danger");
        }
    }
       
}

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'staff'=> $staff
];

staff_view('join-room', $context);