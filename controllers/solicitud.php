<?php

class Solicitud extends Controller
{
  public $model;
  public $view;
  public $cliente;
  public $usuario;

  public function __construct()
  {
    parent::__construct();
    $this->cliente = new Cliente();
    $this->cliente->loadModel('cliente');

    $this->usuario = new Usuario();
    $this->usuario->loadModel('usuario');
  }

  public function render()
  {
    $this->view->render('solicitud/index', [
      "clientes" => $this->cliente->model->getAll(),
      "clientesTipos" => $this->cliente->getTipos(),
      "abogados" => $this->usuario->model->getAll("ut.nombre", "Abogado"),
    ]);
  }

  public function index()
  {
    $id = null;
    if (isset($_POST['usuario']) && $_POST['usuario'] != "") {
      $usuario = $this->usuario->model->get($_POST['usuario']);
      if ($usuario['idtipo_usuario'] == 3) $id = $usuario['id'];
    }

    $data = [];
    $solicitudes = $this->model->getAll($id);
    if (count($solicitudes) > 0) {
      foreach ($solicitudes as $solicitud) {
        $botones = "<button class='btn btn-warning edit' id='{$solicitud["id"]}'><i class='fas fa-pencil-alt'></i></button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$solicitud["id"]}'><i class='fas fa-times'></i></button>";

        $class = "";
        $txt = "";
        $check = "";
        if ($solicitud["estado"] === "0") {
          $class = "danger";
          $txt = "En espera";
        } else if ($solicitud["estado"] === "1") {
          $class = "warning";
          $txt = "En proceso";
          $check = "<button class='ml-1 btn btn-success btn-sm estado' id='{$solicitud["id"]}'><i class='fas fa-check'></i></button>";
        } else {
          $class = "success";
          $txt = "Procesado";
          $check = "<button class='ml-1 btn btn-warning btn-sm estado' id='{$solicitud["id"]}'><i class='fas fa-check'></i></button>";
        }
        $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer delete' id='{$solicitud["id"]}' style='font-size:12px'>$txt</span>$check";

        $url = "<a href='" . URL . "$solicitud[url]' download><i class='fas fa-download'></i></a>";

        $data[] = [
          $solicitud["id"],
          $solicitud["n_expediente"],
          $solicitud["cliente"],
          $url,
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

    $cliente = $this->cliente->model->get($_POST['documento'], 'documento');
    if (empty($cliente)) {
      $this->cliente->model->save([
        'documento' => $_POST['documento'],
        'razon_social' => $_POST['razon_social'],
        'telefono' => $_POST['telefono'],
        'direccion' => $_POST['direccion'],
        'idtipo_cliente' => $_POST['tipo'],
      ]);
      $cliente = $this->cliente->model->get($_POST['documento'], 'documento');
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

  public function uploadActa()
  {
    if (empty($_FILES['acta']) || empty($_POST['solicitud'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    $solicitud = $this->model->get($_POST['solicitud']);
    if (empty($solicitud)) {
      echo json_encode(["error" => "Datos incorrectos"]);
      return;
    }

    $types = ['pdf', 'doc', 'docx'];

    $ruta = "";
    $directorio = "dist/docs/abogados/";
    if (!file_exists($directorio)) mkdir($directorio, 0777);

    $extension = pathinfo($_FILES['acta']['name'], PATHINFO_EXTENSION);

    if (!in_array($extension, $types)) {
      echo json_encode(["error" => "Tipo de documento incorrecto"]);
      return;
    }

    // Generar un nuevo nombre para el archivo
    $file = str_replace(" ", "_", $_FILES['acta']['name']);
    $ruta = $directorio . $file;

    if (move_uploaded_file($_FILES['acta']['tmp_name'], $ruta)) {
      $this->model->updateColum("url", $ruta, $solicitud['id']);
      $this->model->updateColum("estado", 1, $solicitud['id']);
      echo json_encode(["success" => "Acta cargada correctamente"]);
      return;
    } else {
      echo json_encode(["error" => "Ocurrio un error al carga el acta"]);
      return;
    }
  }

  public function updateStatus()
  {
    if (empty($_POST['id'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    $solicitud = $this->model->get($_POST['id']);
    $estado = ($solicitud['estado'] == 1) ? 2 : 1;
    if ($this->model->updateColum("estado", $estado, $solicitud['id'])) {
      echo json_encode(["success" => "Echo"]);
      return;
    } else {
      echo json_encode(["error" => "Error"]);
      return;
    }
  }
}
