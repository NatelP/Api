<?php

require_once '../models/Empleados.php';

if(isset($_GET['operacion'])){
    $empleados = new Empleados();

    if ($_GET['operacion'] == 'listar'){
        $resultado = $empleados->getAll();
        echo json_encode($resultado);
    }
    if ($_GET['operacion'] == 'getResumenTotalSedes'){
        echo json_encode($empleados->getResumenTotalSedes());
    }
}

if(isset($_POST['operacion'])){
    $empleados = new Empleados();

    if ($_POST['operacion'] == 'search'){

        $respuesta = $empleados->search(["nrodocumento" => $_POST['nrodocumento']]);

        sleep(2);
        echo json_encode($respuesta);
    } 

    if ($_POST['operacion'] == 'add'){

        $datosRecibidos = [
            "idsede"          => $_POST ["idsede"],
            "apellidos"       => $_POST ["apellidos"],
            "nombres"         => $_POST ["nombres"],
            "nrodocumento"    => $_POST ["nrodocumento"],
            "fechanac"        => $_POST ["fechanac"],
            "telefono"        => $_POST ["telefono"]
        ];

        $idObtenido = $empleados->add($datosRecibidos);
        if ($idObtenido > 0) {
            echo json_encode(['idEmpleado' => $idObtenido]);
        } else {
            echo json_encode(['error' => 'No se pudo agregar el empleado']);
        }
        }
}
