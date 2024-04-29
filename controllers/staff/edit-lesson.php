<?php

// Authorizing staff
$staff = staff_logged_in();

// Authenticating view
if (!isset($_GET['lesson_id']) || !is_numeric($_GET['lesson_id'])) {
    // Redirect if no lesson id passed
    redirect("courses");
} else {
    try {
        $lesson_id = intval($_GET['lesson_id']);
        $matched_lessons = query_fetch("SELECT * FROM lessons WHERE id = $lesson_id LIMIT 1");

        if (empty($matched_lessons)) {
            // Redirect if no matching lesson
            redirect("courses");
        } else {
            // Else return lesson
            $lesson = $matched_lessons[0];
            $lesson_id = $lesson['id'];
            // Fetching connected course 
            $course_id = $lesson['course_id'];
            $course = query_fetch("SELECT * FROM courses WHERE id = $course_id LIMIT 1")[0];
        }
    } catch (Exception) {
        redirect("courses");
    }
}
// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Edit Lesson";


// Handling edit lesson request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Declaring DB variables as PHP array
    $data = [
        'id' => $lesson_id,
        'title' => sanitize_input($_POST['title']),
        'content' => $_POST['content']
    ];

    try {
        $query = "UPDATE lessons SET title = :title, content = :content WHERE id = :id LIMIT 1";
        $query = query_db($query, $data);

        if (!empty($_FILES['video']['name'])) {
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

            // Uploading lesson video
            $uploaded_video = upload_video($_FILES['video'], 'lessons/videos');

            if ($uploaded_video['status'] == "success") {
                // Saving each video to DB
                $query = "INSERT INTO videos (lesson_id, video) VALUES (:lesson_id, :video)";
                $query = query_db($query, ['lesson_id'=>$lesson_id, 'video'=>$uploaded_video['new_file_name']]);
            }
        }
    
        if (!empty($_FILES['documents'])) {
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

            // Uploading lesson documents
            $uploaded_docs = upload_multiple_documents($_FILES['documents'], 'lessons/documents');

            if ($uploaded_docs['status'] == "success" || $uploaded_docs['status'] == "partial") {
                // Saving each documents to DB
                foreach ($uploaded_docs['documents'] as $document) {
                    $query = "INSERT INTO documents (lesson_id, document) VALUES (:lesson_id, :document)";
                    $query = query_db($query, ['lesson_id'=>$lesson_id, 'document'=>$document]);
                }
            }
        }
        redirect("lessons?course_id=$course_id", "Lesson was successfully updated", "success");
    } catch(Exception $error) {
        redirect("lessons?lesson_id=$lesson_id", "Error while saving data: $error", "danger");
    }
    
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'staff'=> $staff,
    'course'=> $course,
    'lesson'=> $lesson
];

staff_view('edit-lesson', $context);