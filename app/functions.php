<?php

// PHPMAILER

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require APP_PATH."app/PHPMailer/src/Exception.php";
require APP_PATH."app/PHPMailer/src/PHPMailer.php";
require APP_PATH."app/PHPMailer/src/SMTP.php";



//////////////////////// SECURITY FUNCTIONS ///////////////////////////////

// FUNCTION TO SANITIZE USER INPUTS
function sanitize_input($input) {
    // Replace characters that may be used in SQL injection
    $input = str_replace("'", '', $input);
    $input = str_replace('"', '', $input);
    $input = str_replace(';', '', $input);
    $input = str_replace('=', '', $input);

    // Strip HTML and PHP tags
    $input = strip_tags(trim($input));

    return $input;
}

// FUNCTION TO GENERATE CSRF TOKENS
function generate_csrf_token() {
    $csrf_token = bin2hex(random_bytes(32)); // Generate a random token
    $_SESSION['csrf_token'] = $csrf_token; // Store the token in the user's session

    return $csrf_token;
}



//////////////////////// AUTH FUNCTIONS ///////////////////////////////

// FUNCTIONS RETURNS USER DATA IF AUTHENTICATED OR FALSE IS UNAUTHENTICATED
// NOTE THIS FUNCTION DOES NOT REDIRECT OR AUTHORIZE USERS
function is_user_authenticated(string $table) {
    if (isset($_SESSION['user'])) {
        // Getting the user id value stored in the session
        $user_id = intval($_SESSION['user']['id']);

        // Making a connection using PDO
        $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
        $con = new PDO($string, DBUSER, DBPASS);

        // Making a query to select item from the database
        $query = "select * from $table where id = $user_id limit 1";
        $result = $con->query($query);
        $users = $result->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($users)) {
            // Return the user result
            // if query result not empty 
            return $users[0];
        }
    }
    // return empty user array by default
    return [];
}

// FUNCTION REDIRECT STUDENTS TO LOGIN PAGE IF NOT AUTHENTICATED
function student_logged_in() {
    $user = is_user_authenticated('students');
    // This function depends on is_user_authenticated() function
    if (empty($user) || $user['is_blocked']==1) {
        // Redirect if no student found or student is blocked
        redirect(ROOT."/student/login", "Please sign in", "danger");
    }
    return $user;
}

// FUNCTION REDIRECT STAFFS TO LOGIN PAGE IF NOT AUTHENTICATED
function staff_logged_in() {
    $user = is_user_authenticated('staffs');
    // This function depends on is_user_authenticated() function
    if (empty($user)) {
        // Redirect if no staff found
        redirect(ROOT."/staff/login", "Please sign in", "danger");
    } else if ($user['is_superuser'] == 1) {
        // Redirect to management dashboard if superstaff
        redirect(ROOT."management/dashboard");
    }
    return $user;
}

// FUNCTION REDIRECT MANAGEMENT STAFFS TO LOGIN PAGE IF NOT AUTHENTICATED
function superstaff_logged_in() {
    $user = is_user_authenticated('staffs');
    // This function depends on is_user_authenticated() function
    if (empty($user) || $user['is_superuser'] == 0) {
        // Redirect if no user found or user is not management staff
        redirect(ROOT."/staff/login");
    }
    return $user;
}

// FUNCTION TO CHECK IF STAFF EXISTS AND PASSWORD MATCHES DURING LOGIN
function authenticate_staff($staff_id, $password) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    // Making a query to check for staff from the database
    $query = "select * from staffs where staff_id = '$staff_id' limit 1";
    $result = $con->query($query);
    $staffs = $result->fetchAll(PDO::FETCH_ASSOC);

    // Result is returned as an array of all matched object even though it's
    // limited to one result, In this case, our user is at the first index
    if (!empty($staffs) && password_verify($password, $staffs[0]['password'])) {
        return $staffs[0];
    }
    return false;
}

// FUNCTION TO CHECK IF STUDENT EXISTS AND PASSWORD MATCHES DURING LOGIN
function authenticate_student($matric_number, $password) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    // Making a query to check for student from the database
    $query = "select * from students where matric_number = '$matric_number' limit 1";
    $result = $con->query($query);
    $students = $result->fetchAll(PDO::FETCH_ASSOC);

    // Result is returned as an array of all matched object even though it's
    // limited to one result, In this case, our user is at the first index
    if (!empty($students) && password_verify($password, $students[0]['password'])) {
        return $students[0];
    }
    return false;
}

