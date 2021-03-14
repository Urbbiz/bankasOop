<?php
session_start();
define('URL', 'http://localhost/php_projects/bankasOop/');
define('INSTALL_DIR','/php_projects/bankasOop/');
define('DIR', __DIR__.'/');
// require DIR.'app/functions.php';
require DIR.'app/BankController.php';
require DIR.'app/Json.php';
require DIR.'app/User.php';

_d($_SESSION, 'SESIJA--->');
?>