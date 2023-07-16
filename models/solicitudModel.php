<?php

class SolicitudModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id)
  {
    try {
      $query = $this->db->connect()->prepare("SELECT * FROM solicitudes WHERE id = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("SolicitudModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll()
  {
    try {
      $query = $this->db->connect()->query("SELECT * FROM solicitudes;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("SolicitudModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function save($data)
  {
    try {
      $query = $this->db->connect()->prepare("INSERT INTO solicitudes (n_expediente, url, idusuario, idcliente) VALUES (:n_expediente, :url, :idusuario, :idcliente);");

      $query->bindParam(':n_expediente', $data['n_expediente'], PDO::PARAM_STR);
      $query->bindParam(':url', $data['url'], PDO::PARAM_STR);
      $query->bindParam(':idusuario', $data['idusuario'], PDO::PARAM_STR);
      $query->bindParam(':idcliente', $data['idcliente'], PDO::PARAM_STR);

      $query->execute();
      return true;
    } catch (PDOException $e) {
      error_log("SolicitudModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function update($data)
  {
    try {
      $query = $this->db->connect()->prepare("UPDATE solicitudes SET n_expediente = :n_expediente, url = :url, idusuario = :idusuario, idcliente = :idcliente WHERE id = :id;");

      $query->bindParam(':n_expediente', $data['n_expediente'], PDO::PARAM_STR);
      $query->bindParam(':url', $data['url'], PDO::PARAM_STR);
      $query->bindParam(':idusuario', $data['idusuario'], PDO::PARAM_STR);
      $query->bindParam(':idcliente', $data['idcliente'], PDO::PARAM_STR);
      $query->bindParam(':id', $data['id'], PDO::PARAM_STR);

      $query->execute();
      return true;
    } catch (PDOException $e) {
      error_log("SolicitudModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $query = $this->db->connect()->prepare("DELETE FROM solicitudes WHERE id = ?;");
      $query->execute([$id]);
      return true;
    } catch (PDOException $e) {
      error_log("SolicitudModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
