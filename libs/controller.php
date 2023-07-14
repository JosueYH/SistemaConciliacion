<?php

class Controller
{
  public $model;
  public $view;

  function __construct()
  {
    $this->view = new View();
  }

  function loadModel($name)
  {
    $url = "models/{$name}Model.php";

    if (file_exists($url)) {
      require $url;
      $model = "{$name}Model";
      $this->model = new $model();
    }
  }
}
