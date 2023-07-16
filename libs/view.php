<?php

class View
{
  public $d;

  public function __construct()
  {
  }

  public function render($nombre, $data = [])
  {
    $this->d = $data;
    require 'views/' . $nombre . '.php';
  }
}
