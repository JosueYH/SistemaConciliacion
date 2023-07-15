<?php

class Departamento extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('departamento/index');
  }

  public function index()
  {
    $data = [];
    $departamentos = $this->model->getAll();
    if (count($departamentos) > 0) {
      foreach ($departamentos as $departamento) {
        $botones = "<button class='btn btn-warning edit' id='{$departamento["id"]}'><i class='fas fa-pencil-alt'></i></button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$departamento["id"]}'><i class='fas fa-times'></i></button>";

        $data[] = [
          $departamento["id"],
          $departamento["nombre"],
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

    $departamento = $this->model->get($_POST['id']);
    if ($departamento) {
      echo json_encode(["success" => "Departamento encontrado", "departamento" => $departamento]);
      return;
    } else {
      echo json_encode(["error" => "Error al buscar departamento"]);
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
      echo json_encode(["success" => "departamento registrado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al registrar departamento"]);
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
      echo json_encode(["success" => "Departamento actualizado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al actualizar departamento"]);
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
      echo json_encode(["success" => "departamento eliminado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al eliminar departamento"]);
      return;
    }
  }
}
