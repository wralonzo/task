<?php
require '../template/header.php';
if ($_SESSION['case'] != 1) {
	header("Location: " . getBaseUrl() . "/views/noacceso.php");
}
?>
<style>
	.container-header {
		font-size: 1.5em;
		color: #fff;
		background-image: none;
		background-color: rgba(255, 255, 255, 0.5);
	}

	.imagelogo {
		background-image: url('../../assets/img/task.jpg');
		background-repeat: no-repeat;
		background-size: cover;
		background-color: rgba(255, 255, 255, 0);

	}

	.dataTables_filter label {
		color: black;
		opacity: 0.8;
	}

	.table thead tr th {
		color: black !important;
		opacity: 0.8 !important;
	}

	.panel-header-text {
		color: black !important;
		font-weight: bold;
	}
</style>

<div class="panel-header panel-header-lg text-white">
</div>
<div class="content" style="margin-top: -300px !important;">
	<div class="imagelogo col-lg-12">
		<div class="card-chart container-header">
			<div class="card-header">
				<div class=" container-header">
					<center>
						<div class="row" style="display: flex; justify-content: space-between;">
							<div class="col-lg-4">
								<img width="30%" src="../../assets/img/dic.png" alt="PNC" style="margin-top: 10px;">
							</div>
							<div class="col-lg-4">
								<h3>Listado de casos</h3>
							</div>
							<div class="col-lg-4">
								<img width="45%" src="../../assets/img/pnc.png" alt="PNC">
							</div>
						</div>
					</center>
					<div>
						<?php
						if ($_SESSION['rol'] != 3): ?>
							<a class="btn btn-success" href="<?= getBaseUrl() ?>/views/task/insert.php"> <i class="now-ui-icons ui-1_simple-add"></i></a>
						<?php endif; ?>
					</div>
					<div class="panel-header-text panel-body table-responsive center-text text-center" id="listadoregistros" style="font-size: 12px; margin-top: 20px;">
						<table id="tbllistado" class="table table-bordered table-hover panel-header-text">
							<thead style="font-size: 10px;">
								<th><strong>ACCIONES</strong></th>
								<th><strong>AUXILIAR A CARGO</strong></th>
								<th><strong>DESCRIPCION</strong></th>
								<th><strong>ASIGNADO</strong></th>
								<th><strong>LOCALIDAD</strong></th>
								<th><strong>CATEGORIA</strong></th>
								<th><strong>FECHA VENCIMIENTO</strong></th>
								<th><strong>ESTADO</strong></th>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php
require '../template/footer.php';
?>

<script type="text/javascript">
	function delayedFunction() {
		$(location).attr("href", "<?= getBaseUrl() ?>/views/task");
	}

	function desactivar(id) {
		var formData = new FormData();
		formData.append("idtask", id);
		formData.append("usuario", <?= $_SESSION['idusuario']  ?>);
		$.ajax({
			url: "<?= getBaseUrl() ?>/controllers/task.php?op=desactivar",
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
						title: 'Caso eliminado',
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(delayedFunction, 2000);

				} else {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Caso no eliminado',
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	}

	$(document).ready(function() {
		$('#tbllistado').dataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			responsive: true,
			"scrollX": true,
			"aProcessing": true,
			"aServerSide": true,
			dom: 'Bfrtip',
			lengthMenu: [
				[5, 10, 25, 50, -1],
				['5 filas', '10 filas', '25 filas', '50 filas', 'Mostrar todo']
			],
			buttons: [{
					extend: 'pageLength',
					text: 'Items',
				},
				{
					extend: 'print',
					text: 'Imprimir',
					title: 'Usuarios',
					exportOptions: {
						columns: function(idx, data, node) {
							return idx !== 0;
						}
					},
				},
				{
					extend: 'pdf',
					text: 'DESCARGAR PDF',
					title: 'Usuarios BYTE SEVEN',
					exportOptions: {
						// Exclude the first row from export
						rows: function(idx, data, node) {
							return idx !== 0; // Exclude row with index 0
						}
					},
				},
			],
			"ajax": {
				url: '<?= getBaseUrl() ?>/controllers/task.php?op=listar',
				type: "get",
				dataType: "json",
				error: function(e) {
					console.log(e.responseText);
				}
			},
			"bDestroy": true,
			"iDisplayLength": 20,
			"order": [
				[0, "desc"]
			],
			language: {
				zeroRecords: 'No hay registros para mostrar.',
				info: "Mostrando página _PAGE_ de _PAGES_ páginas",
				search: 'Buscar',
				emptyTable: 'La tabla está vacia.',
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Ultimo",
					"sNext": "Siguiente",
					"sPrevious": "Anterior",
				}
			}
		}).DataTable();



		function activar(id) {
			$.ajax({
				url: "<?= getBaseUrl() ?>/controllers/login.php?op=desactivar",
				type: "POST",
				data: {
					idusuario: id
				},
				contentType: false,
				processData: false,
				success: function(datos) {
					if (datos == 1) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Usuario eliminado',
							showConfirmButton: false,
							timer: 1500
						});
						$(location).attr("href", "<?= getBaseUrl() ?>/views/user");
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Usuario no eliminado',
							showConfirmButton: false,
							timer: 1500
						});
					}
				}

			});
		}
	});
</script>

</body>

</html>