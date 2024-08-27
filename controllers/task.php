<?php


try {
    session_start();
    require_once "../models/Task.php";
    require '../config/baseurl.php';
    $task = new Task();

    $idtask = isset($_POST["idtask"]) ? limpiarCadena($_POST["idtask"]) : "";
    $nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
    $descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
    $localidad = isset($_POST["localidad"]) ? limpiarCadena($_POST["localidad"]) : "";
    $usuario = isset($_POST["usuario"]) ? limpiarCadena($_POST["usuario"]) : "";
    $tipo = isset($_POST["tipo"]) ? limpiarCadena($_POST["tipo"]) : "";
    $secretaria = isset($_POST["secretaria"]) ? limpiarCadena($_POST["secretaria"]) : "";
    $estado = isset($_POST["estado"]) ? limpiarCadena($_POST["estado"]) : "";
    $fechavencimiento = isset($_POST["fechavencimiento"]) ? limpiarCadena($_POST["fechavencimiento"]) : "";
    $imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";

    switch ($_GET["op"]) {
        case 'guardaryeditar':
            if (empty($idtask)) {
                try {
                    $rspta = $task->insertar($nombre, $descripcion, $usuario, $localidad, $secretaria, $tipo, $estado, $fechavencimiento);
                    $directorio = '../files/task/' . "$rspta";
                    $ext = explode(".", $_FILES["imagen"]["name"]);
                    if (end($ext) != '') {
                        $imagen = round(microtime(true)) . '.' . end($ext);
                        mkdir($directorio, 0777);
                        move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/task/" . $rspta . "/" . $imagen);
                        $task->insertarFile($imagen, $rspta, $usuario);
                    }

                    echo $rspta != 0 ? 1 : 2;
                } catch (Exception $e) {
                    echo 2;
                }
            } else {
                $rspta = $task->editar($idtask, $nombre, $descripcion, $localidad, $secretaria, $tipo, $fechavencimiento, $estado, $usuario);
                echo $rspta ? 3 : 4;
            }
            break;

        case 'desactivar':
            $rspta = $task->desactivar($idtask, $usuario);
            echo $rspta ? 1 : 0;
            break;
        case 'mostrar':
            $rspta = $task->mostrar($idtask);
            //Codificar el resultado utilizando json
            echo json_encode($rspta);
            break;
        case 'secretarias':
            $rspta = $task->mostrarSecretaria();
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                array_push($data, $reg);
            }
            echo json_encode($data);
            break;
        case 'bitacora':
            $rspta = $task->bitacora($idtask);
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
                $categoria = $task->mostrarCategoria($reg->tipo);
                $usuarioAss = $task->mostrarUsuario($reg->secretaria);
                $rolShow = $_SESSION['rol'] != 3 ? ' <button style="width: 5px;" class="btn btn-danger" onclick="desactivar(' . $reg->idtask . ')"><i class="now-ui-icons ui-1_simple-remove"></i></button>' : '';
                // var_dump($categoria);
                $data[] = array(
                    "0" =>
                    ' <a style="width: 5px;" class="btn btn-primary" href="' . getBaseUrl() . '/views/task/edit.php?id=' . $reg->idtask . '"><i class="now-ui-icons arrows-1_share-66"></i></a>' .
                        $rolShow .
                        '<a style="width: 5px; margin-top: 5px;" class="btn btn-dark" href="' . getBaseUrl() . '/views/files/upload.php?id=' . $reg->idtask . '"><i class="now-ui-icons arrows-1_cloud-upload-94"></i></a>',
                    "1" => '<a title="Historial" href="' . getBaseUrl() . '/views/tracking?id=' . $reg->idtask . '">' . $reg->nombre . '</i></a>',
                    "2" => $reg->descripcion,
                    "3" => $usuarioAss['nombre'] ?? '',
                    "4" => $reg->localidad,
                    "5" => $categoria['nombre'] ?? '',
                    "6" => $reg->fechavencimiento,
                    "7" => $reg->estado,
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
