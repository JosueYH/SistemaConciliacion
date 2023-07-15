<?php

class CargoModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id)
  {
    try {
      $query = $this->db->connect()->prepare("SELECT * FROM cargos WHERE cargos.id = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("CargoModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll()
  {
    try {
      $query = $this->db->connect()->query("SELECT * FROM cargos;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("CargoModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save($codigo, $nombre, $tipo)
  {
    try {
      $query = $this->db->connect()->prepare("INSERT INTO cargos (codigo, nombre, tipo) VALUES (:codigo, :nombre, :tipo);");
      $query->bindParam(':codigo', $codigo, PDO::PARAM_STR);
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':tipo', $tipo, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("CargoModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update($codigo, $nombre, $tipo, $id)
  {
    try {
      $query = $this->db->connect()->prepare("UPDATE cargos SET codigo = :codigo, nombre = :nombre, tipo = :tipo WHERE cargos.id = :id;");
      $query->bindParam(':codigo', $codigo, PDO::PARAM_STR);
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':tipo', $tipo, PDO::PARAM_STR);
      $query->bindParam(':id', $id, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("CargoModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $query = $this->db->connect()->prepare("DELETE FROM cargos WHERE cargos.id = ?;");
      if ($query->execute([$id])) return true;
    } catch (PDOException $e) {
      error_log("CargoModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
