<?php

require_once 'controllers/cliente.php';
require_once 'models/usuarioModel.php';
require_once 'models/clienteModel.php';

class Solicitud extends Controller
{
  public $model;
  public $view;
  public $cliente;
  public $clienteModel;
  public $usuarioModel;

  public function __construct()
  {
    parent::__construct();
    $this->cliente = new Cliente();
    $this->clienteModel = new ClienteModel();
    $this->usuarioModel = new UsuarioModel();
  }

  public function render()
  {
    $this->view->render('solicitud/index', [
      "clientes" => $this->clienteModel->getAll(),
      "clientesTipos" => $this->cliente->getTipos(),
      "abogados" => $this->usuarioModel->getAll("ut.nombre", "Abogado"),
    ]);
  }

  public function index()
  {
    $data = [];
    $solicitudes = $this->model->getAll();
    if (count($solicitudes) > 0) {
      foreach ($solicitudes as $solicitud) {
        $botones = "<button class='btn btn-warning edit' id='{$solicitud["id"]}'><i class='fas fa-pencil-alt'></i></button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$solicitud["id"]}'><i class='fas fa-times'></i></button>";

        $class = "";
        $txt = "";
        if ($solicitud["estado"] === "0") {
          $class = "danger";
          $txt = "En espera";
        } else if ($solicitud["estado"] === "1") {
          $class = "warning";
          $txt = "En proceso";
        } else {
          $class = "success";
          $txt = "Procesado";
        }
        $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer delete' id='{$solicitud["id"]}' style='font-size:12px'>$txt</span>";

        $data[] = [
          $solicitud["id"],
          $solicitud["n_expediente"],
          $solicitud["cliente"],
          $solicitud["url"],
          $solicitud["abogado"],
          $solicitud["fecha"],
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

    $solicitud = $this->model->get($_POST['id']);
    if ($solicitud) {
      unset($solicitud["password"]);
      echo json_encode(["success" => "solicitud encontrado", "solicitud" => $solicitud]);
      return;
    } else {
      echo json_encode(["error" => "Error al buscar solicitud"]);
      return;
    }
  }

  public function create()
  {
    if (empty($_POST['documento']) || empty($_POST['razon_social']) || empty($_POST['telefono']) || empty($_POST['tipo']) || empty($_POST['abogado'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    $cliente = $this->clienteModel->get($_POST['documento'], 'documento');
    if (empty($cliente)) {
      $this->clienteModel->save([
        'documento' => $_POST['documento'],
        'razon_social' => $_POST['razon_social'],
        'telefono' => $_POST['telefono'],
        'direccion' => $_POST['direccion'],
        'idtipo_cliente' => $_POST['tipo'],
      ]);
      $cliente = $this->clienteModel->get($_POST['documento'], 'documento');
    }

    if ($this->model->save([
      'idusuario' => $_POST['abogado'],
      'idcliente' => $cliente['id'],
    ])) {
      echo json_encode(["success" => "solicitud registrado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al registrar solicitud"]);
      return;
    }
  }

  public function edit()
  {
    if (empty($_POST['id']) || empty($_POST['n_expediente']) || empty($_POST['url']) || empty($_POST['usuario'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->update([
      'n_expediente' => $_POST['n_expediente'],
      'url' => $_POST['url'],
      'idusuario' => $_POST['usuario'],
      'id' => $_POST['id'],
    ])) {
      echo json_encode(["success" => "solicitud actualizado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al actualizar solicitud"]);
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
      echo json_encode(["success" => "solicitud eliminado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al eliminar solicitud"]);
      return;
    }
  }
}
