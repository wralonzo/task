<?php
require '../template/header.php';
if ($_SESSION['user'] != 1) {
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

	.imagelogo {
		background-image: url('../../assets/img/task.jpg');
		background-repeat: no-repeat;
		background-size: cover;
		background-color: rgba(255, 255, 255, 0);

	}
</style>
<div class="panel-header panel-header-lg text-white">
</div>
<div class="content" style="margin-top: -300px !important;">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-chart">
				<div class="card-header imagelogo">
					<div class="container container-header">
						<center>
							<div class="row" style="display: flex; justify-content: space-between;">
								<div class="col-lg-4">
									<img width="30%" style="margin-top: 10px;" src="../../assets/img/dic.jpg" alt="PNC">
								</div>
								<div class="col-lg-4">
									<h2>Listado de Usuarios</h2>
								</div>
								<div class="col-lg-4">
									<img width="45%" src="../../assets/img/pnc.png" alt="PNC">
								</div>
							</div>
						</center>
						<div class="container">
							<div>
								<a class="btn btn-success" href="<?= getBaseUrl() ?>/views/user/insert.php"> <i class="now-ui-icons ui-1_simple-add"></i></a>
							</div>
							<div class="panel-header-text  panel-body table-responsive center-text text-center " id=" listadoregistros" style="margin-top: 20px !important;">
								<table id="tbllistado" class="table table-bordered table-hover">
									<thead>
										<th>ACCIONES</th>
										<th>NOMBRE</th>
										<th>TELEFONO</th>
										<th>E-MAIL</th>
										<th>USER</th>
										<th>FOTO</th>
									</thead>
									<tbody>
									</tbody>
									<tfoot>
										<th>Opciones</th>
										<th>Nombre</th>
										<th>Teléfono</th>
										<th>Email</th>
										<th>Login</th>
										<th>Foto</th>
									</tfoot>
								</table>
							</div>
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
		$(location).attr("href", "<?= getBaseUrl() ?>/views/user");
	}

	function desactivarUsuario(id) {
		var formData = new FormData();
		formData.append("idusuario", id);
		$.ajax({
			url: "<?= getBaseUrl() ?>/controllers/login.php?op=desactivar",
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
						title: 'Usuario eliminado',
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(delayedFunction, 2000);

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
					title: 'Usuarios'
				},
				{
					extend: 'pdf',
					text: 'DESCARGAR PDF',
					title: 'Usuarios BYTE SEVEN'
				},
			],
			"ajax": {
				url: '<?= getBaseUrl() ?>/controllers/login.php?op=listar',
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