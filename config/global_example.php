<?php
// Project Name
define('PROJECT_NAME', 'Credentials Manager');
/*DATABASE CREDENTIALS BEGIN*/
// Server IP
define('DB_HOST', 'localhost');

// Database which is going to connected
define('DB_NAME', 'database');

// Database user
define('DB_USER', 'root');

// Password associate to the database user
define('DB_PASSWORD', '');

// Character encoding
define('DB_ENCODE', 'utf8');
/*DATABASE CREDENTIALS END*/
/*ENCRIPT KEY*/
define('ENCRYPT_KEY', '');
/*WEBSITE EMAIL CREDENTIALS*/
define('WEBSITE_EMAIL_HOST', 'smtp.site.com');
define('WEBSITE_EMAIL_PORT', 587);
define('WEBSITE_EMAIL_SMTPAuth', true);
define('WEBSITE_EMAIL', 'email@test.com');
/*ONLY IF SMTPAuth IS TRUE*/
define('WEBSITE_EMAIL_USERNAME', '');
define('WEBSITE_EMAIL_PASSWORD', '');
/*END WEBSITE EMAIL CREDENTIALS*/
