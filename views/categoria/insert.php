<?php
require '../template/header.php';
if ($_SESSION['categoria'] != 1) {
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
          <h2>Ingresar Categoria</h2>
          <div class="panel-body" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">
              <div class="container">
                <div class="row">
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
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
      $("#btnGuardar").prop("disabled", true);
      var formData = new FormData($("#formulario")[0]);

      $.ajax({
        url: "<?= getBaseUrl() ?>/controllers/categoria.php?op=guardaryeditar",
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
              title: 'Categoria registrada',
              showConfirmButton: false,
              timer: 1500
            });
            $("#btnGuardar").prop("disabled", false);
            setTimeout(() => {
              $(location).attr("href", "<?= getBaseUrl() ?>/views/categoria");
            }, 2000);
          } else {
            console.log(datos);
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'No se pudo registrar',
              showConfirmButton: false,
              timer: 1500
            })
          }
        }

      });
    }
  });
</script>