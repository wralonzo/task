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
          <h2 class="text-center center-text">Actualizar Caso</h2>
          <div class="panel-body" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">
              <div class="container">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input type="hidden" name="usuario" id="usuario" value="<?= $_SESSION['idusuario']  ?>">
                    <label>Nombre</label>
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
$idtask = $_GET["id"];
?>

<script>
  $(document).ready(function() {

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

    var formData = new FormData();
    formData.append("idtask", Number(<?= $idtask ?>));
    fetch("<?= getBaseUrl() ?>/controllers/task.php?op=mostrar", {
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
        $("#descripcion").val(data.descripcion);
        $("#localidad").val(data.localidad);
        $("#tipo").val(data.tipo);
        $("#secretaria").val(data.secretaria);
        $("#fechavencimiento").val(data.fechavencimiento);
        $("#estado").val(data.estado);
      });

    $("#formulario").on("submit", function(e) {
      guardaryeditar(e);
    })

    function guardaryeditar(e) {
      console.log('funcion guardaryeditar');
      e.preventDefault(); //No se activará la acción predeterminada del evento
      $("#btnGuardar").prop("disabled", true);
      var formData = new FormData($("#formulario")[0]);
      formData.append("idtask", Number(<?= $idtask ?>));

      $.ajax({
        url: "<?= getBaseUrl() ?>/controllers/task.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
          console.log('datos: ', datos);
          if (datos == 3) {
            console.log(datos);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Caso actualizado',
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout(() => {
              $(location).attr("href", "<?= getBaseUrl() ?>/views/task");
            }, 3000);
          } else {
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