<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Restablecer Contraseña</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/now-ui-dashboard.css?v=1.5.0" />
</head>

<body class="user-profile" style="background-image: url('./assets/img/portada.png'); background-repeat: no-repeat; background-size: cover;">
    <div class="wrapper">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Restablecer Contraseña</h3>
                            <h5>Necesitamos validar tus datos</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" id="frmResetPassword">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Ingresa tu usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Ingresa tu correo</label>
                                    <input type="text" class="form-control" id="correo" name="correo" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/js/core/jquery.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/sweetalert2@9.js"></script>
    <script>
        $("#frmResetPassword").on('submit', function(e) {
            e.preventDefault();

            var usuario = $("#usuario").val();
            var correo = $("#correo").val();

            // Enviar la solicitud de restablecimiento de contraseña
            $.post("./controllers/login.php?op=resetpassword", {
                    "usuario": usuario,
                    "correo": correo
                },
                function(data) {
                    const response = JSON.parse(data);
                    console.log(response.success);
                    if (response.success) {
                        Swal.fire("Éxito", "Por favor revisa tu correo para obtner tu nueva contraseña", "success").then(function() {
                            window.location.href = "./";
                        });
                    } else {
                        Swal.fire("Error", response.error || "Los datos ingresados no son validos", "error");
                    }
                });
        });
    </script>
</body>

</html>