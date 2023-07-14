<!--VIEW DE CLIENTE PARA EL RESPECTIVO UPDATE DEL MISMO-->
<?php require 'views/header.php';?>
<!--crud de registro de cliente-->
  <div style="padding: 0px 20px; "class="card shadow mb-1">
    <div class="card-header py-5">
<!--diseño de encabezado!-->
      <h6 class="m-2 font-weight-bold text-primary">Ver cliente: <?php echo $this->cliente->nombre; ?></h6>
    </div>
    <?php
    //mensaje
      if (!empty($this->mensaje)){
        echo $this->mensaje ;
      }
    ?>

    <form  action="<?php echo constant('URL');?>consultarcliente/actualizarCliente" method="post">
      <div class="form-row">
        <!--cedula_ruc-->
          <div class="form-group col-md-5">
          <label for="cedula_ruc">Cedula del Cliente</label>
          <input name="cedula_ruc" type="text" value="<?php echo $this->cliente->cedula_ruc; ?>" class="form-control" id="producto" required>
        </div>
        <!--nombre-->
        <div class="form-group col-md-5">
          <label for="nombre">Nombre del Cliente</label>
          <input name="nombre" type="text" value="<?php echo $this->cliente->nombre; ?>" class="form-control" id="producto" required>
        </div>
        <!--correo-->
        <div class="form-group col-md-5">
          <label for="correo">Correo</label>
          <input name="correo" type="email" class="form-control" id="correo" value="<?php echo $this->cliente->correo; ?>" required>
        </div>
        <!--celular-->
        <div class="form-group col-md-5">
          <label for="celular">Celular</label>
          <input name="celular"  type="text" class="form-control" id="celular" value="<?php echo $this->cliente->celular; ?>" required>
        </div>
        <!--telefono-->
        <div class="form-group col-md-5">
          <label for="telefono">Teléfono</label>
          <input name="telefono"  type="text" class="form-control" id="telefono" value="<?php echo $this->cliente->telefono; ?>" required>
        </div>
        <!--Estado-->
        <div class="form-group col-md-5">
          <label for="estado">Estado</label>
          <select name="estado" id="estado" class="form-control" required>
            <option value="<?php echo $this->cliente->estado; ?>"><?php echo $this->cliente->estado; ?></option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
            <option value="suspendido">Suspendido</option>
          </select>
        </div>
        <!--tipo_cliente-->
        <div class="form-group col-md-5">
          <label for="tipo_cliente">Tipo de Persona</label>
          <select class="form-control" name="tipo_cliente" required>
            <option value="<?php echo $this->cliente->tipo_cliente ?>">Elija un Tipo de Persona</option>
            <option value="natural">Persona Natural</option>
            <option value="juridica">Persona Juridica</option>
          </select>
        </div>
        <!--direccion-->
        <div class="form-group col-12">
          <label for="direccion">Direccion</label>
          <textarea name="direccion" rows="8" class="form-control" id="direccion" cols="50" required><?php echo $this->cliente->direccion; ?></textarea>
        </div>

      <div class="form-group col-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
<?php require 'views/footer.php';?>
