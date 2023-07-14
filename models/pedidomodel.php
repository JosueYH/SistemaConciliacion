<?php
include_once 'models/mapas.php'; //m
class PedidoModel extends Modelo //extiende a modelo
{
  //contructor
  public function __construct()
  {
    // pariente
    parent::__construct();
  }

  //==============================================================================================================
  //==============================================================================================================
  //==============================================================================================================
  public function foraneaKey()
  { //funcion para buscar la foranea key d eproveedor
    $items = []; //arreglovacio
    //si funciona
    try {
      $consulta = $this->db->connect()->query("SELECT * FROM cliente WHERE estado='activo'"); //consulta sencilla
      while ($row = $consulta->fetch()) { //while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item = new ClienteMap(); //objeto
        //valores del array<-$row
        $item->id_cliente = $row['id_cliente']; //propiedades
        //$item->ruc=$row['ruc'];
        $item->nombre = $row['nombre'];
        //$item->telefono=$row['telefono'];
        //$item->correo=$row['correo'];
        //$item->direccion=$row['direccion'];
        //ingresar en un arreglo un nuevo valor
        array_push($items, $item); //
      }
      return $items; //sifunciona
    } catch (PDOException $e) { //excepciones pero de PDO
      return []; //nofunciona
    }
  }
  //==============================================================================================================
  //==============================================================================================================
  //==============================================================================================================
  public function foraneaKeyProducto() //foranea key para el detalle_ingreso->
  {
    $items = [];
    try {
      $consulta = $this->db->connect()->query("SELECT * FROM producto WHERE estado='activo'"); //consulta sencilla
      while ($row = $consulta->fetch()) { //while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item = new ProductoMap(); //objeto
        //valores del array<-$row
        $item->id_producto = $row['id_producto']; //propiedades
        //$item->ruc=$row['ruc'];
        $item->producto = $row['producto'];
        $item->precio = $row['precio'];
        //ingresar en un arreglo un nuevo valor
        array_push($items, $item); //
      }
      return $items; //sifunciona
    } catch (PDOException $e) { //excepciones pero de PDO
      return []; //nofunciona
    }
  }


  public function extraerDatosTablaTemporal()
  { //SELECT DE LA TABLA TEMPORAL
    session_start();
    $id_usuario = $_SESSION['id_usuario']; //id_usuario
    $items = [];
    $consulta = $this->db->connect()->query("SELECT * FROM temporal_pedido WHERE id_usuario='$id_usuario'"); //CONUSLTA TABLA TEMPORA
    try {
      while ($row = $consulta->fetch()) {
        $id_producto = $row['id_producto'];
        $producto = $this->buscarProducto(['id_producto' => $id_producto]); //llamamos a la funcion para traer un map de produes
        $item = new DetallePedidoMap();
        $item->id_temporal = $row['id_temporal'];
        $item->id_producto = $row['id_producto']; //mapmateria
        $item->id_usuario = $row['id_usuario'];
        $item->producto = $producto['producto']; //mapmateria
        $item->codigo_producto = $producto['codigo_producto']; //mapmateria
        //muktiplicaciones
        $item->total = $row['cantidad'] * $producto['precio'];
        $item->cantidad = $row['cantidad'];
        $item->precio = $producto['precio'];
        array_push($items, $item);
      }
      return $items;
    } catch (PDOException $e) {
      return [];
    }
  }

  public function buscarProducto($id)
  {
    $consulta = $this->db->connect()->prepare("SELECT * FROM producto WHERE id_producto=:id_producto");
    try {
      $consulta->execute(['id_producto' => $id['id_producto']]);
      if ($row = $consulta->fetch()) {
        $item = ['producto' => $row['producto'], 'codigo_producto' => $row['codigo_producto'], 'precio' => $row['precio']];
        return $item;
      }
    } catch (PDOException $e) {
      return [];
    }
  }

  // consulta el stock para validar si hay disponibilidad
  public function consultarStockProducto($datos)
  {
    $consulta = $this->db->connect()->prepare("SELECT stock FROM producto WHERE id_producto=:id_producto");
    try {
      $consulta->execute(['id_producto' => $datos['id_producto']]);
      return $consulta->fetch(PDO::FETCH_ASSOC)['stock'];
    } catch (PDOException $e) {
      return false;
    }
  }

