<?php


try {
    session_start();
    require_once "../models/Categoria.php";
    require '../config/baseurl.php';
    $task = new Categoria();

    $id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
    $nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";

    switch ($_GET["op"]) {
        case 'guardaryeditar':
            if (empty($id)) {
                try {
                    $rspta = $task->insertar($nombre);
                    echo $rspta != 0 ? 1 : 2;
                } catch (Exception $e) {
                    echo 2;
                }
            } else {
                $rspta = $task->editar($id, $nombre);
                echo $rspta ? 3 : 4;
            }
            break;

        case 'desactivar':
            $rspta = $task->desactivar($id);
            echo $rspta ? 1 : 0;
            break;
        case 'mostrar':
            $rspta = $task->mostrar($id);
            //Codificar el resultado utilizando json
            echo json_encode($rspta);
            break;
        case 'all':
            $rspta = $task->listar();
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                array_push($data, $reg);
            }
            echo json_encode($data);
            break;
        case 'listar':
            $rspta = $task->listar();
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(
                    "0" =>
                    ' <a class="btn btn-primary" href="' . getBaseUrl() . '/views/categoria/edit.php?id=' . $reg->id . '"><i class="now-ui-icons arrows-1_share-66"></i></a>' .
                        ' <button class="btn btn-danger" onclick="desactivar(' . $reg->id . ')"><i class="now-ui-icons ui-1_simple-remove"></i></button>',
                    "1" => $reg->id,
                    "2" => $reg->nombre
                );
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            echo json_encode($results);

            break;
    }
} catch (Exception $e) {
    var_dump($e);
}