// FUNCTION CHECKS IF THE GIVEN EMAIL OF A STAFF EXISTS IN THE DATABASE
function staff_email_exists(string $email) {
    try {
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    } catch (mysqli_sql_exception) {
        echo "Database Connection Error: " . mysqli_connect_error() . "<br><br>";
    }

    $query = "select * from staffs where email = '$email' limit 1";
    $result = mysqli_query($conn, $query);
    // number of results gotten from query
    $results = mysqli_num_rows($result);

    if ($results > 0) {
        return true;
    }
    return false;
}

// FUNCTION CHECKS IF THE GIVEN EMAIL OF A STUDENT EXISTS IN THE DATABASE
function student_email_exists($email) {
    try {
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    } catch (mysqli_sql_exception) {
        echo "Database Connection Error: " . mysqli_connect_error() . "<br><br>";
    }

    $query = "select * from students where email = '$email' limit 1";
    $result = mysqli_query($conn, $query);
    // number of results gotten from query
    $results = mysqli_num_rows($result);

    if ($results > 0) {
        return true;
    }
    return false;
}

// FUNCTION CHECKS IF THE GIVEN STAFF_ID EXISTS IN THE DATABASE
function staff_id_exists($staff_id) {
    try {
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    } catch (mysqli_sql_exception) {
        echo "Database Connection Error: " . mysqli_connect_error() . "<br><br>";
    }

    $query = "select * from staffs where staff_id = '$staff_id' limit 1";
    $result = mysqli_query($conn, $query);
    // number of results gotten from query
    $results = mysqli_num_rows($result);

    if ($results > 0) {
        return true;
    }
    return false;
}

// FUNCTION CHECKS IF THE GIVEN MATRIC NUMBER EXISTS IN THE DATABASE
function matric_number_exists($matric_number) {
    try {
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    } catch (mysqli_sql_exception) {
        echo "Database Connection Error: " . mysqli_connect_error() . "<br><br>";
    }

    $query = "select * from students where matric_number = '$matric_number' limit 1";
    $result = mysqli_query($conn, $query);
    // number of results gotten from query
    $results = mysqli_num_rows($result);

    if ($results > 0) {
        return true;
    }
    return false;
}


//////////////////////// VIEW FUNCTIONS ///////////////////////////////

// LANDING VIEW FUNCTION
function landing_view($name, $context=[]) {
    // Note that other included file path inside of
    // this layout view is relative to this file path 
    require(APP_PATH . "views/landing/layout.view.php");
    unset_message();
}

// STUDENT VIEW FUNCTION
function student_view($name, $context=[]) {
    // Note that other included file path inside of
    // this layout view is relative to this file path 
    require(APP_PATH . "views/student/layout.view.php");
    unset_message();
}

// STAFF VIEW FUNCTION
function staff_view($name, $context=[]) {
    // Note that other included file path inside of
    // this layout view is relative to this file path 
    require(APP_PATH . "views/staff/layout.view.php");
    unset_message();
}

// MANAGEMENT VIEW FUNCTION
function management_view($name, $context=[]) {
    // Note that other included file path inside of
    // this layout view is relative to this file path 
    require(APP_PATH . "views/management/layout.view.php");
    unset_message();
}

// FUNCTION TO UNSET MESSAGE AND MESSAGE TAGS
function unset_message() {
    // Resetting messages after each view has been displayed
    if (isset($_SESSION['message'])) {
        unset($_SESSION['message']);
    }

    if (isset($_SESSION['message_tag'])) {
        unset($_SESSION['message_tag']);
    }
}



//////////////////////// REGULAR FUNCTIONS ///////////////////////////////

// FUNCTION TO REDIRECT AND SET DISPLAY ERROR MESSAGE AND TAG
function redirect($page, $message='', $message_tag='info') {
    $_SESSION['message'] = $message;
    $_SESSION['message_tag'] = $message_tag;
    header("Location: $page");
    die();
}

// FUNCTION TO FORMAT DATE
function format_date($date) {
    return date("d M, Y", strtotime($date));
}

// FUNCTION TO FORMAT DATETIME
function format_datetime($date) {
    return date("d M, Y  H:i A", strtotime($date));
}

