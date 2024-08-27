<?php
require '../template/header.php';
if ($_SESSION['case'] != 1) {
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
          <h2 class="text-center center-text">Registrar Caso</h2>
          <div class="panel-body" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">
              <div class="container">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label>Nombre</label>
                    <input type="hidden" name="usuario" id="usuario" value="<?= $_SESSION['idusuario']  ?>">
                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Localidad</label>
                    <input type="text" class="form-control" name="localidad" id="localidad" maxlength="200" placeholder="Localidad">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Tipo de caso</label>
                    <select name="tipo" id="tipo" class="form-control">
                      <option value="0" selected>Seleccione un tipo</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Asignar caso a investigador</label>
                    <select name="secretaria" id="secretaria" class="form-control">
                      <option value="0" selected>Seleccione una investigador</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha vencimiento</label>
                    <input type="date" class="form-control" name="fechavencimiento" id="fechavencimiento" placeholder="Fecha vencimiento" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Rol</label>
                    <select name="estado" id="estado" class="form-control">
                      <option selected>Seleccione un estado</option>
                      <option value="Ingresado" selected>Ingresado</option>
                      <option value="Pendiente">Pendiente</option>
                      <option value="Completado">Completado</option>
                      <option value="Progreso">Progreso</option>
                      <option value="Detenido">Detenido</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Subir adjunto</label>
                      <input type="file" class="form-control-file" name="imagen" id="exampleInputFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Click para seleccionar adjunto.</small>
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
?>
<script>
  $(document).ready(function() {
    $("#formulario").on("submit", function(e) {
      guardaryeditar(e);
    })

    function guardaryeditar(e) {
      console.log('funcion guardaryeditar');
      e.preventDefault(); //No se activará la acción predeterminada del evento
      // $("#btnGuardar").prop("disabled", true);
      var formData = new FormData($("#formulario")[0]);

      $.ajax({
        url: "<?= getBaseUrl() ?>/controllers/task.php?op=guardaryeditar",
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
              title: 'Caso registrado',
              showConfirmButton: false,
              timer: 1500
            });
            $("#btnGuardar").prop("disabled", false);
            setTimeout(() => {
              $(location).attr("href", "<?= getBaseUrl() ?>/views/task");
            }, 2000);

          } else if (datos == 3) {
            console.log(datos);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Caso actualizado',
              showConfirmButton: false,
              timer: 1500
            })
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
        },
        error: function(error) {
          console.log(error);
        }

      });
    }

    $.get("<?= getBaseUrl() ?>/controllers/task.php?op=secretarias", function(data) {
      data = JSON.parse(data);
      for (let i = 0; i < data.length; i++) {
        $('#secretaria').append(new Option(data[i].nombre, data[i].idusuario));
      }
    });

    $.get("<?= getBaseUrl() ?>/controllers/categoria.php?op=all", function(data) {
      data = JSON.parse(data);
      for (let i = 0; i < data.length; i++) {
        $('#tipo').append(new Option(data[i].nombre, data[i].id));
      }
    });
  });
</script>

</body>

</html>