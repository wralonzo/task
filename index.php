<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/dic.jpg">
    <link rel="icon" type="image/png" href="./assets/img/dic.jpg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>SIGERMIP</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/release.min.css" crossorigin="anonymous">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="user-profile" style="background-image: url('./assets/img/portada.png');  background-repeat: no-repeat;background-size:cover;">
    <div class="wrapper">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">Inicio de sesión</div>
                        <div class="card-body">
                            <form method="post" id="frmAcceso">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Clave</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>
                                <div class="center-text text-center">
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <a href="reset_password.php" class="text-primary">¿Olvidaste tu contraseña?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/js/core/jquery.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="./assets/js/sweetalert2@9.js"></script>
    <script>
        $("#frmAcceso").on('submit', function(e) {
            e.preventDefault();
            logina = $("#username").val();
            clavea = $("#password").val();

            $.post("./controllers/login.php?op=verificar", {
                    "username": logina,
                    "password": clavea
                },
                function(data) {
                    if (data == 2) {
                        Swal.fire("Credenciales no válidas", "Por favor revise sus credenciales e intente de nuevo", "error");
                    } else {
                        $(location).attr("href", "./views");
                    }
                });
        });
    </script>
</body>

</html>