// FUNCTION TO GENERATE UNIQUE ID
function generate_unique_id($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Characters to choose from
    $id = '';

    for ($i = 0; $i < $length; $i++) {
        $id .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $id;
}

// FUNCTION TO REORGANISE MULTIPLE $_FILES OBJECTS
function organise_files($files) {

    // New empty array
    $organized_files = array();
    
    foreach ($files as $key => $fileAttributes) {
        foreach ($fileAttributes as $index => $value) {
            $organized_files[$index][$key] = $value;
        }
    }
    
    // Now $organized_files is an array of arrays
    // each representing a single file
    return $organized_files;
}

// FUNCTION TO VALIDATE AND UPLOAD SINGLE IMAGES
function upload_image($file, string $folder) {
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $response = [];

    if ($file_error === 0) {
        // If no errors
        if ($file_size > 2097152) {
            $response = [
                'status'=>"failed",
                'message'=> "File size is too large. Maximum allowable file size is 2mb"
            ];
        } else {
            // If file size is below size limit

            // Extracting file extension from file name
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            // Setting file extension to lowercase
            $file_extension = strtolower($file_extension);
            // Allowable extensions
            $accepted_extensions = array('jpeg', 'jpg', 'png');

            if (in_array($file_extension, $accepted_extensions)) {
                // If file extension is among accepted extensions

                // Generating a new unique name and appending to the file extension
                $new_file_name = uniqid("IMG-", true).'.'.$file_extension;
                // Defining the upload path
                $image_upload_path = MEDIA_PATH . '/' . $folder . '/' . $new_file_name;
                // Moving uploaded file to defined upload path
                move_uploaded_file($file_tmp_name, $image_upload_path);
                // Giving positive feedback or response
                $response = [
                    'status'=>"success",
                    'message'=> "Upload successful",
                    'new_file_name'=> $new_file_name
                ];
            } else {
                $response = [
                    'status'=>"failed",
                    'message'=> "Invalid file type"
                ];
            }
        }
    } else {
        $response = [
            'status'=>"failed",
            'message'=> "Unknown error occured"
        ];
    }
    return $response;
}

// FUNCTION TO VALIDATE AND UPLOAD MULTIPLE IMAGES
function upload_multiple_images($files, string $folder) {
    // Reorganising files
    $files = organise_files($files);
    // Number of files passed
    $total_files = count($files);
    // Default state
    $uploaded_files = [];
    $total_uploaded = 0;

    foreach($files as $file) {
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        

        if ($file_error === 0 && $file_size < 5242880) {
            // If no errors and file size is below size limit (5mb)
    
            // Extracting file extension from file name
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            // Setting file extension to lowercase
            $file_extension = strtolower($file_extension);
            // Allowable extensions
            $accepted_extensions = array('jpeg', 'jpg', 'png');

            if (in_array($file_extension, $accepted_extensions)) {
                // If file extension is among accepted extensions

                // Generating a new unique name and appending to the file extension
                $new_file_name = uniqid("IMG-", true).'.'.$file_extension;
                // Defining the upload path
                $image_upload_path = MEDIA_PATH . '/' . $folder . '/' . $new_file_name;
                // Moving uploaded file to defined upload path
                move_uploaded_file($file_tmp_name, $image_upload_path);
                // Adding new file to uploaded file list
                array_push($uploaded_files, $new_file_name);
                // Increment files uploaded
                $total_uploaded++;
            }

        }
    };

    if ($total_uploaded == $total_files) {
        $response = [
            'status'=>"success",
            'message'=> "All images uploaded successfully",
            'images' => $uploaded_files,
            'total_uploaded'=> $total_uploaded
        ];
    } else if ($total_uploaded > 0 && $total_uploaded < $total_files) {
        $response = [
            'status'=>"partial",
            'message'=> $total_uploaded." out of ".$total_files." images uploaded succesfully",
            'images' => $uploaded_files,
            'total_uploaded'=> $total_uploaded
        ];
    } else if ($total_uploaded == 0) {
        $response = [
            'status'=>"failed",
            'message'=> "No image was uploaded",
            'total_uploaded'=> $total_uploaded
        ];
    }
    return $response;
}

// FUNCTION TO VALIDATE AND UPLOAD SINGLE DOCUMENTS
function upload_document($file, string $folder) {
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $response = [];

    if ($file_error === 0) {
        // If no errors
        if ($file_size > 524288000) {
            $response = [
                'status'=>"failed",
                'message'=> "File size is too large. Maximum allowable file size is 500mb"
            ];
        } else {
            // If file size is below size limit

            // Extracting file extension from file name
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            // Setting file extension to lowercase
            $file_extension = strtolower($file_extension);
            // Allowable extensions
            $accepted_extensions = array('zip', 'rar', 'pdf', 'doc', 'docs', 'docx', 'csv', 'xlsx', 'ppt', 'jpeg', 'jpg');

            if (in_array($file_extension, $accepted_extensions)) {
                // If file extension is among accepted extensions

                // Generating a new unique name and appending to the file extension
                $new_file_name = uniqid("DOC-", true).'.'.$file_extension;
                // Defining the upload path
                $document_upload_path = MEDIA_PATH . '/' . $folder . '/' . $new_file_name;
                // Moving uploaded file to defined upload path
                move_uploaded_file($file_tmp_name, $document_upload_path);
                // Giving positive feedback or response
                $response = [
                    'status'=>"success",
                    'message'=> "Upload successful",
                    'new_file_name'=> $new_file_name
                ];
            } else {
                $response = [
                    'status'=>"failed",
                    'message'=> "Invalid file type"
                ];
            }
        }
    } else {
        $response = [
            'status'=>"failed",
            'message'=> "Unknown error occured"
        ];
    }
    return $response;
}

// FUNCTION TO VALIDATE AND UPLOAD MULTIPLE DOCUMENTS
function upload_multiple_documents($files, string $folder) {
    // Reorganising files
    $files = organise_files($files);
    // Number of files passed
    $total_files = count($files);
    // Default state
    $uploaded_files = [];
    $total_uploaded = 0;

    foreach($files as $file) {
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        

        if ($file_error === 0 && $file_size < 524288000) {
            // If no errors and file size is below size limit (500MB)
    
            // Extracting file extension from file name
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            // Setting file extension to lowercase
            $file_extension = strtolower($file_extension);
            // Allowable extensions
            $accepted_extensions = array('zip', 'rar', 'pdf', 'doc', 'docs', 'docx', 'csv', 'xlsx', 'ppt', 'jpeg', 'jpg');

            if (in_array($file_extension, $accepted_extensions)) {
                // If file extension is among accepted extensions

                // Generating a new unique name and appending to the file extension
                $new_file_name = uniqid("DOC-", true).'.'.$file_extension;
                // Defining the upload path
                $image_upload_path = MEDIA_PATH . '/' . $folder . '/' . $new_file_name;
                // Moving uploaded file to defined upload path
                move_uploaded_file($file_tmp_name, $image_upload_path);
                // Adding new file to uploaded file list
                array_push($uploaded_files, $new_file_name);
                // Increment files uploaded
                $total_uploaded++;
            }

        }
    };

    if ($total_uploaded == $total_files) {
        $response = [
            'status'=>"success",
            'message'=> "All docs uploaded successfully",
            'documents' => $uploaded_files,
            'total_uploaded'=> $total_uploaded
        ];
    } else if ($total_uploaded > 0 && $total_uploaded < $total_files) {
        $response = [
            'status'=>"partial",
            'message'=> $total_uploaded." out of ".$total_files." docs uploaded succesfully",
            'documents' => $uploaded_files,
            'total_uploaded'=> $total_uploaded
        ];
    } else if ($total_uploaded == 0) {
        $response = [
            'status'=>"failed",
            'message'=> "No doc was uploaded",
            'total_uploaded'=> $total_uploaded
        ];
    }
    return $response;
}

// FUNCTION TO VALIDATE AND UPLOAD SINGLE VIDEO
function upload_video($file, string $folder) {
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $response = [];

    if ($file_error === 0) {
        // If no errors
        if ($file_size > 1073741824) {
            $response = [
                'status'=>"failed",
                'message'=> "File size is too large. Maximum allowable file size is 1GB"
            ];
        } else {
            // If file size is below size limit

            // Extracting file extension from file name
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            // Setting file extension to lowercase
            $file_extension = strtolower($file_extension);
            // Allowable extensions
            $accepted_extensions = array('mp4', 'mkv');

            if (in_array($file_extension, $accepted_extensions)) {
                // If file extension is among accepted extensions

                // Generating a new unique name and appending to the file extension
                $new_file_name = uniqid("VID-", true).'.'.$file_extension;
                // Defining the upload path
                $image_upload_path = MEDIA_PATH . '/' . $folder . '/' . $new_file_name;
                // Moving uploaded file to defined upload path
                move_uploaded_file($file_tmp_name, $image_upload_path);
                // Giving positive feedback or response
                $response = [
                    'status'=>"success",
                    'message'=> "Upload successful",
                    'new_file_name'=> $new_file_name
                ];
            } else {
                $response = [
                    'status'=>"failed",
                    'message'=> "Invalid file type"
                ];
            }
        }
    } else {
        $response = [
            'status'=>"failed",
            'message'=> "Unknown error occured"
        ];
    }
    return $response;
}

// FUNCTION TO VALIDATE AND UPLOAD MULTIPLE VIDEOS
function upload_multiple_videos($files, string $folder) {
    // Reorganising files
    $files = organise_files($files);
    // Number of files passed
    $total_files = count($files);
    // Default state
    $uploaded_files = [];
    $total_uploaded = 0;

    foreach($files as $file) {
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        

        if ($file_error === 0 && $file_size < 1073741824) {
            // If no errors and file size is below size limit (1GB)
    
            // Extracting file extension from file name
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            // Setting file extension to lowercase
            $file_extension = strtolower($file_extension);
            // Allowable extensions
            $accepted_extensions = array('mp4', 'mkv');

            if (in_array($file_extension, $accepted_extensions)) {
                // If file extension is among accepted extensions

                // Generating a new unique name and appending to the file extension
                $new_file_name = uniqid("VID-", true).'.'.$file_extension;
                // Defining the upload path
                $image_upload_path = MEDIA_PATH . '/' . $folder . '/' . $new_file_name;
                // Moving uploaded file to defined upload path
                move_uploaded_file($file_tmp_name, $image_upload_path);
                // Adding new file to uploaded file list
                array_push($uploaded_files, $new_file_name);
                // Increment files uploaded
                $total_uploaded++;
            }

        }
    };

    if ($total_uploaded == $total_files) {
        $response = [
            'status'=>"success",
            'message'=> "All videos uploaded successfully",
            'videos' => $uploaded_files,
            'total_uploaded'=> $total_uploaded
        ];
    } else if ($total_uploaded > 0 && $total_uploaded < $total_files) {
        $response = [
            'status'=>"partial",
            'message'=> $total_uploaded." out of ".$total_files." videos uploaded succesfully",
            'videos' => $uploaded_files,
            'total_uploaded'=> $total_uploaded
        ];
    } else if ($total_uploaded == 0) {
        $response = [
            'status'=>"failed",
            'message'=> "No video was uploaded",
            'total_uploaded'=> $total_uploaded
        ];
    }
    return $response;
}

// FUNCTION TO PAGINATE QUERY RESULT
function paginate(string $query, int $results_per_page) {
    // Defining Pagination parameters
    $has_previous = false;
    $has_next = false;
    $previous_page = 1;
    $next_page = 2;
    // Making a query to know how many result of items in table
    $query_items = query_fetch($query); //"SELECT * FROM $table"
    // Counting the items
    $number_of_results = count($query_items);
    // Determining the number of pages availabe from query results
    // and how many we wish to paginate (passed to the function)
    $number_of_pages = ceil($number_of_results/$results_per_page);
    // Determining current page the user is on
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }
    // Resetting other parameters based on the current page
    if ($page > 1) {
        $has_previous = true;
        $previous_page = $page - 1;
    }
    if ($page < $number_of_pages) {
        $has_next = true;
        $next_page = $page + 1;
    }
    // Determing the sql LIMIT starting number for the results on displaying page
    $this_page_first_result = ($page-1) * $results_per_page;
    // Retrieving selected result from database and displaying them
    $result = query_fetch($query . " LIMIT ". $this_page_first_result . "," . $results_per_page);
    // Returning all pagination results
    return [
        'start'=> 1,
        'page' => $page,
        'result' => $result,
        'has_previous' => $has_previous,
        'previous_page' => $previous_page,
        'has_next' => $has_next,
        'next_page' => $next_page,
        'num_of_pages' => $number_of_pages,
        'end' => $number_of_pages,
        'total' => $number_of_results
    ];
}

