<?php

class ClienteTiposModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id)
  {
    try {
      $query = $this->db->connect()->prepare("SELECT * FROM clientes_tipo WHERE id = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("ClienteTiposModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll()
  {
    try {
      $query = $this->db->connect()->query("SELECT * FROM clientes_tipo;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("ClienteTiposModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save($nombre)
  {
    try {
      $query = $this->db->connect()->prepare("INSERT INTO clientes_tipo (nombre) VALUES (:nombre);");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("ClienteTiposModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update($nombre, $id)
  {
    try {
      $query = $this->db->connect()->prepare("UPDATE clientes_tipo SET nombre = :nombre WHERE id = :id;");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':id', $id, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("ClienteTiposModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $query = $this->db->connect()->prepare("DELETE FROM clientes_tipo WHERE id = ?;");
      if ($query->execute([$id])) return true;
    } catch (PDOException $e) {
      error_log("ClienteTiposModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
