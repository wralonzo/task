<?php
require '../template/header.php';
if ($_SESSION['tracking'] != 1) {
	header("Location: " . getBaseUrl() . "/views/noacceso.php");
}
$id = $_GET["id"];
?>
<style>
	body {
		background: #e6e6e6;
		font-family: "Roboto", sans-serif;
		font-weight: 400;
	}

	/*===== Vertical Timeline =====*/
	#conference-timeline {
		position: relative;
		max-width: 920px;
		width: 100%;
		margin: 0 auto;
	}

	#conference-timeline .timeline-start,
	#conference-timeline .timeline-end {
		display: table;
		font-family: "Roboto", sans-serif;
		font-size: 18px;
		font-weight: 900;
		text-transform: uppercase;
		background: #00b0bd;
		padding: 15px 23px;
		color: #fff;
		max-width: 5%;
		width: 100%;
		text-align: center;
		margin: 0 auto;
	}

	#conference-timeline .conference-center-line {
		position: absolute;
		width: 3px;
		height: 100%;
		top: 0;
		left: 50%;
		margin-left: -2px;
		background: #00b0bd;
		z-index: -1;
	}

	#conference-timeline .conference-timeline-content {
		padding-top: 67px;
		padding-bottom: 67px;
	}

	.timeline-article {
		width: 100%;
		height: 100%;
		position: relative;
		overflow: hidden;
		margin: 20px 0;
	}

	.timeline-article .content-left-container,
	.timeline-article .content-right-container {
		max-width: 44%;
		width: 100%;
	}

	.timeline-article .timeline-author {
		display: block;
		font-weight: 400;
		font-size: 14px;
		line-height: 24px;
		color: #242424;
		text-align: right;
	}

	.timeline-article .content-left,
	.timeline-article .content-right {
		position: relative;
		width: auto;
		border: 1px solid #ddd;
		background-color: #fff;
		box-shadow: 0 1px 3px rgba(0, 0, 0, .03);
		padding: 27px 25px;
	}

	.timeline-article p {
		margin: 0 0 0 60px;
		padding: 0;
		font-weight: 400;
		color: #242424;
		font-size: 14px;
		line-height: 24px;
		position: relative;
	}

	.timeline-article p span.article-number {
		position: absolute;
		font-weight: 300;
		font-size: 44px;
		top: 10px;
		left: -60px;
		color: #00b0bd;
	}

	.timeline-article .content-left-container {
		float: left;
	}

	.timeline-article .content-right-container {
		float: right;
	}

	.timeline-article .content-left:before,
	.timeline-article .content-right:before {
		position: absolute;
		top: 20px;
		font-size: 23px;
		font-family: "FontAwesome";
		color: #fff;
	}

	.timeline-article .content-left:before {
		content: "\f0da";
		right: -8px;
	}

	.timeline-article .content-right:before {
		content: "\f0d9";
		left: -8px;
	}

	.timeline-article .meta-date {

		width: 62px;
		height: 62px;
		color: #fff;
		border-radius: 100%;
		background: #00b0bd;
	}

	.timeline-article .meta-date .date,
	.timeline-article .meta-date .month {
		display: block;
		text-align: center;
		font-weight: 900;
	}

	.timeline-article .meta-date .date {
		font-size: 30px;
		line-height: 40px;
	}

	.timeline-article .meta-date .month {
		font-size: 18px;
		line-height: 10px;
	}

	/*===== // Vertical Timeline =====*/

	/*===== Resonsive Vertical Timeline =====*/
	@media only screen and (max-width: 830px) {

		#conference-timeline .timeline-start,
		#conference-timeline .timeline-end {
			margin: 0;
		}

		#conference-timeline .conference-center-line {
			margin-left: 0;
			left: 50px;
		}

		.timeline-article .content-left-container,
		.timeline-article .content-right-container {
			max-width: 100%;
			width: auto;
			float: none;
			margin-left: 110px;
			min-height: 53px;
		}

		.timeline-article .content-left-container {
			margin-bottom: 20px;
		}

		.timeline-article .content-left,
		.timeline-article .content-right {
			padding: 10px 25px;
			min-height: 65px;
		}

		.timeline-article .content-left:before {
			content: "\f0d9";
			right: auto;
			left: -8px;
		}

		.timeline-article .content-right:before {
			display: none;
		}
	}

	@media only screen and (max-width: 400px) {
		.timeline-article p {
			margin: 0;
		}

		.timeline-article p span.article-number {
			display: none;
		}

	}

	/*===== // Resonsive Vertical Timeline =====*/
</style>
<div class="panel-header panel-header-lg text-white">
</div>
<div class="content" style="margin-top: -300px !important;">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-chart">
				<div class="card-header">
					<div class="container">
						<div class="center-text text-center container">
							<h1>Adjuntos del caso</h1>
						</div>

						<div class=" panel-body table-responsive center-text text-center " id=" listadoregistros" style="margin-top: 20px !important;">
							<table id="tbllistado" class="table table-bordered table-hover">
								<thead>
									<th>ACCIONES</th>
									<th>ID</th>
									<th>NOMBRE</th>
									<th>CASO</th>
									<th>FECHA</th>
								</thead>
								<tbody>
								</tbody>
								<tfoot>
									<th>Opciones</th>
									<th>ID</th>
									<th>NOMBRE</th>
									<th>CASO</th>
									<th>FECHA</th>
								</tfoot>
							</table>
						</div>
						<!-- Vertical Timeline -->

						<div class="center-text text-center container">
							<h1>Actividad del caso</h1>
						</div>
						<section id="conference-timeline">
							<div class="conference-center-line"></div>
							<div class="conference-timeline-content">
								<!-- Article -->
								<div id="htmlinsert">

								</div>

								<!-- // Article -->
							</div>
						</section>
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
<script>
	function desactivar(id) {
		var formData = new FormData();
		formData.append("id", id);
		$.ajax({
			url: "<?= getBaseUrl() ?>/controllers/adjunto.php?op=desactivar",
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
						title: 'Archivo eliminado',
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(delayedFunction, 2000);

				} else {
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Archivo no eliminado',
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	}
	$(document).ready(function() {
		var formData = new FormData();
		formData.append("idtask", <?= $id ?>);
		fetch("<?= getBaseUrl() ?>/controllers/task.php?op=bitacora", {
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
				for (var i = 0; i < data.length; i++) {
					let htmlInsert = '<div class="timeline-article">';
					htmlInsert += '<div class="content-left-container">';
					htmlInsert += '<div class="content-left">';
					htmlInsert += '<span class="date" id="fecha">' + data[i].datecreated + '</span>';
					htmlInsert += '<p> ' + data[i].accion + '<span class="article-number" id="contador">' + (i + 1) + '</span></p>';
					htmlInsert += '</div>';
					htmlInsert += '</div>';
					htmlInsert += '</div>';
					htmlInsert += '<span class="timeline-author">' + data[i].nombre + '</span>';
					htmlInsert += '</div>';
					htmlInsert += '</div>';
					$("#htmlinsert").append(htmlInsert);
				}
			});

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
				url: '<?= getBaseUrl() ?>/controllers/adjunto.php?op=filestask&idtask=<?= $id ?>',
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
	});
</script>