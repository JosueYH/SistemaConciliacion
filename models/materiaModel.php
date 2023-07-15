<?php

class MateriaModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get($id)
  {
    try {
      $query = $this->db->connect()->prepare("SELECT * FROM materias WHERE id = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("MateriaModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll()
  {
    try {
      $query = $this->db->connect()->query("SELECT * FROM materias;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("MateriaModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save($nombre)
  {
    try {
      $query = $this->db->connect()->prepare("INSERT INTO materias (nombre) VALUES (:nombre);");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("MateriaModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update($nombre, $id)
  {
    try {
      $query = $this->db->connect()->prepare("UPDATE materias SET nombre = :nombre WHERE id = :id;");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':id', $id, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("MateriaModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $query = $this->db->connect()->prepare("DELETE FROM materias WHERE id = ?;");
      if ($query->execute([$id])) return true;
    } catch (PDOException $e) {
      error_log("MateriaModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
