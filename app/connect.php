<?php


// This file handles function closely related to the database i.e acts
// like a migration file but does extra such as query functions
// Note that our DB parameters/variables are coming from the config file

/*
//////////////////// NON PDO ////////////////////

// NON PDO CONNECTION
try {
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
} catch (mysqli_sql_exception) {
    echo "Database Connection Error: " . mysqli_connect_error() . "<br>";
};

// GENERAL QUERY FUNCTION
function query(string $sql_query){
    global $conn;
    try {
        $result = mysqli_query($conn, $sql_query);
    } catch (Exception $e) {
        echo "Oops.. Could not fetch data!";
    };

    if (!empty($result)) {
        return $result;
    }
    return false;
}

// FUNCTION TO QUERY ALL ITEMS FROM A TABLE
function query_select_all(string $table){
    global $conn;
    try {
        $sql_query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $sql_query);
    } catch (Exception $e) {
        echo "Oops.. Could not fetch data!";
    };

    if (!empty($result)) {
        return $result;
    }
    return false;
}
*/



//////////////////// PDO ////////////////////

// FUNCTION TO CREATE DB AND TABLES
function create_tables() {
    /*
    Note that this is the only PDO function that does not require DB name
    as we may likely create our own database from here before populating tables.

    Note that the DB engine used here is mysql so replace "mysql" with 
    current engine if required
    */

    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";";
    $con = new PDO($string, DBUSER, DBPASS);

    // Creating a database
    $query = "create database if not exists ". DBNAME;
    $statement = $con->prepare($query);
    $statement->execute();

    // Telling SQL to use our created database
    $query = "use ". DBNAME;
    $statement = $con->prepare($query);
    $statement->execute();

    // University info table
    $query = "create table if not exists settings(

        id int primary key auto_increment,
        name varchar(60) not null,
        shortname varchar(20) not null,
        email varchar(60) null,
        phone varchar(60) null,
        address varchar(100) null,
        motto varchar(100) null
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // Conference room table
    $query = "create table if not exists rooms(

        id int primary key auto_increment,
        name varchar(20) not null,
        expires datetime null,

        key name (name),
        unique (name)
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // Students table
    $query = "create table if not exists students(

        id int primary key auto_increment,
        matric_number varchar(20) not null,
        department_id int not null,
        level int default 100,
        passport varchar(255) null,
        firstname varchar(30) not null,
        middlename varchar(30) null,
        lastname varchar(30) not null,
        gender varchar(10) not null,
        dob date null,
        email varchar(60) not null,
        phone varchar(60) null,
        address varchar(200) null,
        parent_name varchar(100) null,
        parent_email varchar(60) null,
        parent_phone varchar(60) null,
        password varchar(255) not null,
        reg_date date default current_timestamp,
        is_blocked tinyint default 0,
        reset_token_hash varchar(255) null, 
        reset_token_expires datetime null,

        key email (email),
        key matric_number (matric_number),
        unique (matric_number),
        unique (email),
        unique (reset_token_hash)
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // role - lecturer, professor, doctor, 
    // dean, non-teaching staff etc
    // title - Mr, Mrs, Dr, Prof, Engr etc
    // superusers are superstaffs or management staffs
    $query = "create table if not exists staffs(

        id int primary key auto_increment,
        staff_id varchar(20) not null,
        department_id int not null,
        passport varchar(255) null,
        role varchar(60) not null,
        title varchar(10) null,
        firstname varchar(30) not null,
        middlename varchar(30) null,
        lastname varchar(30) not null,
        gender varchar(10) not null,
        dob date null,
        email varchar(60) not null,
        phone varchar(60) null,
        password varchar(255) not null,
        is_blocked tinyint default 0,
        is_superuser tinyint default 0,
        reg_date date default current_timestamp,
        reset_token_hash varchar(255) null, 
        reset_token_expires datetime null,

        key email (email),
        key staff_id (staff_id),
        unique (staff_id),
        unique (email),
        unique (reset_token_hash)
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists faculties(

        id int primary key auto_increment,
        name varchar(60) null,
        reg_date date default current_timestamp,

        key name (name),
        unique (name)
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // code - 374, 256
    // short_name - CSC, IPE, MCE
    $query = "create table if not exists departments(

        id int primary key auto_increment,
        faculty_id int not null,
        department_code int not null,
        name varchar(60) not null,
        short_name varchar(60) not null,
        start_level int not null,
        end_level int not null,
        head_of_department varchar(150) null,
        reg_date date default current_timestamp,

        key name (name),
        key short_name (short_name),
        key code (department_code),
        unique (department_code),
        unique (short_name),
        unique (name)
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // name -> 100, 300
    $query = "create table if not exists levels(

        id int primary key auto_increment,
        department_id int not null,
        name int not null
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // semester -> 1, name -> First semester
    $query = "create table if not exists semesters(

        id int primary key auto_increment,
        semester int not null,
        name varchar(60) not null,

        key semester (semester),
        unique (semester),
        unique (name)
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // course_code == BIO 141, CSC 201
    $query = "create table if not exists courses(

        id int primary key auto_increment,
        department_id int not null,
        level int not null,
        semester int not null,
        lecturers varchar(160) null,
        course_image varchar(255) null,
        course_code varchar(10) not null,
        title varchar(60) not null,
        description text(2050) null,
        price int default 0,
        

        key title (title),
        key course_code (course_code),
        unique (course_code),
        unique (title)
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists lessons(

        id int primary key auto_increment,
        course_id int not null,
        title varchar(160) not null,
        content text(50000) null
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists videos(

        id int primary key auto_increment,
        lesson_id int not null,
        video varchar(1050) not null
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists documents(

        id int primary key auto_increment,
        lesson_id int not null,
        document varchar(1050) not null
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists tests(

        id int primary key auto_increment,
        student_id int not null,
        lesson_id int not null,
        title varchar(100) null,
        fullmark int default 100,
        score int default 0,

        unique (student_id)
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists questions(

        id int primary key auto_increment,
        test_id int not null,
        text varchar(250) not null
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // Option A - Yes, Option B - All of the above
    $query = "create table if not exists options(

        id int primary key auto_increment,
        question_id int not null,
        option varchar(1) not null,
        text varchar(100) not null
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // Correct option - A
    $query = "create table if not exists answers(

        id int primary key auto_increment,
        question_id int not null,
        correct_option varchar(1) not null 
    )";
    $statement = $con->prepare($query);
    $statement->execute();

    $query = "create table if not exists messages(

        id int primary key auto_increment,
        sender_id int not null,
        receiver_id int not null,
        subject varchar(60) null,
        message text(2050) not null,
        date datetime default current_timestamp

    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // purpose - School Fee, Gs Fee, Exam, Departmental Dues
    // method - online, cash, transfer, card
    $query = "create table if not exists fees(

        id int primary key auto_increment,
        invoice_id varchar(30) not null,
        student_id int not null,
        department_id int not null,
        level int not null,
        amount int not null,
        purpose varchar(60) not null,
        details text(2050) null,
        payment_method varchar(60) not null,
        date datetime default current_timestamp

    )";
    $statement = $con->prepare($query);
    $statement->execute();

    // type - Public Holiday, National Holiday, Office Holiday
    $query = "create table if not exists holidays(

        id int primary key auto_increment,
        type varchar(60) not null,
        payment varchar(60) not null,
        details text(2050) null,
        
        date datetime default current_timestamp

    )";
    $statement = $con->prepare($query);
    $statement->execute();
}

// FUNCTION TO DROP TABLES
function drop_table(string $table) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $query = "drop table if exists $table";
    $statement = $con->prepare($query);
    $statement->execute();
}

// GENERAL QUERY FUNCTION FOR PDO
// CAN INSERT, FETCH AND DELETE FROM DB
function query_db(string $query, array $data = []) {
    /*
    Remember that the passed in query string must have postponed parameters
    or values which is to be provided later using $data array passed into the
    function as well i.e

    $query = "insert into users (username, password) values (:username, :password)";

    or

    $query = "update users set username = :username, email = :email where id = 1 limit 1";

    :username and :password indicates to be provided later or during query execution

    $data == [] by default which won't cause errors when not inserting values which means
    we can also use this function to fetch and delete from DB
    */


    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $statement = $con->prepare($query);
    $statement->execute($data);

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($result) && !empty($result)) {
        return $result;
    }
    return [];
}

// QUERY FUNCTION TO ONLY FETCH WITH PDO
function query_fetch(string $query) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    $result = $con->query($query);
    $result = $result->fetchAll(PDO::FETCH_ASSOC);

    if (is_array($result) && !empty($result)) {
        return $result;
    }
    return [];
}

// QUERY FUNCTION TO INSERT AND RETURN ID OF INSERTED ITEM
function query_return_id(string $query, array $data = []) {
    // Making a connection using PDO
    $string = "mysql:hostname=".DBHOST.";"."dbname=".DBNAME.";";
    $con = new PDO($string, DBUSER, DBPASS);

    try {
        // Prepare and execute the insert query
        $statement = $con->prepare($query);
        $statement->execute($data);
        // Retrieve the ID of the inserted row
        $last_insert_id = $con->lastInsertId();
        return $last_insert_id;
    } catch(Exception) {
        return null;
    }
}