<?php
include_once 'models/mapas.php';//mapeo y ovjeto material
//include_once 'models/mapmaterial.php';//mapeo y ovjeto material
class ConsultarPedidoModel extends Modelo //nos estnendemos al modelo de libs/model
{
//consructor
  public function __construct()
  {
    // pariente
    parent::__construct();
  }
  /*
    =============================================================
     Funcion darPerdido sin parametros | Utiliza arreglo vacio
    =============================================================
  */
  public function darPedido()
  {
    $items=[];//arreglovacio
    //si funciona
    try {
      $consulta=$this->db->connect()->query("SELECT p.*,c.`nombre` FROM pedido p,cliente c WHERE p.`estado`='activo' AND c.`id_cliente`=p.`id_cliente` ORDER BY p.`id_pedido` DESC");//consulta sencilla
      //$contador=$consulta->rowCount();//cuenta las filas
      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        //$contador=$row->rowCount();
        $item= new PedidoMap();//objeto
        $item->id_pedido=$row['id_pedido'];//propiedades
        $item->id_cliente=$row['nombre'];
        //$item->id_nombre=$row['id_nombre'];
        $item->total=$row['total'];
        $item->fecha_entrada=$row['fecha_entrada'];
        //$item->nombre=$row['nombre'];
        $item->fecha_salida=$row['fecha_salida'];
        $item->comentario=$row['comentario'];
        $item->estado=$row['estado'];
        //$contador=$contador+1;
        //ingresar en un arreglo un nuevo valor
        array_push($items,$item);//
      }
      //session_start();
      //$_SESSION['limite']=$contador;
      return $items;//sifunciona
    } catch (PDOException $e) {//excepciones pero de PDO
      return [];//nofunciona
    }
  }

  /*
    ==================================================================================================================
     Funcion hallarPedido con arreglos vacios | Realizara una consulta en la DB y ordenara el resultado por su ID ASC
    ==================================================================================================================
  */
  public function hallarPedido($datos)
  {
    $buscar=$datos['buscar'];
    $items=[];//arreglovacio
    //si funciona
    try {
      $consulta=$this->db->connect()->query(
        "SELECT p.*,c.`nombre`
        FROM pedido p,cliente c
        WHERE p.`estado`!='eliminado'
        AND p.`id_cliente`=c.`id_cliente`
        AND (c.`nombre` LIKE '%$buscar%' OR p.`fecha_entrada` LIKE '%$buscar%' OR
        p.`fecha_salida` LIKE '%$buscar%')ORDER BY p.`id_pedido` ASC");//consulta sencilla
      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new PedidoMap();//objeto
        $item->id_pedido=$row['id_pedido'];//propiedades
        $item->id_cliente=$row['nombre'];
        //$item->id_nombre=$row['id_nombre'];
        $item->total=$row['total'];
        $item->fecha_entrada=$row['fecha_entrada'];
        //$item->nombre=$row['nombre'];
        $item->fecha_salida=$row['fecha_salida'];
        $item->comentario=$row['comentario'];
        $item->estado=$row['estado'];
        //ingresar en un arreglo un nuevo valor
        array_push($items,$item);//
      }
      return $items;//sifunciona
    } catch (PDOException $e) {//excepciones pero de PDO
      return [];//nofunciona
    }
  }
  /*
    =========================================================================================
     Funcion con parametros que dara Run por ID a la cosulta del pedido en Model
    =========================================================================================
  */
  public function darPorId($id)
  {
    $item= new PedidoMap();//objeto
    $consulta=$this->db->connect()->prepare("SELECT p.*,c.`nombre` FROM pedido p,cliente c WHERE p.`id_pedido`=:id_pedido AND c.`id_cliente`=p.`id_cliente`");//consulta
    try {
      $consulta->execute(['id_pedido'=>$id]);//execucion
      //recorrer resultado
      if ($row=$consulta->fetch()) {

        $item->id_pedido=$row['id_pedido'];//propiedades
        $item->id_cliente=$row['nombre'];
        //$item->id_nombre=$row['id_nombre'];
        $item->total=$row['total'];
        $item->fecha_entrada=$row['fecha_entrada'];
        //$item->nombre=$row['nombre'];
        $item->fecha_salida=$row['fecha_salida'];
        $item->comentario=$row['comentario'];
        $item->estado=$row['estado'];
        // regresar objeto
        return $item;
      }

    } catch (PDOException $e) {//caso que nofuncione
      return null;//returnamos null
    }
  }
  /*
    =========================================================================================
     Funcion que buscara el detalle del Factura usando su ID para realizar la consulta
    =========================================================================================
  */
  public function buscarDetallePedido($id)
  {
    $items=[];
    $consulta=$this->db->connect()->prepare("SELECT d.*,p.`producto` FROM detalle_pedido d, producto p WHERE d.`id_pedido`=:id_pedido AND d.`id_producto`=p.`id_producto`");
    try {
      $consulta->execute(['id_pedido'=>$id]);
      while ($row=$consulta->fetch()) {
        $item = new DetallePedidoMap();
        $item->producto=$row['producto'];
        //$item->codigo_material=$row['ca'];
        $item->cantidad=$row['cantidad'];
        $item->precio=$row['precio'];
        //$item->total=$row[''];
        array_push($items,$item);
      }
      return $items;
    } catch (PDOException $e) {
      return [];
    }
  }
}
 ?>