// FUNCTION TO SEND MAIL
function send_mail($from, $to, $subject, $message) {
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    if (mail($to, $subject, $message, $headers)) {
        return true;
    }
    return false;
}

// FUNCTION TO SEND MAIL USING PHP MAILER
function sendMail($to, $subject, $email_values = array()) {

    // Fetching current site settings for email params
    $company = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
    // Appending to our passed in array
    $email_values += [
        'site_name'=> ucfirst($company['name']),
        'site_domain'=> ucfirst($company['domain']),
        'site_email'=> $company['email'],
    ];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Set the email configuration
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable debugging if needed
        $mail->isSMTP();
        $mail->Host = EMAIL_HOST; // Update with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USERNAME; // Update with your email
        $mail->Password = EMAIL_PASSWORD; // Update with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use 'tls' or 'ssl' as needed
        $mail->Port = EMAIL_PORT; // Update with your SMTP server port; 587 for gmail

        // Set the sender and recipient
        $mail->setFrom($company['email'], ucfirst($company['name'])); // Update with your email and name
        $mail->addAddress($to);

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;

        // Read the HTML template file
        $message = file_get_contents(VIEW_PATH."email_template.html");

        // Replace dynamic values in the template
        foreach ($email_values as $key => $value) {
            $message = str_replace('{{' . $key . '}}', $value, $message);
        }

        $mail->Body = $message;

        // Send the email
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}



