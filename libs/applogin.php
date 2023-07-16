<?php

class AppLogin
{
  public function __construct()
  {
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    require_once 'controllers/login.php';

    if (empty($url[0])) {
      $login = new Login();
      $login->loadModel($url[0]);
      $login->render();
      return false;
    }

    $login = new Login();
    $login->loadModel($url[0]);

    $parameters = sizeof($url);
    if ($parameters > 1) {
      if ($parameters > 2) {
        $parametro = [];
        for ($i = 2; $i < $parameters; $i++) {
          array_push($parametro, $url[$i]);
        }
        $login->{$url[1]}($parametro); //ruta con parametro
      } else {
        $login->{$url[1]}(); //ruta
      }
    } else {
      $login->render(); //render
    }
  }
}
