<?php

class Cargo extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('cargo/index');
  }

  public function index()
  {
    $data = [];
    $cargos = $this->model->getAll();
    if (count($cargos) > 0) {
      foreach ($cargos as $cargo) {
        $botones = "<button class='btn btn-warning edit' id='{$cargo["id"]}'><i class='fas fa-pencil-alt'></i></button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$cargo["id"]}'><i class='fas fa-times'></i></button>";

        $data[] = [
          $cargo["id"],
          $cargo["codigo"],
          $cargo["nombre"],
          $cargo["tipo"],
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

    $cargo = $this->model->get($_POST['id']);
    if ($cargo) {
      echo json_encode(["success" => "cargo encontrada", "cargo" => $cargo]);
      return;
    } else {
      echo json_encode(["error" => "Error al buscar cargo"]);
      return;
    }
  }

  public function create()
  {
    if (empty($_POST['codigo']) || empty($_POST['nombre']) || empty($_POST['tipo'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->save($_POST['codigo'], $_POST['nombre'], $_POST['tipo'])) {
      echo json_encode(["success" => "cargo registrado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al registrar cargo"]);
      return;
    }
  }

  public function edit()
  {
    if (empty($_POST['id']) || empty($_POST['codigo']) || empty($_POST['nombre']) || empty($_POST['tipo'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->update($_POST['codigo'], $_POST['nombre'], $_POST['tipo'], $_POST['id'])) {
      echo json_encode(["success" => "cargo actualizado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al actualizar cargo"]);
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
      echo json_encode(["success" => "cargo eliminado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al eliminar cargo"]);
      return;
    }
  }
}