////////////////////// PROJECT SPECIFIC FUNCTIONS /////////////////////////////

// FUNCTION TO FETCH IMAGE
function fetch_image($image, $folder) {
    // Setting image path depending if a folder was passed
    $image_path = (is_null($folder)) ? $image : "$folder/$image";

    if ($image == null || !file_exists(APP_PATH . "media/$image_path")) {
        // If file does not exist or null
        return STATIC_ROOT . "/no_image.png";
    } else {
        return MEDIA_ROOT . "/$image_path";
    }
}

// FUNCTION TO FETCH IMAGE
function fetch_user_image($image, $folder) {
    // Setting image path depending if a folder was passed
    $image_path = (is_null($folder)) ? $image : "$folder/$image";

    if ($image == null || !file_exists(APP_PATH . "media/$image_path")) {
        // If file does not exist or null
        return STATIC_ROOT . "/default_user.png";
    } else {
        return MEDIA_ROOT . "/$image_path";
    }
}

// FUNCTION TO FETCH STUDENTS USING THEIR IDS
function fetch_student(int $id) {
    $matched_students = query_fetch("SELECT * FROM students WHERE id = $id LIMIT 1");

    if (!empty($matched_students)) {
        $student = $matched_students[0];
        // Appending extra student details
        $student += [
            'fullname'=>$matched_students[0]['firstname']." ".$matched_students[0]['lastname']
        ];
        return $student;
    }
    return "Invalid Student";
}

