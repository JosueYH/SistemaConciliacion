<?php

class Errores extends Controller
{
  public $view;

  function __construct()
  {
    parent::__construct();

    $url = constant('URL') . 'main';
    $this->view->mensaje = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Error </strong> No se Ha encontrado la Paina que Busca
      <a href='$url'> Ir</a>
    </div>";

    $this->view->render('errores/index');
  }
}
