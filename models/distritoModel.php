<?php

class DistritoModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id)
  {
    try {
      $query = $this->db->connect()->prepare("SELECT distritos.*, provincias.nombre AS provincia FROM distritos JOIN provincias ON distritos.idprovincia = provincias.id WHERE distritos.id = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("DistritoModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll()
  {
    try {
      $query = $this->db->connect()->query("SELECT distritos.*, provincias.nombre AS provincia FROM distritos JOIN provincias ON distritos.idprovincia = provincias.id;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("DistritoModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save($nombre, $idprovincia)
  {
    try {
      $query = $this->db->connect()->prepare("INSERT INTO distritos (nombre, idprovincia) VALUES (:nombre, :idprovincia);");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':idprovincia', $idprovincia, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("DistritoModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update($nombre, $idprovincia, $id)
  {
    try {
      $query = $this->db->connect()->prepare("UPDATE distritos SET nombre = :nombre, idprovincia = :idprovincia WHERE distritos.id = :id;");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':idprovincia', $idprovincia, PDO::PARAM_STR);
      $query->bindParam(':id', $id, PDO::PARAM_STR);
      if ($query->execute()) return true;
    } catch (PDOException $e) {
      error_log("DistritoModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $query = $this->db->connect()->prepare("DELETE FROM distritos WHERE distritos.id = ?;");
      if ($query->execute([$id])) return true;
    } catch (PDOException $e) {
      error_log("DistritoModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
