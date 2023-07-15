<?php

class Cliente extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('cliente/index', [
      "tipos" => $this->getTipos(),
    ]);
  }

  public function index()
  {
    $data = [];
    $users = $this->model->getAll();
    if (count($users) > 0) {
      foreach ($users as $user) {
        $botones = "<button class='btn btn-warning edit' id='{$user["id"]}'><i class='fas fa-pencil-alt'></i></button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$user["id"]}'><i class='fas fa-times'></i></button>";

        $class = ($user["estado"] === "0") ? "danger" : "success";
        $txt = ($user["estado"] === "0") ? "Inactivo" : "Activo";

        $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer delete' id='{$user["id"]}' style='font-size:12px'>$txt</span>";

        $data[] = [
          $user["id"],
          $user["documento"],
          $user["razon_social"],
          $user["telefono"],
          $user["tipo"],
          $estado,
          $botones,
        ];
      }
    }

    echo json_encode(["data" => $data]);
  }

  public function get()
  {
    if (empty($_POST['id'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    $cliente = $this->model->get($_POST['id']);
    if ($cliente) {
      unset($cliente["password"]);
      echo json_encode(["success" => "cliente encontrado", "cliente" => $cliente]);
      return;
    } else {
      echo json_encode(["error" => "Error al buscar cliente"]);
      return;
    }
  }

  public function create()
  {
    if (empty($_POST['documento']) || empty($_POST['razon_social']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['tipo'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->save([
      'documento' => $_POST['documento'],
      'razon_social' => $_POST['razon_social'],
      'telefono' => $_POST['telefono'],
      'direccion' => $_POST['direccion'],
      'idtipo_cliente' => $_POST['tipo'],
    ])) {
      echo json_encode(["success" => "cliente registrado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al registrar cliente"]);
      return;
    }
  }

  public function edit()
  {
    if (empty($_POST['id']) || empty($_POST['documento']) || empty($_POST['razon_social']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['tipo'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->update([
      'id' => $_POST['id'],
      'documento' => $_POST['documento'],
      'razon_social' => $_POST['razon_social'],
      'telefono' => $_POST['telefono'],
      'direccion' => $_POST['direccion'],
      'idtipo_cliente' => $_POST['tipo'],
    ])) {
      echo json_encode(["success" => "cliente actualizado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al actualizar cliente"]);
      return;
    }
  }

  public function delete()
  {
    if (empty($_POST['id'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->delete($_POST['id'])) {
      echo json_encode(["success" => "cliente eliminado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al eliminar cliente"]);
      return;
    }
  }

  public function getTipos()
  {
    require_once 'models/clienteTiposModel.php';
    $tipos = new ClienteTiposModel();
    return $tipos->getAll();
  }
}
