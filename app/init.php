<?php
/*
    This file function to to merge all necessary PHP files and run all required function
    All other files just have to include this file to have access to all functions and configurations
*/

// DEFINING ABSOLUTE PATH TO IMPORT ALL REQUIRED FILES
$abs_path = dirname(__FILE__);

// LOAD ALL REQUIRED FILES IN ORDER
require_once("$abs_path/config.php");
require_once("$abs_path/connect.php");
require_once("$abs_path/functions.php");


// REQUIRED FUNCTION INITIATION

// Create tables
create_tables();
// drop_table('users');