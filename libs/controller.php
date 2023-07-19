<?php

class Controller
{
  public $model;
  public $view;
  public $sites;

  public function __construct()
  {
    $this->view = new View();
    $this->sites = $this->sites();
  }

  public function loadModel($name)
  {
    $url = "models/{$name}Model.php";

    if (file_exists($url)) {
      require $url;
      $model = "{$name}Model";
      $this->model = new $model();
    }
  }

  public function sites()
  {
    return [
      "0" => [
        'login'
      ],
      "1" => [
        'cargo', 'cliente', 'clientetipos', 'departamento', 'distrito', 'login', 'main', 'materia', 'materiatipos', 'provincia', 'solicitud', 'usuario', 'usuariotipos'
      ],
      "2" => [
        'cargo', 'cliente', 'clientetipos', 'departamento', 'distrito', 'login', 'main', 'materia', 'materiatipos', 'provincia', 'solicitud'
      ],
      "3" => [
        'login', 'main', 'solicitud'
      ],
    ];
  }

  public function hasAccess($view, $tipo)
  {
    return in_array($view, $this->sites[$tipo]);
  }
}
