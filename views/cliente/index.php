<!--VIEW DE CLIENTE PARA EL RESPECTIVO CREATE DEL MISMO-->
<?php require 'views/header.php';?>
<!--crud de registro de clientes-->
  <div style="padding: 0px 10px 20px 20px; "class="card shadow mb-1">
    <div class="card-header py-5">
<!--diseño de encabezado!-->
      <h6 class="m-2 font-weight-bold text-primary">Registro de Cliente</h6>
    </div>
    <div id="response">

    </div>
    <form id="formulario_cliente">
      <div class="form-row">
        <!--cedula_ruc-->
        <div class="form-group col-md-4">
            <label for="cedula_ruc">Cédula o Ruc</label>
            <input name="cedula_ruc" placeholder="Ingrese el numero de Cedula o RUC " type="text"  class="form-control" id="cedula_ruc" required>
            <div  id="alert">
            </div>
        </div>

        <!--nombre-->
        <div class="form-group col-md-4">
          <label for="nombre">Nombres y Apellidos</label>
          <input name="nombre" type="text" placeholder="Nombres y Apellidos"  class="form-control" id="nombre" required>
        </div>
        <!--correo-->
        <div class="form-group col-md-4">
          <label for="correo">Correo</label>
          <input name="correo" placeholder="ej: email@correo.ccc" type="email" class="form-control" id="correo" required>
        </div>
        <!--celular-->
        <div class="form-group col-md-4">
          <label for="celular">Celular</label>
          <input name="celular" placeholder="ej: 09xxxxx111 " type="text" class="form-control" id="celular"  required>
        </div>
        <!--telefono-->
        <div class="form-group col-md-4">
          <label for="telefono">Teléfono</label>
          <input name="telefono"  type="text" placeholder="ej: 05 25xxx90" class="form-control" id="telefono"  required>
        </div>
        <!--tipo_cliente-->
        <div class="form-group col-md-4">
          <label for="tipo_cliente">Tipo de Persona</label>
          <select class="form-control" id="tipo_cliente" name="tipo_cliente" required>
            <option value="">Elija un Tipo de Persona</option>
            <option value="natural">Persona Natural</option>
            <option value="juridica">Persona Juridica</option>
          </select>
        </div>
        <!--direccion-->
        <div class="form-group col-md-12">
          <label for="direccion">Dirección</label>
          <textarea name="direccion" placeholder="Ingresar la direccion del cliente" rows="4" class="form-control" id="direccion" cols="40" required></textarea>
        </div>
      <!--Botono Submit-->
      <div class="form-group col-12">
      <button type="submit" id="save" class="btn btn-primary">Guardar</button>
    </div>
    </form>
  </div>

<?php require 'views/footer.php';?>
