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
      $query = $this->prepare("SELECT m.*, t.nombre AS tipo FROM materias m JOIN materias_tipo t ON m.idtipo_materia = t.id WHERE m.id = ?;");
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
      $query = $this->query("SELECT m.*, t.nombre AS tipo FROM materias m JOIN materias_tipo t ON m.idtipo_materia = t.id;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("MateriaModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save($nombre, $tipo)
  {
    try {
      $query = $this->prepare("INSERT INTO materias (nombre, idtipo_materia) VALUES (:nombre, :idtipo_materia);");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':idtipo_materia', $tipo, PDO::PARAM_STR);

      $query->execute();
      return true;
    } catch (PDOException $e) {
      error_log("MateriaModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update($nombre, $tipo, $id)
  {
    try {
      $query = $this->prepare("UPDATE materias SET nombre = :nombre, idtipo_materia = :idtipo_materia WHERE id = :id;");
      $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
      $query->bindParam(':idtipo_materia', $tipo, PDO::PARAM_STR);
      $query->bindParam(':id', $id, PDO::PARAM_STR);

      $query->execute();
      return true;
    } catch (PDOException $e) {
      error_log("MateriaModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $query = $this->prepare("DELETE FROM materias WHERE id = ?;");
      $query->execute([$id]);
      return true;
    } catch (PDOException $e) {
      error_log("MateriaModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
