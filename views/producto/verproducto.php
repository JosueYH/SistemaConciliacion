
<?php require 'views/header.php';?>
<!--crud de registro de Producto-->
  <div  style="padding: 0px 10px 20px 20px;" class="card shadow mb-1">
    <div class="card-header py-5">
<!--diseño de encabezado!-->
      <h6 class="m-2 font-weight-bold text-primary">Ver Producto:<?php echo ($this->producto->producto); ?>
        <button data-toggle="modal" data-target="#modalFoto<?php echo $this->producto->id_producto ?>" title="Ver foto del producto" class="botonVer btn btn-outline-primary ">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
          </svg>
        </button>
      </h6>
    </div>
    <?php
      if (!empty($this->mensaje)){
        echo $this->mensaje ;
      }
    ?>
    <form  action="<?php echo constant('URL');?>consultarproducto/actualizarProducto" method="post" enctype="multipart/form-data">
      <div class="form-row">
        <!--Codigo_producto-->
        <div class="form-group col-md-6">
          <label for="codigo_producto">Codigo</label>
          <input name="codigo_producto" type="text" class="form-control" id="codigo_producto" value="<?php echo $this->producto->codigo_producto ?>" required>
        </div>
        <!--foto-->
        <div class="form-group col-md-6">
          <label for="foto">Foto del Producto</label>
          <input type="file" name="foto" class="form-control" id="foto" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
        </div>
        <!--producto-->
        <div class="form-group col-md-6">
          <label for="producto">Nombre del Producto</label>
          <input name="producto" type="text" value="<?php echo ($this->producto->producto); ?>" class="form-control" id="producto" required>
        </div>
        <!--Precio-->
        <div class="form-group col-md-6">
          <label for="precio">Precio</label>
          <input name="precio"  type="text" class="form-control" id="precio" value="<?php echo $this->producto->precio; ?>" required>
        </div>

        <div class="form-group col-md-6">
          <label for="stock">Stock</label>
          <input name="stock"  type="text" class="form-control" id="stock" value="<?php echo $this->producto->stock; ?>" required>
        </div>

        <!--Categoria_Material-->
          <div class="form-group col-md-6">
            <label for="id_categoria_producto">Categoria</label>
            <select name="id_categoria_producto" id="id_categoria_producto" class="form-control" required>
              <option value="<?php echo $this->producto->id_categoria_producto ?>">Elija Una Categoria</option>
              <!--Solo se Hace una funion... que estese en el mapProveedor-->
              <?php
              foreach ($this->categoriaproducto as $row){
                $obj = new CategoriaProductoMap();
                $obj=$row;
               ?>
               <option value="<?php echo $obj->id_categoria_producto ?>"><?php echo $obj->categoria_producto; ?></option>
             <?php } ?>
            </select>
          </div>

        <!--Estado-->
        <div class="form-group col-md-6">
          <label for="estado">Estado</label>
          <select name="estado" id="estado" class="form-control" required>
            <option value="<?php echo $this->producto->estado; ?>"><?php echo $this->producto->estado; ?></option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
            <option value="suspendido">Suspendido</option>
          </select>
        </div>
        <!--descripcion-->
        <div class="form-group col-12">
          <label for="descripcion">Descripción</label>
          <textarea name="descripcion" class="form-control" id="descripcion" required ><?php echo $this->producto->descripcion; ?></textarea>
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <div class="col-2">
          <a class="btn btn-secondary" href="<?php echo constant('URL') ?>consultarproducto">Cancelar</a>
        </div>
    </form>
  </div>

  <!--MODAL PARA LA IMAGENES-->
  <div class="modal fade" id="modalFoto<?php echo $this->producto->id_producto ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">FOTO DEL PRODUCTO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img  class="img-producto" src="data:image/jpg;base64,<?php echo base64_encode($this->producto->foto); ?>" >
          </div>
        </div>
      </div>
    </div>
<?php require 'views/footer.php';?>
