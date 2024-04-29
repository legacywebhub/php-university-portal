<?php

session_unset();
session_destroy();

$staff_login = ROOT."/staff/login";
header("Location: $staff_login");