<?php

class ClienteModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function save($data)
  {
    try {
      $query = $this->prepare("INSERT INTO clientes (documento, razon_social, telefono, direccion, idtipo_cliente) VALUES (:documento, :razon_social, :telefono, :direccion, :idtipo_cliente);");

      $query->bindParam(':documento', $data['documento'], PDO::PARAM_STR);
      $query->bindParam(':razon_social', $data['razon_social'], PDO::PARAM_STR);
      $query->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
      $query->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
      $query->bindParam(':idtipo_cliente', $data['idtipo_cliente'], PDO::PARAM_STR);

      $query->execute();
      return true;
    } catch (PDOException $e) {
      error_log("ClienteModel::save() -> " . $e->getMessage());
      return false;
    }
  }

  public function get($id, $colum = "id")
  {
    try {
      $query = $this->prepare("SELECT clientes.*, clientes_tipo.nombre AS tipo FROM clientes JOIN clientes_tipo ON clientes.idtipo_cliente = clientes_tipo.id WHERE clientes.$colum = ?;");
      $query->execute([$id]);
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("ClienteModel::get() -> " . $e->getMessage());
      return false;
    }
  }

  public function getAll()
  {
    try {
      $query = $this->query("SELECT clientes.*, clientes_tipo.nombre AS tipo FROM clientes JOIN clientes_tipo ON clientes.idtipo_cliente = clientes_tipo.id;");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("ClienteModel::getAll() -> " . $e->getMessage());
      return false;
    }
  }

  public function update($data)
  {
    try {
      $query = $this->prepare("UPDATE clientes SET documento = :documento, razon_social = :razon_social, telefono = :telefono, direccion = :direccion, idtipo_cliente = :idtipo_cliente WHERE id = :id;");

      $query->bindParam(':id', $data['id'], PDO::PARAM_INT);
      $query->bindParam(':documento', $data['documento'], PDO::PARAM_STR);
      $query->bindParam(':razon_social', $data['razon_social'], PDO::PARAM_STR);
      $query->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
      $query->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
      $query->bindParam(':idtipo_cliente', $data['idtipo_cliente'], PDO::PARAM_INT);

      $query->execute();
      return true;
    } catch (PDOException $e) {
      error_log("ClienteModel::update() -> " . $e->getMessage());
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $query = $this->prepare("DELETE FROM clientes WHERE id = ?;");
      if ($query->execute([$id])) return true;
    } catch (PDOException $e) {
      error_log("ClienteModel::delete() -> " . $e->getMessage());
      return false;
    }
  }
}
