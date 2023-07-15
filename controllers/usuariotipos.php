<?php

class UsuarioTipos extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('usuariotipos/index');
  }

  public function index()
  {
    $data = [];
    $tiposs = $this->model->getAll();
    if (count($tiposs) > 0) {
      foreach ($tiposs as $tipos) {
        $botones = "<button class='btn btn-warning edit' id='{$tipos["id"]}'><i class='fas fa-pencil-alt'></i></button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$tipos["id"]}'><i class='fas fa-times'></i></button>";

        $data[] = [
          $tipos["id"],
          $tipos["nombre"],
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

    $tipos = $this->model->get($_POST['id']);
    if ($tipos) {
      echo json_encode(["success" => "Tipos encontrado", "tipos" => $tipos]);
      return;
    } else {
      echo json_encode(["error" => "Error al buscar tipos"]);
      return;
    }
  }

  public function create()
  {
    if (empty($_POST['nombre'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->save($_POST['nombre'])) {
      echo json_encode(["success" => "tipos registrado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al registrar tipos"]);
      return;
    }
  }

  public function edit()
  {
    if (empty($_POST['id']) || empty($_POST['nombre'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->update($_POST['nombre'], $_POST['id'])) {
      echo json_encode(["success" => "tipos actualizado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al actualizar tipos"]);
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
      echo json_encode(["success" => "tipos eliminado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al eliminar tipos"]);
      return;
    }
  }
}
