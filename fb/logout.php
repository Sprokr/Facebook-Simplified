<?php
require_once 'project_http_functions.inc.php';
session_start();
session_unset();
session_destroy();

redirect('index.php');
?>