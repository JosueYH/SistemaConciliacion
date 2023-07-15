<?php

class Distrito extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('distrito/index', [
      "provincias" => $this->getProvincias()
    ]);
  }

  public function index()
  {
    $data = [];
    $distritos = $this->model->getAll();
    if (count($distritos) > 0) {
      foreach ($distritos as $distrito) {
        $botones = "<button class='btn btn-warning edit' id='{$distrito["id"]}'><i class='fas fa-pencil-alt'></i></button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$distrito["id"]}'><i class='fas fa-times'></i></button>";

        $data[] = [
          $distrito["id"],
          $distrito["nombre"],
          $distrito["provincia"],
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

    $distrito = $this->model->get($_POST['id']);
    if ($distrito) {
      echo json_encode(["success" => "Distrito encontrada", "distrito" => $distrito]);
      return;
    } else {
      echo json_encode(["error" => "Error al buscar distrito"]);
      return;
    }
  }

  public function create()
  {
    if (empty($_POST['nombre']) || empty($_POST['provincia'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->save($_POST['nombre'], $_POST['provincia'])) {
      echo json_encode(["success" => "Distrito registrado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al registrar distrito"]);
      return;
    }
  }

  public function edit()
  {
    if (empty($_POST['id']) || empty($_POST['nombre']) || empty($_POST['provincia'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->update($_POST['nombre'], $_POST['provincia'], $_POST['id'])) {
      echo json_encode(["success" => "Distrito actualizado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al actualizar distrito"]);
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
      echo json_encode(["success" => "Distrito eliminado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al eliminar distrito"]);
      return;
    }
  }

  public function getProvincias()
  {
    require_once 'models/provinciaModel.php';
    $provincias = new ProvinciaModel();
    return $provincias->getAll();
  }
}
