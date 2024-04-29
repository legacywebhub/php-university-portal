<?php

// Authorizing staff
$staff = staff_logged_in();

// Authenticating view
if (!isset($_GET['course_id']) || !is_numeric($_GET['course_id'])) {
    // Redirect if no course id passed
    redirect("courses");
} else {

    try {
        $course_id = intval($_GET['course_id']);
        $matching_courses = query_fetch("SELECT * FROM courses WHERE id = $course_id LIMIT 1");

        if (empty($matching_courses)) {
            // Redirect if no matching course
            redirect("courses");
        } else {
            // Else return course
            $course = $matching_courses[0];
            $course_id = $course['id'];
        }
    } catch (Exception) {
        redirect("courses");
    }
}
// Other variables
$uni = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($uni['name'])." | Add Lesson";


// Handling add lesson request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Declaring DB variables as PHP array
    $data = [
        'course_id' => sanitize_input($_POST['course']),
        'title' => sanitize_input($_POST['title']),
        'content' => $_POST['content']
    ];

    try {
        $query = "INSERT INTO lessons (course_id, title, content) VALUES (:course_id, :title, :content)";
        $inserted_id = query_return_id($query, $data);

        if (!is_null($inserted_id)) {
            $lesson_id = intval($inserted_id);

            if (!empty($_FILES['video']['name'])) {
                // Uploading lesson video
                $uploaded_video = upload_video($_FILES['video'], 'lessons/videos');
    
                if ($uploaded_video['status'] == "success") {
                    // Saving each video to DB
                    $query = "INSERT INTO videos (lesson_id, video) VALUES (:lesson_id, :video)";
                    $query = query_db($query, ['lesson_id'=>$lesson_id, 'video'=>$uploaded_video['new_file_name']]);
    
                }
            }
    
            if (!empty($_FILES['documents'])) {
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
            redirect("lessons?course_id=$course_id", "Lesson was successfully added", "success");
        } else {
            redirect("lessons?course_id=$course_id", "Data was not saved", "danger");
        }

    } catch(Exception $error) {
        redirect("lessons?course_id=$course_id", "Error while saving data: $error", "danger");
    }
    
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'uni'=> $uni,
    'title'=> $title,
    'staff'=> $staff,
    'course'=> $course
];

staff_view('add-lesson', $context);