<html id="login" lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>COOPROTEXRI</title>

    <link rel="icon" href="<?php echo constant('URL');?>public/img/cooprotexri-logo.png">
    <!-- Custom fonts for this template-->
    <!--ICONO-->
    <link href="<?php echo constant('URL'); ?>public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
 <!--iconos-->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo constant('URL'); ?>public/css/sb-admin-2.min.css" rel="stylesheet">


</head>
<body>
    <main role="main" class="container my-auto">
        <div class="row">
            <div id="login" class="col-lg-4 offset-lg-4 col-md-6 offset-md-3
                col-12">

                <img class="rounded-circle" width= "100%" height= "auto" src="<?php echo constant('URL'); ?>public/img/cooprotexri-logo.png">

                <form id="formulario_login">

                <div class="form-group">
                        <label for="usuario">Nombre Usuario</label>
                        <input id="usuario" name="usuario"
                            class="form-control" type="text"
                            placeholder="Nombre de Usuario" required>
                </div>
                <div class="form-group">
                        <label for="clave">Clave de Usuario</label>
                        <input id="clave" name="clave"
                            class="form-control" type="password"
                            placeholder="Contraseña" required>
                    </div>
                  <div id="response">

                  </div>

                    <button id="enviar" type="submit" class="btn btn-primary col-12" >
                        Entrar
                    </button>

                  </form>
            </div>
        </div>
    </main>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo constant('URL'); ?>libs/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo constant('URL'); ?>libs/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo constant('URL'); ?>libs/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo constant('URL'); ?>libs/js/sb-admin-2.min.js"></script>

    <script src="<?php echo constant('URL'); ?>libs/js/login.js"></script>
    </body>
</html>