// FUNCTION TO FETCH STAFFS USING THEIR IDS
function fetch_staff(int $id) {
    $matched_staffs = query_fetch("SELECT * FROM staffs WHERE id = $id LIMIT 1");

    if (!empty($matched_staffs)) {
        $staff = $matched_staffs[0]; 
        // Appending extra staff details
        $staff += [
            'fullname'=>$matched_staffs[0]['firstname']." ".$matched_staffs[0]['lastname']
        ];
        return $staff;
    }
    return "Invalid Staff";
}

// FUNCTION TO FETCH FACULTIES USING THEIR IDS
function fetch_faculty(int $id) {
    $matched_faculties = query_fetch("SELECT * FROM faculties WHERE id = $id LIMIT 1");

    if (!empty($matched_faculties)) {
        return $matched_faculties[0]['name'];
    }
    return "Invalid Faculty";
}

// FUNCTION TO FETCH DEPARTMENTS USING THEIR IDS
function fetch_department(int $id) {
    $matched_departments = query_fetch("SELECT * FROM departments WHERE id = $id LIMIT 1");

    if (!empty($matched_departments)) {
        return $matched_departments[0]['name'];
    }
    return "Invalid Department";
}

// FUNCTION TO FETCH COURSES USING THEIR IDS
function fetch_course(int $id) {
    $matched_courses = query_fetch("SELECT * FROM courses WHERE id = $id LIMIT 1");

    if (!empty($matched_courses)) {
        return $matched_courses[0]['title'];
    }
    return "Invalid Course";
}

