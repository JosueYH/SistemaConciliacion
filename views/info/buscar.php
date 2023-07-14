<!--VISTA PARA BUSCAR...-->
<div class="row">
  <h6 class="m-2 font-weight-bold text-primary col-6">Consulta de Registros</h6>
  <!-- Nav Item - Search Dropdown-->
  <div class="col-5 justify-content-md-end">
  </div>
  <a  style="width:5%;" class="nav-link dropdown-toggle" href="<?php echo constant('URL'); ?>" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-search fa-fw"></i>
  </a>
  <!-- Dropdown - Messages -->
  <div class="dropdown-menu dropdown-menu p-3 shadow " aria-labelledby="searchDropdown">
      <!--FORMULARIO -> va a recojer los url de quien lo llame-->
      <form  action="<?php echo $url ?>" method="post" class="form-inline mr-auto w-100 navbar-search" id="formulario">
          <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small filtrador" data-table="order-table" placeholder="Buscar el Registro" aria-label="Search" aria-describedby="basic-addon2" name="buscado" id="search">
              <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">
                      <i class="fas fa-search fa-sm"></i>
                  </button>
              </div>
          </div>
      </form>
  </div>
</div>
