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
      $query = $this->prepare("INSERT INTO usuarios(nombres, direccion, password, idcargo, documento, telefono, email, idtipo_usuario) VALUES (:nombres, :direccion, :password, :idcargo, :documento, :telefono, :email, :idtipo_usuario);");

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

  public function get($id, $colum = "id")
  {
    try {
      $query = $this->prepare("SELECT * FROM usuarios WHERE $colum = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("UsuarioModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll($colum = null, $value = null)
  {
    try {
      $sql = "";
      if ($colum !== null) $sql = " WHERE $colum = '$value'";
      $query = $this->query("SELECT u.*, ut.nombre AS tipo FROM usuarios u JOIN usuarios_tipo ut ON u.idtipo_usuario = ut.id$sql;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("UsuarioModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function update($datos, $id)
  {
    try {
      $sql = "UPDATE usuarios SET ";
      foreach ($datos as $columna => $valor) {
        $sql .= "$columna = '$valor', ";
      }

      $sql = rtrim($sql, ', '); // elimina la última coma y el espacio
      $sql .= " WHERE id = $id;";
      $query = $this->query($sql);
      $query->execute();
      return true;
    } catch (PDOException $e) {
      error_log("UsuarioModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $query = $this->prepare("DELETE FROM usuarios WHERE id = ?;");
      $query->execute([$id]);
      return true;
    } catch (PDOException $e) {
      error_log("UsuarioModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
