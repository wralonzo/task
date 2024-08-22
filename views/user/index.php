<?php
require '../template/header.php';
?>
<div class="panel-header panel-header-lg text-white">
</div>
<div class="content" style="margin-top: -300px !important;">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="container">
                        <div class="center-text text-center container">
                            <h1>Listado de Usuarios</h1>
                        </div>
                        <div>
                            <a class="btn btn-success" href="<?= getBaseUrl() ?>/views/user/insert.php"> <i class="now-ui-icons ui-1_simple-add"></i></a>
                        </div>
                        <div class=" panel-body table-responsive center-text text-center " id=" listadoregistros" style="margin-top: 20px !important;">
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
<?php
require '../template/footer.php';
?>

<script>
    $('#tbllistado').dataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        responsive: true,
        "scrollX": true,
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
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
                text: 'IMPRIMIR',
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
        "iDisplayLength": 20, //Paginación
        "order": [
            [0, "desc"]
        ], //Ordenar (columna,orden)
        language: {
            zeroRecords: 'No hay registros para mostrar.',
            info: "Mostrando página _PAGE_ de _PAGES_ páginas",
            search: 'BUSCAR',
            emptyTable: 'La tabla está vacia.',
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior",
            }
        }
    }).DataTable();
</script>