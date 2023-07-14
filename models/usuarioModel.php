<?php

class UsuarioModel extends Model
{

  public function __construct()
  {

    parent::__construct();
  }

  public function save($data)
  {
    try {
      $query = $this->db->connect()->prepare("INSERT INTO usuarios(nombres, direccion, password, idcargo, documento, telefono, email, idtipo_usuario) VALUES (:nombres, :direccion, :password, :idcargo, :documento, :telefono, :email, :idtipo_usuario);");

      $query->bindParam(':nombres', $data['nombres'], PDO::PARAM_STR);
      $query->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
      $query->bindParam(':password', $data['password'], PDO::PARAM_STR);
      $query->bindParam(':idcargo', $data['idcargo'], PDO::PARAM_STR);
      $query->bindParam(':documento', $data['documento'], PDO::PARAM_STR);
      $query->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
      $query->bindParam(':email', $data['email'], PDO::PARAM_STR);
      $query->bindParam(':idtipo_usuario', $data['idtipo_usuario'], PDO::PARAM_STR);

      $query->execute();
      return true;
    } catch (PDOException $e) {
      error_log("UsuarioModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function get($data)
  {
    try {
      $query = $this->db->connect()->prepare("SELECT * FROM usuario WHERE usuario=:usuario;");
      $query->execute(['usuario' => $data['usuario']]);
    } catch (PDOException $e) {
      error_log("UsuarioModel::search() -> " . $e->getMessage());
      return false;
    }
  }
}