// FUNCTION TO EXTRACT YEAR FROM A DATE/DATETIME
function extract_year($dateString) {
    // Parse the date string into a Unix timestamp
    $timestamp = strtotime($dateString);

    // Extract the year from the timestamp
    $year = date('Y', $timestamp);

    return $year;
}

// FUNCTION TO GENERATE MATRIC NUMBER
function generate_matric_number(int $department_id) {
    // Checking if department exists
    $matched_departments = query_fetch("SELECT * FROM departments WHERE id = $department_id LIMIT 1");
    
    if (!empty($matched_departments)) {
        // Getting department short name
        $dept_short_name = strtoupper($matched_departments[0]['short_name']);
        // Extract the year from the current date
        $current_year = substr(date('Y'), 2, 2);
        // Making DB connection
        try {
            $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
        } catch (mysqli_sql_exception) {
            echo "Database Connection Error: " . mysqli_connect_error() . "<br><br>";
        }
        // Regenerating matric number until we get an ID not connected to a student 
        do {
            // Generate a unique number from 000 to 999
            $unique_number = '0' . sprintf("%05d", mt_rand(0, 99999));
            // Appending all values to form an ID
            $matric_number = strval("$dept_short_name/$unique_number/$current_year");
            $query = "select * from students where matric_number = '$matric_number' limit 1";
            $result = mysqli_query($conn, $query);
            // number of results gotten from query
            $results = mysqli_num_rows($result);
        } while ($results > 0);

        return $matric_number;
    }
    return false;
}

// FUNCTION TO GENERATE STAFF ID
function generate_staff_ID(int $department_id) {
    // Checking if department exists
    $matched_departments = query_fetch("SELECT * FROM departments WHERE id = $department_id LIMIT 1");

    if (!empty($matched_departments)) {
        // Getting department code
        $department_code = $matched_departments[0]['department_code'];
        // Current year
        $current_year = date('Y');
        // Making DB connection
        try {
            $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
        } catch (mysqli_sql_exception) {
            echo "Database Connection Error: " . mysqli_connect_error() . "<br><br>";
        }
        // Regenerating staff ID until we get an ID not connected to a staff 
        do {
            // Generate a unique number from 000 to 999
            $unique_number = sprintf("%03d", mt_rand(0, 999));
            // Appending all values to form an ID
            $staff_id = strval($current_year.$department_code.$unique_number);
            $query = "select * from staffs where staff_id = '$staff_id' limit 1";
            $result = mysqli_query($conn, $query);
            // number of results gotten from query
            $results = mysqli_num_rows($result);
        } while ($results > 0);

        return $staff_id;
    }
    return false;
}

// FUNCTION TO CHECK IF A NOTIFICATION IS NEW
function check_new(string $date) {
    // Getting current date and timestamp
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $today = $now->getTimestamp();
    // Getting timestamp from param date
    $date = strtotime($date);
    // Calculating days between now and param date
    $days_between = floor(($today - $date) / (60*60*24));
    // Checking if its not up to 2 days
    if ($days_between < 2) {
        // Return true 
        return true;
    }
    return false;
}

// FUNCTION TO DELETE OLD USER NOTIFICATIONS
function delete_old_notifications(int $user_id) {
    $notifications = query_fetch("SELECT * FROM notifications WHERE user_id = $user_id");
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $today = $now->getTimestamp();

    foreach($notifications as $notification) {
        $notification_date = strtotime($notification['date']);
        $days_after_creation = floor(($today - $notification_date) / (60*60*24));

        if ($days_after_creation > 3) {
            $sql = "DELETE FROM notifications WHERE id = :id";
            query_db($sql, ['id'=> $notification['id']]);
        }
    }
}

// FUNCTION TO TRUNCATE WORDS TO CERTAIN LIMIT
function truncate_string($text, $limit) {
    $words = explode(' ', $text);
    if (count($words) > $limit) {
        $truncatedWords = array_slice($words, 0, $limit);
        $truncatedText = implode(' ', $truncatedWords);
        return $truncatedText . '...';
    } else {
        return $text;
    }
}

// FUNCTION TO CREATE SLUG FROM A TEXT
function create_slug($text) {
    // Replace spaces with hyphens
    $slug = str_replace(' ', '-', $text);

    // Remove special characters
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    // Convert to lowercase
    $slug = strtolower($slug);

    return $slug;
}