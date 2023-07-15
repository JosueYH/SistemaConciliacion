<?php

class Provincia extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('provincia/index', [
      "departamentos" => $this->getDepartamentos()
    ]);
  }

  public function index()
  {
    $data = [];
    $provincias = $this->model->getAll();
    if (count($provincias) > 0) {
      foreach ($provincias as $provincia) {
        $botones = "<button class='btn btn-warning edit' id='{$provincia["id"]}'><i class='fas fa-pencil-alt'></i></button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$provincia["id"]}'><i class='fas fa-times'></i></button>";

        $data[] = [
          $provincia["id"],
          $provincia["nombre"],
          $provincia["departamento"],
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

    $provincia = $this->model->get($_POST['id']);
    if ($provincia) {
      echo json_encode(["success" => "Provincia encontrada", "provincia" => $provincia]);
      return;
    } else {
      echo json_encode(["error" => "Error al buscar provincia"]);
      return;
    }
  }

  public function create()
  {
    if (empty($_POST['nombre']) || empty($_POST['departamento'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->save($_POST['nombre'], $_POST['departamento'])) {
      echo json_encode(["success" => "Provincia registrado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al registrar provincia"]);
      return;
    }
  }

  public function edit()
  {
    if (empty($_POST['id']) || empty($_POST['nombre']) || empty($_POST['departamento'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->update($_POST['nombre'], $_POST['departamento'], $_POST['id'])) {
      echo json_encode(["success" => "Provincia actualizado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al actualizar provincia"]);
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
      echo json_encode(["success" => "Provincia eliminado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al eliminar provincia"]);
      return;
    }
  }

  public function getDepartamentos()
  {
    require_once 'models/departamentoModel.php';
    $departamentos = new DepartamentoModel();
    return $departamentos->getAll();
  }
}
