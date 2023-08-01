<?php

require_once 'controllers/errores.php';

class App
{
  public function __construct()
  {
    $url = $_GET['url'] ?? '';
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    if (empty($url[0]) && !isset($_SESSION['session'])) {
      require_once 'controllers/login.php';
      $login = new Login();
      $login->loadModel($url[0]);
      $login->render();
      return false;
    }
    if (empty($url[0])) $url[0] = 'main';

    // si la url no es null
    $fileController = 'controllers/' . $url[0] . '.php';
    //condicional, si es que exites un archivo en esta rita
    if (file_exists($fileController)) {
      require_once $fileController;

      $controller = new $url[0];
      $controller->loadModel($url[0]);

      $tipo = $_SESSION['tipo'] ?? 0;

      if ($controller->hasAccess($url[0], $tipo)) {

        //numero de parametros, o eliemntos del link
        $parameters = sizeof($url);

        if ($parameters > 1) {
          if ($parameters > 2) {
            //array vacio
            $parametro = [];
            //hacer un bule para hacer llenar el array
            for ($i = 2; $i < $parameters; $i++) {
              //rellenar el array parametro
              array_push($parametro, $url[$i]);
            }
            //se estipula el url con su array d eparametros
            $controller->{$url[1]}($parametro); //ruta con parametro
          } else {
            //normal
            $controller->{$url[1]}(); //ruta
          }
        } else {
          $controller->render(); //render
        }
      } else {
        $controller = new Errores();
      }
    } else {
      $controller = new Errores();
    }
  }
}
