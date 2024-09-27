<?php


try {
    session_start();
    require_once "../models/Adjunto.php";
    require_once "../models/Task.php";
    require '../config/baseurl.php';
    $file = new Adjunto();

    $id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
    $rol = $_SESSION['rol'] == 3 ? true : false;

    switch ($_GET["op"]) {
        case 'uploadFile':
            $idtask = $_POST["idtask"];
            $task = new Task();

            $directorio = '../files/task/' . "$idtask";
            $ext = explode(".", $_FILES["imagen"]["name"]);
            $nombreArchivo = $_FILES["imagen"]["name"];
            $rspta = 0;
            $usuario = $_SESSION['idusuario'];
            if (end($ext) != '') {
                $imagen = $nombreArchivo;
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777);
                }
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio . "/" . $imagen);
                $rspta = $task->insertarFile($imagen, $idtask, $usuario);
            }
            echo $rspta != 0 ? 1 : 2;
            break;
        case 'desactivar':
            $dataFile = $file->mostrarFile($id);
            $path =  '../files/task/' . $dataFile['idtask'] . '/' . $dataFile['nombre'];
            // var_dump($_SERVER['DOCUMENT_ROOT']);
            chmod($path, 0777);
            if (file_exists($path)) {
                $delFile = unlink($path);
                if ($delFile) {
                    $rspta = $file->desactivar($id);
                    echo $rspta ? 1 : 0;
                    break;
                }
            }
            echo 0;

            break;
        case 'filestask':
            $idTask = $_GET['idtask'];
            $data = array();
            $rspta = $file->mostrarTask($idTask);
            $contador = 1;
            while ($reg = $rspta->fetch_object()) {
                $date = new DateTime($reg->fechavencimiento);
                $data[] = array(
                    "0" =>
                    ' <a download target="_blank" class="btn btn-primary" href="' . getBaseUrl() . '/files/task/' . $reg->idtask . '/' . $reg->nombre . '"><i class="now-ui-icons files_box"></i></a>' .
                        ' <button class="btn btn-danger" onclick="desactivar(' . $reg->id . ')"><i class="now-ui-icons ui-1_simple-remove"></i></button>',
                    "1" => $contador,
                    "2" => $reg->nombre,
                    "3" => $contador,
                    "4" => $date->format('d/m/Y'),
                );
                $contador = $contador + 1;
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            echo json_encode($results);
            break;
        case 'listar':
            $dataTask = array();
            $idusuario = $_SESSION['idusuario'];
            $tasks = $file->listarTasks($idusuario);
            $data = array();
            while ($regt = $tasks->fetch_object()) {
                $dataTask[] = $regt->idtask;
            }
            $rspta = $file->listar($rol, $dataTask);
            $contador = 1;
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(
                    "0" =>
                    ' <a style="width: 10px;" download target="_blank" class="btn btn-primary" href="' . getBaseUrl() . '/files/task/' . $reg->idtask . '/' . $reg->nombre . '"><i class="now-ui-icons files_box"></i></a>' .
                        ' <button style="width: 10px;" class="btn btn-danger" onclick="desactivar(' . $reg->id . ')"><i class="now-ui-icons ui-1_simple-remove"></i></button>',
                    "1" => $contador,
                    "2" => $reg->nombre,
                    "3" => $contador,
                    "4" => $reg->datecreated,
                );
                $contador = $contador + 1;
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            echo json_encode($results);
            break;

        case 'count':
            $rspta = $file->countMonth();
            $valores = array();
            $response = array();
            while ($per = $rspta->fetch_object()) {
                array_push($valores, $per);
            }
            $meses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            foreach ($meses as $value) {
                $countMonth = 0;
                foreach ($valores as $value2) {
                    if ($value == $value2->month) {
                        $countMonth = intval($value2->user_count);
                    }
                }
                array_push($response, $countMonth);
            }
            echo json_encode($response);
            break;
    }
} catch (Exception $e) {
    var_dump($e);
}
