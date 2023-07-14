
<?php require 'views/header.php';?>
<!--crud de registro de Material-->
  <div style="padding: 0px 10px 20px 20px; "class="card shadow mb-1">
    <div class="card-header py-5">
<!--diseño de encabezado!-->
      <h6 class="m-2 font-weight-bold text-primary">Registro de Productos
        <a data-bs-toggle="tooltip" class="btn btn-outline-primary data-bs-placement-top" title="Revisar Los Registros" href="<?php echo constant('URL'); ?>consultarproducto">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
          </svg>
        </a>
      </h6>
    </div>
    <div id="response">

    </div>

    <form id="formulario_producto" enctype="multipart/form-data">
      <div class="form-row">
        <!--Codigo_producto-->
        <div class="form-group col-md-6">
          <label for="codigo_producto">Codigo</label>
          <input name="codigo_producto" type="text" class="form-control" id="codigo_producto" required>
          <div id="alert">

          </div>
        </div>
        <!--producto-->
        <div class="form-group col-md-6">
          <label for="producto">Producto</label>
          <input type="text" name="producto" class="form-control" id="producto" required>
          <div id="alert2">

          </div>
        </div>
        <!--precio-->
        <div class="form-group col-md-6">
          <label for="precio">Precio</label>
          <input type="text" name="precio" class="form-control" id="precio" required>
        </div>
        <!--precio-->
        <div class="form-group col-md-6">
          <label for="stock">Stock</label>
          <input type="text" name="stock" class="form-control" id="stock" required>
        </div>
        <!--Categoria_Material-->
          <div class="form-group col-md-6">
            <label for="id_categoria_producto">Categoria</label>
            <select name="id_categoria_producto" id="id_categoria_producto" class="form-control" required>
              <option value="">Elija Una Categoria</option>
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

        <!--foto-->
        <div class="form-group col-12">
          <label for="foto">Foto</label>
          <input type="file" name="foto" class="form-control" id="foto" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
        </div>
        <!--descripcion-->
        <div class="form-group col-12">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea name="descripcion" class="form-control" id="descripcion" required></textarea>
        </div>

      </div>
      <div class="col-12">
        <button id="save" type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
<?php require 'views/footer.php';?>
