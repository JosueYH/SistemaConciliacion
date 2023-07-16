<?php

class Solicitud extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('solicitud/index');
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
          $solicitud["idusuario"],
          $solicitud["url"],
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
    if (empty($_POST['n_expediente']) || empty($_POST['url']) || empty($_POST['usuario'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->save([
      'n_expediente' => $_POST['n_expediente'],
      'url' => $_POST['url'],
      'idusuario' => $_POST['usuario'],
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
