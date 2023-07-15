<?php

class ProvinciaModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id)
  {
    try {
      $query = $this->db->connect()->prepare("SELECT provincias.*, departamentos.nombre AS departamento FROM provincias JOIN departamentos ON provincias.iddepartamento = departamentos.id WHERE provincias.id = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("ProvinciaModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll()
  {
    try {
      $query = $this->db->connect()->query("SELECT provincias.*, departamentos.nombre AS departamento FROM provincias JOIN departamentos ON provincias.iddepartamento = departamentos.id;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("ProvinciaModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save($nombre, $iddepartamento)
  {
    try {
      $query = $this->db->connect()->prepare("INSERT INTO provincias (nombre, iddepartamento) VALUES (:nombre, :iddepartamento);");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':iddepartamento', $iddepartamento, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("ProvinciaModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update($nombre, $iddepartamento, $id)
  {
    try {
      $query = $this->db->connect()->prepare("UPDATE provincias SET nombre = :nombre, iddepartamento = :iddepartamento WHERE provincias.id = :id;");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':iddepartamento', $iddepartamento, PDO::PARAM_STR);
      $query->bindParam(':id', $id, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("ProvinciaModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $query = $this->db->connect()->prepare("DELETE FROM provincias WHERE provincias.id = ?;");
      if ($query->execute([$id])) return true;
    } catch (PDOException $e) {
      error_log("ProvinciaModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
