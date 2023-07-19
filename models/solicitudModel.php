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
      $query = $this->prepare("SELECT c.idtipo_cliente AS tipo, c.*, s.* FROM solicitudes s JOIN clientes c ON s.idcliente = c.id WHERE s.id = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("SolicitudModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll($id = null)
  {
    try {
      $sql = "";
      if ($id !== null) $sql = " WHERE s.idusuario = $id";
      $query = $this->query("SELECT s.*, u.nombres AS abogado, c.razon_social AS cliente FROM solicitudes s JOIN usuarios u ON s.idusuario = u.id JOIN clientes c ON s.idcliente = c.id$sql;");
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
      $nExp = $this->getMax();

      $query = $this->prepare("INSERT INTO solicitudes (n_expediente, url, idusuario, idcliente) VALUES (:n_expediente, :url, :idusuario, :idcliente);");

      $query->bindParam(':n_expediente', $nExp, PDO::PARAM_STR);
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
      $query = $this->prepare("UPDATE solicitudes SET n_expediente = :n_expediente, url = :url, idusuario = :idusuario, idcliente = :idcliente WHERE id = :id;");

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
      $query = $this->prepare("DELETE FROM solicitudes WHERE id = ?;");
      $query->execute([$id]);
      return true;
    } catch (PDOException $e) {
      error_log("SolicitudModel::delete() -> " . $e->getMessage());
      return false;
    }
  }

  public function getMax()
  {
    try {
      $max = $this->query("SELECT MAX(n_expediente) AS max FROM solicitudes;");
      $max->execute();
      $nExp = $max->fetch(PDO::FETCH_ASSOC)['max'];
      return ($nExp == null) ? 1 : $nExp++;
    } catch (PDOException $e) {
      error_log("SolicitudModel::getMax() -> " . $e->getMessage());
      return false;
    }
  }

  public function updateColum($colum, $value, $id)
  {
    try {
      $query = $this->query("UPDATE solicitudes SET $colum = '$value' WHERE id = $id;");
      $query->execute();
      return true;
    } catch (PDOException $e) {
      error_log("SolicitudModel::updateUrl() -> " . $e->getMessage());
      return false;
    }
  }
}
