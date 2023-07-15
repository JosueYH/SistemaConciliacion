<?php

class Errores extends Controller
{
  public $view;

  function __construct()
  {
    parent::__construct();
    $this->view->render('errores/index');
  }
}
