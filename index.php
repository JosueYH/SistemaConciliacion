<?php
date_default_timezone_set('America/Lima');
error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set("error_log", 'debug.log');

require_once 'config/config.php';
require_once 'libs/database.php';

require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'libs/model.php';
require_once 'libs/app.php';

require_once 'libs/applogin.php';

require_once 'controllers/cliente.php';
require_once 'controllers/usuario.php';

session_start();
$app = new App();
