<?php

class Materia extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('materia/index');
  }

  public function index()
  {
    $data = [];
    $materias = $this->model->getAll();
    if (count($materias) > 0) {
      foreach ($materias as $materia) {
        $botones = "<button class='btn btn-warning edit' id='{$materia["id"]}'><i class='fas fa-pencil-alt'></i></button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$materia["id"]}'><i class='fas fa-times'></i></button>";

        $data[] = [
          $materia["id"],
          $materia["nombre"],
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

    $materia = $this->model->get($_POST['id']);
    if ($materia) {
      echo json_encode(["success" => "materia encontrado", "materia" => $materia]);
      return;
    } else {
      echo json_encode(["error" => "Error al buscar materia"]);
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
      echo json_encode(["success" => "materia registrado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al registrar materia"]);
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
      echo json_encode(["success" => "materia actualizado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al actualizar materia"]);
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
      echo json_encode(["success" => "materia eliminado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al eliminar materia"]);
      return;
    }
  }
}
