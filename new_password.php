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
                        </div>
                        <div class="card-body">
                            <form method="post" id="frmResetPassword">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Nueva Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
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

            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();

            if (password !== confirmPassword) {
                Swal.fire("Error", "Las contraseñas no coinciden", "error");
                return;
            }

            // Enviar la solicitud de restablecimiento de contraseña
            $.post("./controllers/login.php?op=newpassword", {
                    "password": password,
                    "token": "<?php echo $_GET['token']; ?>"
                },
                function(data) {
                    const response = JSON.parse(data)
                    console.log(response.success);
                    if (response.success) {
                        Swal.fire("Éxito", "Tu contraseña ha sido restablecida", "success").then(function() {
                            window.location.href = "./";
                        });
                    } else {
                        Swal.fire("Error", response.error || "No se pudo restablecer la contraseña, Token vencido", "error");
                    }
                });
        });
    </script>
</body>

</html>