  public function agregarTablaTemporal($datos)
  {
    session_start();
    $id_usuario = $_SESSION['id_usuario'];
    $consulta = $this->db->connect()->prepare("INSERT INTO temporal_pedido (id_producto,id_usuario,cantidad)VALUES(:id_producto,'$id_usuario',:cantidad)");
    try {
      $consulta->execute(['id_producto' => $datos['id_producto'], 'cantidad' => $datos['cantidad']]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  // resta el stock del producto
  public function updateStockProducto($datos)
  {
    $consulta = $this->db->connect()->prepare("UPDATE producto SET stock = :stock WHERE id_producto = :id_producto");
    try {
      $consulta->execute(['id_producto' => $datos['id_producto'], 'stock' => $datos['stock']]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  // consulta la cantidad de la tabla temporal
  public function consultarProductoTemporal($datos)
  {
    $consulta = $this->db->connect()->prepare("SELECT * FROM temporal_pedido WHERE id_temporal=:id_temporal");
    try {
      $consulta->execute(['id_temporal' => $datos['id_temporal']]);
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return false;
    }
  }

  // consulta la cantidad de la tabla temporal
  public function consultarTablaTemporal()
  {
    session_start();
    $id_usuario = $_SESSION['id_usuario'];
    $consulta = $this->db->connect()->prepare("SELECT * FROM temporal_pedido WHERE id_usuario='$id_usuario'");
    try {
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return false;
    }
  }

  //==============================================================================================================
  //=========================FUNCIONES PARA LA TABLA TEMPORAL-DELETE *============================================
  //==============================================================================================================
  public function eliminarTablaTemporal()
  {
    session_start();
    $id_usuario = $_SESSION['id_usuario'];
    $consulta = $this->db->connect()->prepare("DELETE FROM temporal_pedido WHERE id_usuario='$id_usuario'");
    try {
      $consulta->execute();
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
  //==============================================================================================================
  //=========================FUNCIONES PARA LA TABLA TEMPORAL-DELETE x==============================================
  //==============================================================================================================
  public function delete($id)
  {
    $consulta = $this->db->connect()->prepare("DELETE FROM temporal_pedido WHERE id_temporal=:id_temporal");
    try {
      $consulta->execute(['id_temporal' => $id['id_temporal']]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
  //insertar pedido
  public function insertarPedido($datos)
  {
    $consulta = $this->db->connect()->prepare("INSERT INTO pedido (id_cliente,total,fecha_entrada,fecha_salida,comentario)VALUES (:id_cliente,:total,:fecha_entrada,:fecha_salida,:comentario)");
    try {
      $consulta->execute(['id_cliente' => $datos['id_cliente'], 'total' => $datos['total'], 'fecha_entrada' => $datos['fecha_entrada'], 'fecha_salida' => $datos['fecha_salida'], 'comentario' => $datos['comentario']]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
  //select el pedido
  public function darId($datos)
  {
    //return su id
    $item = new PedidoMap();
    $consulta = $this->db->connect()->prepare("SELECT * FROM pedido WHERE id_cliente=:id_cliente AND comentario=:comentario");
    try {
      $consulta->execute(['id_cliente' => $datos['id_cliente'], 'comentario' => $datos['comentario']]);
      if ($row = $consulta->fetch()) {
        $item->id_pedido = $row['id_pedido'];
      }
      return $item;
    } catch (PDOException $e) {
      return [];
    }
  }
  public function insertarDetallePedido($items)
  {
    //insert
    $consulta = $this->db->connect()->prepare("INSERT INTO detalle_pedido (id_pedido,id_producto,precio,cantidad)VALUES(:id_pedido,:id_producto,:precio,:cantidad)");
    try {
      $consulta->execute(['id_pedido' => $items['id_pedido'], 'precio' => $items['precio'], 'cantidad' => $items['cantidad'], 'id_producto' => $items['id_producto']]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
  //detalle pedido
  public function agregarDetallePedido($id)
  {
    session_start();
    $id_usuario = $_SESSION['id_usuario']; //id_usuario
    $id_pedido = $id['id_pedido']; //id_ingreso_material
    //buscar tabla temporal
    $consulta = $this->db->connect()->query("SELECT * FROM temporal_pedido WHERE id_usuario='$id_usuario'");
    while ($row = $consulta->fetch()) {
      //buscar el producto
      $item = ['id_producto' => $row['id_producto']];
      $producto = $this->buscarProducto($item);
      //insertar en detalle_ingreso (id_material,id_ingreso_material,cantidad,valor)
      $ditem = ['id_producto' => $row['id_producto'], 'cantidad' => $row['cantidad'], 'id_pedido' => $id_pedido, 'precio' => $producto['precio']];
      $contentD = $this->insertarDetallePedido($ditem);
    }
    $contentT = $this->eliminarTablaTemporal();
    if ($contentD == true && $contentT == true) {
      return true;
    } else {
      return false;
    }
  }
}
/*
DELIMITER $$;
CREATE PROCEDURE agregar_detalle_ingreso(id_usuario_temp INT, id_ingreso_material_det INT)
BEGIN

DECLARE valor_temp DECIMAL(10,2);
DECLARE cantidad_temp INT;
DECLARE id_material_temp INT;
DECLARE stock_old INT;
SELECT cantidad,valor INTO cantidad_temp,valor_temp
FROM temporal WHERE id_usuario=id_usuario_temp
END;$$

DELIMETER;

*/
