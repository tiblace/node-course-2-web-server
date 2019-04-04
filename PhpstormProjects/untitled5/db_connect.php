<?php

// Define database constants
define ('DB_HOSTNAME', 'localhost');            // The computer the database is on
define('DB_USERNAME', 'student');
define('DB_PASSWORD', 'student');
define('DB_NAME', 'authentication');              // The name of the database

// Create a new database connection using the mysqli driver (see p271)
$connection = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
