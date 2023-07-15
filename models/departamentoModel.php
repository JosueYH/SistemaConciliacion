<?php

class DepartamentoModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id)
  {
    try {
      $query = $this->db->connect()->prepare("SELECT * FROM departamentos WHERE id = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("DepartamentoModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll()
  {
    try {
      $query = $this->db->connect()->query("SELECT * FROM departamentos;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("DepartamentoModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save($nombre)
  {
    try {
      $query = $this->db->connect()->prepare("INSERT INTO departamentos (nombre) VALUES (:nombre);");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("DepartamentoModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update($nombre, $id)
  {
    try {
      $query = $this->db->connect()->prepare("UPDATE departamentos SET nombre = :nombre WHERE id = :id;");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':id', $id, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("DepartamentoModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $query = $this->db->connect()->prepare("DELETE FROM departamentos WHERE id = ?;");
      if ($query->execute([$id])) return true;
    } catch (PDOException $e) {
      error_log("DepartamentoModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
