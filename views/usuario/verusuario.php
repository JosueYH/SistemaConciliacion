
<?php require 'views/header.php';?>
<!--crud de registro de Material-->
  <div style="padding: 0px 10px 20px 20px; "class="card shadow mb-1">
    <div class="card-header py-5">
<!--diseño de encabezado!-->
      <h6 class="m-2 font-weight-bold text-primary">Ver Usuario: <?php echo $this->usuario->nombre_usuario; ?>
        o
        <a data-bs-toggle="tooltip" class="btn btn-outline-primary data-bs-placement-top" title="Revisar Los Registros" href="<?php echo constant('URL') ?>consultarusuario">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
          </svg>
        </a>
      </h6>
    </div>
    <?php
      if (!empty($this->mensaje)){
        echo $this->mensaje ;
      }
    ?>

    <form  action="<?php echo constant('URL');?>consultarusuario/actualizarUsuario" method="post">
      <div class="form-row">
        <!--Nombre Usuario-->
        <div class="form-group col-md-6">
          <label for="usuario">Usuario</label>
          <input name="usuario" type="text" value="<?php echo $this->usuario->usuario; ?>" class="form-control" id="usuario" required>
        </div>
        <!--Nombre Usuario-->
        <div class="form-group col-md-6">
          <label for="nombre_usuario">Nombre del Usuario</label>
          <input name="nombre_usuario" type="text" value="<?php echo $this->usuario->nombre_usuario; ?>" class="form-control" id="nombre_usuario" required>
        </div>
        <!--Clave-->
        <div class="form-group col-md-6">
          <label for="clave">Clave</label>
          <input name="clave" type="password" class="form-control" id="clave" value="<?php echo $this->usuario->clave; ?>" required>
        </div>

        <!--Estado-->
        <div class="form-group col-md-6">
          <label for="estado">Estado</label>
          <select name="estado" id="estado" class="form-control" required>
            <option value="<?php echo $this->usuario->estado; ?>"><?php echo $this->usuario->estado; ?></option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
            <option value="suspendido">Suspendido</option>
          </select>
        </div>
      <div class="col-12">

        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
<?php require 'views/footer.php';?>
