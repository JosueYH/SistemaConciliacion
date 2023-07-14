<?php

class Main extends Controller
{
  public $model;
  public $view;

  function __construct()
  {
    parent::__construct();
  }

  function render()
  {
    $this->view->render('main/index');
  }
}
