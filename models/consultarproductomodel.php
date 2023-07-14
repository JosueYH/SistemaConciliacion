<?php
//referencia
include_once 'models/mapas.php';//mapeo y ovjeto material
/**
*CLASE DE PRODUCTO, SE LA VE COMO UN OBJETO PADRE CONSUS HIJOS O SEA FUNCIONES
 *revisado el 2021/05/26
 */
class ConsultarProductoModel extends Modelo //nos estnendemos al modelo de libs/model
{
//consructor
  public function __construct()
  {
    // pariente
    parent::__construct();
  }
  /*
    ========================================================
     Funcion darproducto sin parametros | Arreglos Vacios 
    ========================================================
  */
  public function darProducto()
  {
    $items=[];//arreglovacio
    //si funciona
    try {
      $consulta=$this->db->connect()->query("SELECT p.*,c.`categoria_producto`  FROM producto p, categoria_producto c WHERE p.`estado`='activo' AND p.`id_categoria_producto`=c.`id_categoria_producto`");//consulta sencilla
      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new ProductoMap();//objeto
        //valores del array<-$row
        $item->id_producto=$row['id_producto'];//propiedades
        $item->id_categoria_producto=$row['id_categoria_producto'];
        $item->categoria_producto=$row['categoria_producto'];
        $item->codigo_producto=$row['codigo_producto'];
        $item->producto=$row['producto'];
        $item->descripcion=$row['descripcion'];
        $item->foto=$row['foto'];
        $item->precio=$row['precio'];
        $item->stock=$row['stock'];
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
    =========================================================
     Funcion hallarMaterial sin parametros y arreglos vacios
    =========================================================
  */
  public function hallarProducto($datos)
  {
    $buscar=$datos['buscar'];
    $items=[];//arreglovacio
    //si funciona
    try {
      $consulta=$this->db->connect()->query(
        "SELECT p.*,c.`categoria_producto`
        FROM producto p,categoria_producto c
        WHERE p.`estado`!='eliminado'
        AND p.`id_categoria_producto`=c.`id_categoria_producto`
        AND (p.`codigo_producto` LIKE '%$buscar%' OR p.`producto` LIKE '%$buscar%' OR
        p.`precio` LIKE '%$buscar%' OR c.`categoria_producto` LIKE '%$buscar%')");//consulta sencilla
      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new ProductoMap();//objeto
        //valores del array<-$row
        $item->id_producto=$row['id_producto'];//propiedades
        $item->id_categoria_producto=$row['id_categoria_producto'];
        $item->categoria_producto=$row['categoria_producto'];
        $item->codigo_producto=$row['codigo_producto'];
        $item->producto=$row['producto'];
        $item->descripcion=$row['descripcion'];
        $item->foto=$row['foto'];
        $item->precio=$row['precio'];
        $item->stock=$row['stock'];
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
    ==================================================================
     Funcion dque mostrare el registro con su ID antes de actualizar
    ==================================================================
  */
  public function darPorId($id)
  {
    $item= new ProductoMap();//objeto
    $consulta=$this->db->connect()->prepare("SELECT *  FROM producto WHERE id_producto=:id_producto");//consulta
    try {
      $consulta->execute(['id_producto'=>$id]);//execucion
      //recorrer resultado
      while ($row=$consulta->fetch()) {
        $item->id_producto=$row['id_producto'];//propiedades

        $item->id_categoria_producto=$row['id_categoria_producto'];
        $item->codigo_producto=$row['codigo_producto'];
        session_start();///iniciamos session ara rellenar el dato
        $_SESSION['foto']=$row['foto'];//guardamos enuna variable
        $item->producto=$row['producto'];
        $item->descripcion=$row['descripcion'];
        $item->foto=$row['foto'];//observacion
        $item->precio=$row['precio'];
        $item->stock=$row['stock'];
        $item->estado=$row['estado'];

        // regresar objeto
        return $item;
      }
    } catch (PDOException $e) {//caso que nofuncione
      return null;//returnamos null
    }
  }
/*
    =============================================================================
     Funcion update con parametros del item(contiene los Post nuevos), un array 
    =============================================================================
  */
  public function update($item)
  {
    //consulta
    $consulta=$this->db->connect()->prepare("SELECT id_producto,precio FROM producto WHERE id_producto!=:id_producto AND codigo_producto=:codigo_producto AND id_categoria_producto=:id_categoria_producto AND producto=:producto AND estado=:estado");
    try {
      $consulta->execute(['id_producto'=>$item['id_producto'],'codigo_producto'=>$item['codigo_producto'],'id_categoria_producto'=>$item['id_categoria_producto'],'producto'=>$item['producto'],'estado'=>$item['estado']]);//while para estraer la informacion
      if ($row=$consulta->fetch()) {
        //guardar variables solo aqui...
        $id_producto=$row['id_producto'];//id
        $precio=$row['precio'];//precio antes
        /*-------------------------------------------*/
        $nuevo_precio=$item['precio'];//precio ahora

        //consulta hara lapreparaciond e la actualizacion
        $consulta=$this->db->connect()->prepare("UPDATE producto SET descripcion=:descripcion,foto=:foto,precio='$nuevo_precio',estado=:estado WHERE id_producto='$id_producto'");//actualizar
        //nuevo
        try {
          $consulta->execute(['descripcion'=>$item['descripcion'],'foto'=>$item['foto'],'estado'=>$item['estado']]);//executamos
          if ($this->delete($item['id_producto'])) {
              //return en true
              return true;
            }
        } catch (PDOException $e) {
          //retornamos falso
          return false;
        }
      }else{
        // code...
        $consulta=$this->db->connect()->prepare("UPDATE producto SET id_categoria_producto=:id_categoria_producto,codigo_producto=:codigo_producto,producto=:producto,descripcion=:descripcion,foto=:foto,precio=:precio,stock=:stock,estado=:estado WHERE id_producto=:id_producto");//actualizar
        try {
          $consulta->execute(['id_producto'=>$item['id_producto'],'id_categoria_producto'=>$item['id_categoria_producto'],'codigo_producto'=>$item['codigo_producto'],'producto'=>$item['producto'],'descripcion'=>$item['descripcion'],'foto'=>$item['foto'],'precio'=>$item['precio'], 'stock'=>$item['stock'],'estado'=>$item['estado']]);
          return true;//retornamostrue para que mande una accion
        } catch (PDOException $e) {
          return false;//etornamos false para idnicar errores
        }
      }
    } catch (PDOException $e) {
      return false;
    }
  }


/*
    ================================================================================
     Funcion con parametros para eliminar la consulta de un producto usando su ID
    ================================================================================
  */  public function delete($id)//parametro
  {
    //eliminar
    $consulta=$this->db->connect()->prepare("UPDATE producto SET estado='eliminado'  WHERE id_producto=:id_producto");//actualizar
    try {
      $consulta->execute(['id_producto'=>$id]);
      return true;//retornamos
    } catch (PDOException $e) {
      return false;//retronamos
    }
  }
  /*
    ========================================================================
     Funcion darProducto sin parametros | y muestra el estado del producto
    ========================================================================
  */
  public function estadoProducto($estado)
  {
    $items=[];//arreglovacio
    //si funciona
    $consulta=$this->db->connect()->prepare("SELECT p.*,c.`categoria_producto`  FROM producto p, categoria_producto c WHERE p.`estado`=:estado AND p.`id_categoria_producto`=c.`id_categoria_producto`");//consulta sencilla
    try {
        $consulta->execute(['estado'=>$estado]);
      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new ProductoMap();//objeto
        //valores del array<-$row
        $item->id_producto=$row['id_producto'];//propiedades
        $item->id_categoria_producto=$row['id_categoria_producto'];
        $item->categoria_producto=$row['categoria_producto'];
        $item->codigo_producto=$row['codigo_producto'];
        $item->producto=$row['producto'];
        $item->descripcion=$row['descripcion'];
        $item->foto=$row['foto'];
        $item->precio=$row['precio'];
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
    ==========================================================
     Funcion que retorna un array con los datos del proveedor
    ==========================================================
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
}
 ?>
