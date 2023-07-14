<?php require 'views/header.php'; //para el cambio de clave?>
<div class="text-center">
  <img style="width:35%;" src="https://image.flaticon.com/icons/png/512/149/149071.png" class="img-profile rounded-circle" alt="...">
  <h5 class="card-title">Usuario</h5>
  <p class="card-text"><?php echo $_SESSION['nombre_usuario'] ?></p>
  <form id="formulario_newkey">
      <div class="form-row">
        <div class="form-group col-12">
          <label for="clave" class="" style="font-size:20px;">Cambiar Clave
              <input name="clave" type="password" class="form-control" id="clave" value="<?php echo $_SESSION['clave']; ?>" required>
          </label>
          <div id="response">
          </div>
          </div>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <hr>
    </form>
    <div>
      <a class="card-link" href="" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Cerrar Cuenta
      </a>
      <a href="<?php echo constant('URL') ?>" class="card-link">Inicio de La Página</a>
    </div>
    <hr>

  </div>

<?php require 'views/footer.php'; ?>
