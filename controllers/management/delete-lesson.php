<?php

// Authorizing management staff
$superstaff = superstaff_logged_in();

// Redirecting if lesson id not provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect("courses");
} else {

    // Checking if staff is superuser
    if ($superstaff['is_superuser'] == 0) {
        redirect("courses", "Sorry.. You don't have such privilege", "danger");
    }

    // Getting id
    $id = intval($_GET['id']);
    //  Checking for matching lessons
    $matched_lessons = query_fetch("SELECT * FROM lessons WHERE id = $id LIMIT 1");

    // If a record exists
    if (!empty($matched_lessons)) {
        // Fetch the lesson id
        $lesson = $matched_lessons[0];
        $lesson_id = $lesson['id'];
        $course_id = $lesson['course_id'];

        // DELETING CONNECTED LESSON FILES

        // Delete previous lesson videos if any
        $videos = query_fetch("SELECT * FROM videos WHERE lesson_id = $lesson_id");

        if (count($videos) > 0) {
            // Looping through all connected videos
            foreach($videos as $video) {
                $video_name = $video['video'];
                // Creating link or path to the video file
                $file = MEDIA_PATH.'lessons/videos/'.$video_name;

                if (file_exists($file)) {
                    // Deleting from media folder
                    unlink($file);
                }
                // Deleting video record from database
                query_fetch("DELETE FROM videos WHERE video = '$video_name' LIMIT 1");
            }
        }

        // Delete previous lesson documents if any
        $documents = query_fetch("SELECT * FROM documents WHERE lesson_id = $lesson_id");
                    
        if (count($documents) > 0) {
            // Looping through all connected documents
            foreach($documents as $document) {
                $document_name = $document['document'];
                // Creating link or path to the document file
                $file = MEDIA_PATH.'lessons/documents/'.$document_name;

                if (file_exists($file)) {
                    // Deleting from media folder
                    unlink($file);
                }
                // Deleting document record from database
                query_fetch("DELETE FROM documents WHERE document = '$document_name' LIMIT 1");
            }
        }
        
        // Deleting lesson finally from database
        query_fetch("DELETE FROM lesson WHERE id = $lesson_id LIMIT 1");
        // Redirect to lessons page
        redirect("lessons?course_id=$course_id", "Lesson successfully deleted", "success");
    }
    redirect("courses", "Invalid lesson", "danger");
}