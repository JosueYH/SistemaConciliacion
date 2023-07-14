<?php

class LoginModel extends Modelo
{
  public function __construct()
  {
    parent::__construct();
  }

  public function login($datos)
  {
    $query = $this->db->connect()->prepare("SELECT * FROM usuarios WHERE email = :email AND password = :password;");
    try {
      $query->execute(['email' => $datos['email'], 'password' => $datos['password']]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("LoginModel -> " . $e->getMessage());
      return false;
    }
  }
}
