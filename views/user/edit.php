<?php
require '../template/header.php';
if ($_SESSION['user'] != 1) {
  header("Location: " . getBaseUrl() . "/views/noacceso.php");
}
?>
<div class="panel-header panel-header-lg text-white">
</div>
<div class="content" style="margin-top: -300px !important;">
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-chart">
        <div class="card-header">
          <div class="center-text text-center">
            <h1>Editar usuario</h1>
          </div>
          <div class="panel-body" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">
              <div class="container">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Teléfono</label>
                    <input type="number" class="form-control" name="telefono" id="telefono" maxlength="20" placeholder="Teléfono">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Cargo</label>
                    <input type="text" class="form-control" name="cargo" id="cargo" maxlength="20" placeholder="Cargo">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Rol</label>
                    <select name="rol" id="rol" class="form-control">
                      <option selected>Seleccione una rol</option>
                      <option value="1">Admin</option>
                      <option value="2">Secretaria</option>
                      <option value="3">Investigador</option>
                    </select>
                  </div>

                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Usuario</label>
                    <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Usuario" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Permisos</label>
                    <div id="permisos">
                    </div>
                  </div>

                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Subir foto de perfil</label>
                      <input type="file" class="form-control-file" name="imagen" id="imagen" value="">
                      <input type="hidden" class="form-control-file" name="imagenactual" id="imagenactual" value="">
                      <small id="fileHelp" class="form-text text-muted">Click para seleccionar imagen.</small>
                      <div id="loadimage"></div>
                    </div>
                  </div>

                  <div class="center-text text-center container">
                    <button class="btn btn-primary mx-4" type="submit" id="btnGuardar"><i class="now-ui-icons arrows-1_minimal-right"></i> Guardar</button>
                    <!-- <button class="btn btn-danger mx-4" onclick="cancelarform()" type="button"><i class="now-ui-icons ui-1_simple-remove"></i> Cancelar</button> -->
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
require '../template/footer.php';
$idusuario = $_GET["id"];
?>

<script>
  $(document).ready(function() {
    var formData = new FormData();
    formData.append("idusuario", Number(<?= $idusuario ?>));
    fetch("<?= getBaseUrl() ?>/controllers/login.php?op=mostrar", {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        console.log(data);
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Cargando...',
          showConfirmButton: false,
          timer: 1500
        });

        $("#nombre").val(data.nombre);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
        $("#cargo").val(data.cargo);
        $("#login").val(data.login);
        $("#rol").val(data.rol);
        $("#imagenactual").val(data.imagen);
        const divElement = document.getElementById('loadimage');
        const fileData = '<img src="<?= getBaseUrl() ?>/files/usuarios/' + data.imagen + '">';
        divElement.innerHTML = fileData;

        const fileInput = document.querySelector('input[type="file"]');
        const myFile = new File(['mi archivo!'], '<?= getBaseUrl() ?>/files/usuarios/' + data.imagen, {
          lastModified: new Date(),
        });
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(myFile);
        fileInput.files = dataTransfer.files;



      });


    $.post("<?= getBaseUrl() ?>/controllers/login.php?op=permisos&id=<?= $idusuario ?>", {}, function(r) {
      $("#permisos").html(r);
    });

    $("#formulario").on("submit", function(e) {
      guardaryeditar(e);
    })

    function guardaryeditar(e) {
      console.log('funcion guardaryeditar');
      e.preventDefault();
      var formData = new FormData($("#formulario")[0]);
      formData.append("idusuario", Number(<?= $idusuario ?>));

      $.ajax({
        url: "<?= getBaseUrl() ?>/controllers/login.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
          console.log('datos: ', datos);
          if (datos == 1) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Usuario registrado',
              showConfirmButton: false,
              timer: 1500
            });
            $("#btnGuardar").prop("disabled", false);
            $(location).attr("href", "<?= getBaseUrl() ?>/views/user");
          } else if (datos == 3) {
            console.log(datos);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Usuario actualizado',
              showConfirmButton: false,
              timer: 1500
            })
            $(location).attr("href", "<?= getBaseUrl() ?>/views/user");
          } else if (datos == 2) {
            console.log(datos);
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'No se pudo registrar',
              showConfirmButton: false,
              timer: 1500
            })
          } else if (datos == 4) {
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'No se pudo actualizar',
              showConfirmButton: false,
              timer: 1500
            })
          }
        }

      });
    }

  });
</script>

</body>

</html>