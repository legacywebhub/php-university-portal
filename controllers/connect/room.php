<?php

// Authenticating view
if (!isset($_GET['name'])) {
    // Die if no room name passed
    die('<h1>No Room Identified</h1>');
} else {
    try {
        $room = sanitize_input($_GET['name']);
        $matched_rooms = query_fetch("SELECT * FROM rooms WHERE name = '$room' LIMIT 1");

        if (empty($matched_rooms)) {
            // Die if no matching rooms
            die('<h1>Invalid Room</h1>');
        } else if (time() > strtotime($matched_rooms[0]['expires'])) {
            // Die if room has expired
            die('<h1>This Room Has Expired</h1>');
        } else {
            $room = $matched_rooms[0];
        }
    } catch (Exception) {
        die('<h1>An error occured</h1>');
    }

    // Variables
    $uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
    $title = ucfirst($uni['name'])." | Room";

    $context = [
        'uni'=> $uni,
        'title'=> $title,
        'room'=> $room
    ];
    
    include(VIEW_PATH."connect/room.view.php");
}

