<?php

class AppLogin
{
  function __construct()
  {
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    require_once 'controllers/login.php';
    $login = new Login();
    $login->loadModel($url[0]);
    $login->render();
    return false;
  }
}
