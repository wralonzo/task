<?php
session_start();
require_once "../models/Login.php";
require '../config/baseurl.php';

$usuario = new Login();

$idusuario = isset($_POST["idusuario"]) ? limpiarCadena($_POST["idusuario"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$cargo = isset($_POST["cargo"]) ? limpiarCadena($_POST["cargo"]) : "";
$login = isset($_POST["login"]) ? limpiarCadena($_POST["login"]) : "";
$rol = isset($_POST["rol"]) ? limpiarCadena($_POST["rol"]) : "";
$clave = isset($_POST["clave"]) ? limpiarCadena($_POST["clave"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $imagen = $_POST["imagenactual"];
        } else {
            $ext = explode(".", $_FILES["imagen"]["name"]);
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
                $imagen = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
            }
        }
        //Hash SHA256 en la contraseña
        $clavehash = hash("SHA256", $clave);

        if (empty($idusuario)) {
            $rspta = $usuario->insertar($nombre, $telefono, $email, $cargo, $login, $clavehash, $imagen, $_POST['permiso'], $rol);
            echo $rspta ? 1 : 2;
        } else {
            if ($imagen == "") {
                $imagen = $_POST["imagenactual"];
            }
            $rspta = $usuario->editar($idusuario, $nombre, $telefono, $email, $cargo, $login, $clavehash, $imagen, $_POST['permiso'], $rol);
            echo $rspta ? 3 : 4;
        }
        break;

    case 'desactivar':
        $rspta = $usuario->desactivar($idusuario);
        echo $rspta ? 1 : 0;
        break;

    case 'activar':
        $rspta = $usuario->activar($idusuario);
        echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
        break;

    case 'mostrar':
        $rspta = $usuario->mostrar($idusuario);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $usuario->listar();
        $data = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" =>
                ' <a class="btn btn-primary" href="' . getBaseUrl() . '/views/user/edit.php?id=' . $reg->idusuario . '"><i class="now-ui-icons arrows-1_share-66"></i></a>' .
                    ' <button class="btn btn-danger" onclick="desactivarUsuario(' . $reg->idusuario . ')"><i class="now-ui-icons ui-1_simple-remove"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->telefono,
                "3" => $reg->email,
                "4" => $reg->login,
                "5" => isset($reg->imagen) ?
                    "<img alt='No imagen' src='" . getBaseUrl() . "/files/usuarios/" . $reg->imagen . "' height='50px' width='50px' >" :
                    "<img alt='No imagen' src='" . getBaseUrl() . "/files/local/avatar.png' height='50px' width='50px' >",
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

    case 'permisos':
        //Obtenemos todos los permisos de la tabla permisos
        require_once "../models/Permiso.php";
        $permiso = new Permiso();
        $rspta = $permiso->listar();

        //Obtener los permisos asignados al usuario
        $id = $_GET['id'];
        $marcados = $usuario->listarmarcados($id);
        //Declaramos el array para almacenar todos los permisos marcados
        $valores = array();

        //Almacenar los permisos asignados al usuario en el array
        while ($per = $marcados->fetch_object()) {
            array_push($valores, $per->idpermiso);
        }

        //Mostramos la lista de permisos en la vista y si están o no marcados
        while ($reg = $rspta->fetch_object()) {
            $sw = in_array($reg->idpermiso, $valores) ? 'checked' : '';
            echo '<label class=" mx-4"> <input class="form-control" type="checkbox" ' . $sw . '  name="permiso[]" value="' . $reg->idpermiso . '" id="' . $reg->idpermiso . '">' . $reg->nombre . '</label>';
        }
        break;

    case 'verificar':
        $logina = $_POST['username'];
        $clavea = $_POST['password'];

        //Hash SHA256 en la contraseña
        $clavehash = hash("SHA256", $clavea);

        $rspta = $usuario->verificar($logina, $clavehash);

        $fetch = $rspta->fetch_object();

        if (isset($fetch)) {
            //Declaramos las variables de sesión
            $_SESSION['idusuario'] = $fetch->idusuario;
            $_SESSION['nombre'] = $fetch->nombre;
            $_SESSION['imagen'] = $fetch->imagen;
            $_SESSION['login'] = $fetch->login;
            $_SESSION['clave'] = $fetch->clave;
            $_SESSION['rol'] = $fetch->rol;

            //Obtenemos los permisos del usuario
            $marcados = $usuario->listarmarcados($fetch->idusuario);

            //Declaramos el array para almacenar todos los permisos marcados
            $valores = array();

            //Almacenamos los permisos marcados en el array
            while ($per = $marcados->fetch_object()) {
                array_push($valores, $per->idpermiso);
            }

            //Determinamos los accesos del usuario
            in_array(1, $valores) ? $_SESSION['admin'] = 1 : $_SESSION['admin'] = 0;
            in_array(2, $valores) ? $_SESSION['case'] = 1 : $_SESSION['case'] = 0;
            in_array(3, $valores) ? $_SESSION['file'] = 1 : $_SESSION['file'] = 0;
            in_array(4, $valores) ? $_SESSION['categoria'] = 1 : $_SESSION['categoria'] = 0;
            in_array(5, $valores) ? $_SESSION['user'] = 1 : $_SESSION['user'] = 0;
            in_array(6, $valores) ? $_SESSION['tracking'] = 1 : $_SESSION['tracking'] = 0;


            // entre a la reunion en meet

        }
        $respuestajson = json_encode($fetch);

        if ($respuestajson == "null") {
            echo 2;
        } else {
            echo 1;
        }


        break;

    case 'salir':
        //Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

        break;
}
