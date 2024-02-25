<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Redirecting course if id not provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect("courses");
} else {

    // Checking if staff is superuser
    if ($superstaff['is_superuser'] == 0) {
        redirect("courses", "Sorry.. You don't have such privilege", "danger");
    }

    // Getting id
    $id = intval($_GET['id']);
    //  Checking for matching courses
    $matched_courses = query_fetch("SELECT * FROM courses WHERE id = $id LIMIT 1");

    // If a record exists
    if (!empty($matched_courses)) {
        // Fetch the course
        $course = $matched_courses[0];

        // Deleting connected course image
        if (!empty($course['course_image'])) {
            // Creating link or path to the course image file
            $filename = MEDIA_PATH.'courses/'.$course['course_image'];

            if (file_exists($filename)) {
                // Deleting course image from media folder
                unlink($filename);
            }
        }
        
        // Deleting course finally from database
        query_fetch("DELETE FROM courses WHERE id = $id");
        // Redirect to courses page
        redirect("courses", "Course successfully deleted", "success");
    }
    redirect("courses", "Invalid course", "danger");
}