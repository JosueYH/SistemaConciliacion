<?php

class Model
{
  public $db;

  function __construct()
  {
    $this->db = new Database();
  }
}
