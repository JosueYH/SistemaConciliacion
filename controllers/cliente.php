<?php

class Cliente extends Controller
{
  public $model;
  public $view;

  function __construct()
  {
    // code...
    // llamamos al pariente __construct
    parent::__construct();
    $this->view->mensaje = "";
    //esta var, va a cojer la funcion render para madar parametros >>libs/view.php/class/Vista/render($nombre)
  }

  function render()
  {
    $this->view->render('cliente/index');
  }

  function agregarCliente()
  {
    $url = constant('URL') . 'consultarcliente';
    //regla, y si lo retrona un true se manda el mensaje
    if ($this->model->insertarCliente(['cedula_ruc' => $_POST['cedula_ruc'], 'tipo_cliente' => $_POST['tipo_cliente'], 'nombre' => $_POST['nombre'], 'correo' => $_POST['correo'], 'celular' => $_POST['celular'], 'telefono' => $_POST['telefono'], 'direccion' => $_POST['direccion']])) {
      echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
      <strong>Exitoso</strong> Se ha Registrado con Exito el Cliente
      <a href='$url'> Revisar los clientes</a>
    </div>";
    } else {
      //mensaje
    ?><div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Problemas</strong> Hubo un problema con el ingreso de este Cliente
        <a href='<?php echo $url ?>'> Revisar los clientes</a>
      </div>
    <?php
    }
  }
  /*============================================================================
  FUNCION PARA LLAMAR A LA FUNCION BUSCAR Y EVITAR QUE EL USUARIO INGRESE UN REGISTRO
    ============================================================================
  */
  function buscarRegistro()
  {

    if ($this->model->buscarCliente(['cedula_ruc' => $_GET['cedula_ruc']])) {
    ?>
      <p style="font-size:10px;color:red;">
        Este numero de Cedula o RUC ya esta registrado
      </p>
<?php
    } else {
      $bool = true;
      echo $bool;
    }
  }
}
?>