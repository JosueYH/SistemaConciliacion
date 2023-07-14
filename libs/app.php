<?php

require_once 'controllers/errores.php';

class App
{
  function __construct()
  {
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    $url = rtrim($url, '/');
    $url = explode('/', $url);

    if (empty($url[0])) {
      require_once 'controllers/main.php';
      $main = new Main();
      $main->loadModel($url[0]);
      $main->render();
      return false;
    }

    // si la url no es null
    $fileController = 'controllers/' . $url[0] . '.php';
    //condicional, si es que exites un archivo en esta rita
    if (file_exists($fileController)) {
      if ($fileController == constant('RUTA')) {
        //si son direntes al cosntante...tendra que retornar al index
        header('Location: /coop');
      }

      require_once $fileController;

      $controller = new $url[0];
      $controller->loadModel($url[0]);
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
      $controller = new Errores(); //objeto
    }
  }
}
