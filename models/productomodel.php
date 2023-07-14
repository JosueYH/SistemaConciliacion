<?php
include_once 'models/mapas.php';
class ProductoModel extends Modelo
{
   /*
    =======================================================
     Funcion de constructor| Pariete::_constructor
    =======================================================
   */
  public function __construct()
  {

    parent::__construct();
  }
  /*
  ==========================================================================
   Funcion que hace unso del INSERT INTO para insertar datos de un producto
  ==========================================================================
  */
  public function insertarProducto($datos){

    /*
    ==================================================================================
    INSERT INTO Producto (id_producto_proveedor,producto,stock,precio,medida,estado)
    VALUES ('1','sss','5','120.22','ki','activo')
    ==================================================================================
    */

    try {
      /*
      ========================================================================================
      variable para alamcenar el query, cojiendo el descripcion d ela base de datos y
      utilizando la funcion connect() ... interna no por default, y preparamos el codigo sql
      ===========================================================================================
      */
      $consulta=$this->db->connect()->prepare("INSERT INTO producto (id_categoria_producto,codigo_producto,producto,descripcion,foto,precio,stock)VALUES (:id_categoria_producto,:codigo_producto,:producto,:descripcion,:foto,:precio,:stock)");
      //executamos e indicamosque va con quien
      $consulta->execute(['id_categoria_producto'=>$datos['id_categoria_producto'],'codigo_producto'=>$datos['codigo_producto'],'producto'=>$datos['producto'],'descripcion'=>$datos['descripcion'],'foto'=>$datos['foto'] ,'precio'=>$datos['precio'],'stock'=>$datos['stock']]);
      //return cuando sea afirmativa, caso que no
      return true;
    } catch (PDOException $e) {
      //mostramos el false
    //  echo "$e";
      return false;
    }
    //echo "$datos";
  }
  /*
  =================================================================
    Funcion para retornar un array con datos del proveedor
  =================================================================
  */
  public function foraneaKey()
  {
    $items=[];//arreglovacio
    //si funciona
    try {
      $consulta=$this->db->connect()->query("SELECT * FROM categoria_producto WHERE estado='activo'");//consulta sencilla
      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new CategoriaProductoMap();//objeto
        //valores del array<-$row
        $item->id_categoria_producto=$row['id_categoria_producto'];//propiedades
      //  $item->ruc=$row['ruc'];
        $item->categoria_producto=$row['categoria_producto'];
        //$item->telefono=$row['telefono'];
        //$item->correo=$row['correo'];
      //  $item->direccion=$row['direccion'];
        //ingresar en un arreglo un nuevo valor
        array_push($items,$item);//
      }
      return $items;//sifunciona
    } catch (PDOException $e) {//excepciones pero de PDO
      return [];//nofunciona
    }
  }

  //===============================================================================
  /*============================================================================
  FUNCION PARA BUSCAR Y EVITAR QUE EL USUARIO INGRESE UN REGISTRO
    ============================================================================
  */
  public function buscarProducto($datos)
  {
    $consulta=$this->db->connect()->prepare("SELECT * FROM producto WHERE codigo_producto=:codigo_producto AND estado='activo'");
    try {
      $consulta->execute(['codigo_producto'=>$datos['codigo_producto']]);
      if ($row=$consulta->fetch()) {
        // code...
        return true;
      }
    } catch (PDOException $e) {
      return false;
    }
  }
  //
  /*============================================================================
  FUNCION PARA BUSCAR Y EVITAR QUE EL USUARIO INGRESE UN REGISTRO
    ============================================================================
  */
  public function buscarProductoN($datos)
  {
    $consulta=$this->db->connect()->prepare("SELECT * FROM producto WHERE producto=:producto AND estado='activo'");
    try {
      $consulta->execute(['producto'=>$datos['producto']]);
      if ($row=$consulta->fetch()) {
        // code...
        return true;
      }
    } catch (PDOException $e) {
      return false;
    }
  }
}
