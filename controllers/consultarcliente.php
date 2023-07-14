<?php

/**
*CLASE DE ConsultaCliente, SE LA VE COMO UN OBJETO PADRE CONSUS HIJOS O SEA FUNCIONES
 *revisado
 */
class ConsultarCliente extends Controller //se extiende al controlador en libs/controller
{
  /*
    ===================================================================
    Funcion que va a mandar paramestros y constructores 
    ===================================================================
  */

  //constructor
  function __construct()
  {
    // llamamos al pariente __construct
    parent::__construct();
    //array en vista con el objeto clientemap (Class ClienteMap)
    $this->vista->clientemap= [];
    //mensaje en vista
    //$this->vista->mensaje="";
    //esta var, va a cojer la funcion render para madar parametros >>libs/view.php/class/Vista/render($nombre)
  }
  /*
    ======================================
     FUNCION RENDER CON PARAMETROS VACIOS 
    ======================================
  */
  //fun render
  function render()
  {
    //var = este modelo->su funcion con parametros vacios
    $clientes=$this->modelo->darCliente();
    //esta vista->objeto clientemap= var
    $this->vista->clientemap=$clientes;
    //renderuzar/--->>>>carpeta/hoja
    $this->vista->render('cliente/consultarcliente');
  }
 /*
    ======================================================
      FUNCION PARA VISUALIZAR | VISUALIZA CON PARAMETROS
    ======================================================
  */
  function verCliente($parametro=null)//conn parametro
  {
    //se coje el primer puesto del parametro
    $id_cliente=$parametro[0];//asiganar id
    //var= estae modelo con la funcion darPorId(paraemtro);
    $cliente=$this->modelo->darPorId($id_cliente);
    //sessiones
    session_start();
    //creamos una session, con el contenido del map parametro
    $_SESSION['id_cliente']=$cliente->id_cliente;
    //pasamos a vista materia
    $this->vista->cliente = $cliente;
    //enviamos en vista un mensaje vaciio
    $this->vista->$mensaje="";
    //renderizamos
    $this->vista->render('cliente/vercliente');
    /*
    Mostrar los array
    */
    //var_dump($parametro);
  }
  /*
    ====================================================
      AJAX Funcion que manda un POST Buscar al Cliente  
    ====================================================
  */
  
  //para visualizar
  function buscarCliente()//conn parametro
  {
    $clientes=$this->modelo->hallarCliente(['buscar'=>$_POST['buscado']]);
    //esta vista->objeto clientemap= var
    $this->vista->clientemap=$clientes;
    //renderuzar/--->>>>carpeta/hoja
    $this->vista->render('cliente/consultarcliente');

  }
  //funcion de actualizar
  function actualizarCliente()
  {
    //iniciamos session
    session_start();
    //cambiamos de variable
    $id_cliente=$_SESSION['id_cliente'];
    $url=constant('URL').'consultarcliente';//link
    //recojemos
    $cedula_ruc=$_POST['cedula_ruc'];
    $tipo_cliente=$_POST['tipo_cliente'];
    $nombre=$_POST['nombre'];
    $correo=$_POST['correo'];
    $celular=$_POST['celular'];
    $telefono=$_POST['telefono'];
    $direccion=$_POST['direccion'];
    $estado=$_POST['estado'];
    //destrir sessiones
    unset($_SESSION['id_cliente']);
    //funcion, este modelo, conla funcion update(parametros como un array)
    if ($this->modelo->update(['id_cliente'=>$id_cliente,'cedula_ruc'=>$cedula_ruc,'tipo_cliente'=>$tipo_cliente,'nombre'=>$nombre,'correo'=>$correo,'celular'=>$celular,'telefono'=>$telefono,'direccion'=>$direccion,'estado'=>$estado])) {
        // actualizar matricula
        $cliente=new ClienteMap();//objeto
        //retornar correoes a vistya
        $cliente->id_cliente=$id_cliente;
        //$cliente->nombre=$nombre;
        $cliente->cedula_ruc=$cedula_ruc;
        $cliente->tipo_cliente=$tipo_cliente;
        $cliente->nombre=$nombre;
        $cliente->correo=$correo;
        $cliente->celular=$celular;
        $cliente->telefono=$telefono;
        $cliente->direccion=$direccion;
        $cliente->estado=$estado;
        //empezar a enviar vista para desglozarlo
        $this->vista->cliente=$cliente;
        //mensaje
        $this->vista->mensaje=
        "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            <strong>Exitoso</strong> Se ha Actualizado con Exito el Cliente
            <a href='$url'> Revisar los clientes</a>
        </div>
        ";
    }else{
      //error
      $this->vista->mensaje=
      "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Sin Exitoso</strong> No Se ha Actualizado con Exito el Cliente
          <a href='$url'> Revisar los clientes</a>
      </div>
      ";
    }
    //renderizamos la vista
    $this->vista->render('cliente/vercliente');
  }
  //funcion eliminar con parametro
  function eliminarCliente($parametro=null)
  {
    //asignamos el id
    $id_cliente=$parametro[0];
    // mapeo
    //condicional
    //funcion, este mdoelo con la funcion  delete(parametro)
    if ($this->modelo->delete($id_cliente)) {//enviamos el id
        //mensaje
        /*$this->vista->mensaje=
        "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            <strong>Eliminado</strong> Se ha Eliminado con Exito el Cliente
            <a href='$url'> Revisar los clientes</a>
        </div>
        ";*/
    }
    //$this->render('Cliente/consultarcliente');
    //echo "Se Elimino".$id_cliente;
  }
  /*
    ===================================================================
          AJAX Funcion que ayuda a ver el estado del cliente
    ===================================================================
  */
  //funcion para ver otros estados
  function activoCliente()
  {
    //var = este modelo->su funcion con parametros vacios
    $clientes=$this->modelo->estadoCliente('activo');
    //esta vista->objeto clientemap= var
    $this->vista->clientemap=$clientes;
    //renderuzar/--->>>>carpeta/hoja
    $this->vista->render('cliente/consultarcliente');
  }
  //funcion para ver otros estados
  function inactivoCliente()
  {
    //var = este modelo->su funcion con parametros vacios
    $clientes=$this->modelo->estadoCliente('inactivo');
    //esta vista->objeto clientemap= var
    $this->vista->clientemap=$clientes;
    //renderuzar/--->>>>carpeta/hoja
    $this->vista->render('cliente/consultarcliente');
  }
  //funcion para ver otros estados
  function suspendidoCliente()
  {
    //var = este modelo->su funcion con parametros vacios
    $clientes=$this->modelo->estadoCliente('suspendido');
    //esta vista->objeto clientemap= var
    $this->vista->clientemap=$clientes;
    //renderuzar/--->>>>carpeta/hoja
    $this->vista->render('cliente/consultarcliente');
  }
}
 ?>
