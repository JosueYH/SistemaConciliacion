<?php

class LoginModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function login($email)
  {
    try {
      $query = $this->query("SELECT * FROM usuarios WHERE email = '$email';");
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("LoginModel -> " . $e->getMessage());
      return false;
    }
  }
}
