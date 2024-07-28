<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Acceso al sistema...</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .bg {
            background-image: url('assets/img/fondo1.jpg'); 
            background-size: cover; 
            background-repeat: no-repeat;
            background-position: center; 
            height: 100vh; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .card {
            background-color: #F9EDFF; 
        }

        .form-container {
            max-width: 500px; 
            width: 100%; 
        }

        .login-image {
            text-align: center;
            margin: 20px 0; 
        }

        .login-image img {
            max-width: 150px; 
            height: auto; 
            border-radius: 50%; 
            border: 3px solid #fff; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }
    </style>
</head>

<body class="bg">

    <div class="container form-container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Inicio de Sesion</h1>
                                    </div>
                                    <div class="login-image">
                                        <img src="assets/img/fotousuario.png" alt="login" class="img-fluid">
                                    </div>
                                    <form class="user" method="post" action="index.php?c=usuario&a=valida">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" name="usuario"
                                                placeholder="Ingrese Usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" name="password" placeholder="Ingrese Password">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" style="background-color: #B8A4E1; color: #000; border: 2px solid #B8A4E1;" value="Ingresar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>
</html>
