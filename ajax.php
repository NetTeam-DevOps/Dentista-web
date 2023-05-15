<?php
require_once "config/db.php";
require_once "controlador/PacienteController.php";
require_once "controlador/EspecialistaController.php";
require_once "controlador/ProductoController.php";
require_once "controlador/ServicioController.php";
require_once "controlador/Nota_ventaController.php";
require_once "controlador/Ficha_consultaController.php";

//cargar datos del paciente en el form de venta y consulta
if(isset($_POST['id_paciente'])){
    $id = $_POST['id_paciente'];
    $CPaciente = new PacienteController();
    $paciente = $CPaciente->getPaciente($id);
    $paciente = $paciente->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($paciente);
}

//cargar datos del especialista en el form de venta y consulta
if(isset($_POST['id_especialista'])){
    $id = $_POST['id_especialista'];
    $CEspecialista = new EspecialistaController();
    $especialista = $CEspecialista->getEspecialista($id);
    $especialista = $especialista->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($especialista);
}

//cargar productos para agregar en el form de venta
if(isset($_POST['id_prod'])){
    $id = $_POST['id_prod'];
    $CProducto = new ProductoController();
    $producto = $CProducto->getProducto($id);
    $producto = $producto->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($producto);
}

//cargar servicios para agregar en el form de consulta
if(isset($_POST['id_serv'])){
    $id = $_POST['id_serv'];
    $CServicio = new ServicioController();
    $servicio = $CServicio->getServicio($id);
    $servicio = $servicio->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($servicio);
}

//recibir datos para crear una venta y sus detalles
if(!isset($_POST['id_venta']) && isset($_POST['id_paciente']) && isset($_POST['id_especialista']) && isset($_POST['observacion'])
&& isset($_POST['monto']) && isset($_POST['detalle'])){
    $id_paciente = $_POST['id_paciente'];
    $id_especialista = $_POST['id_especialista'];
    $monto = $_POST['monto'];
    $observacion = $_POST['observacion'];
    $detalles = $_POST['detalle'];

    $Nota = new Nota_ventaController();
    $Nota->create($id_paciente, $id_especialista, $monto, $observacion, $detalles);
    echo "DONE";
}

//obtener detalles de una venta
if(isset($_POST['id_v'])){
    $id_venta = $_POST['id_v'];
    $Nota = new Nota_ventaController();
    $detalles = $Nota->getDetalles($id_venta)->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($detalles);
}

//recibir datos para editar una venta y sus detalles
if(isset($_POST['id_venta']) && isset($_POST['id_paciente']) && isset($_POST['id_especialista']) && isset($_POST['observacion'])
&& isset($_POST['monto']) && isset($_POST['detalle'])){
    $id_venta = $_POST['id_venta'];
    $id_paciente = $_POST['id_paciente'];
    $id_especialista = $_POST['id_especialista'];
    $monto = $_POST['monto'];
    $observacion = $_POST['observacion'];
    $detalles = $_POST['detalle'];

    $Nota = new Nota_ventaController();
    $Nota->edit($id_venta, $id_paciente, $id_especialista, $monto, $observacion, $detalles);
    echo "DONE";
}

//recibir datos para crear una consulta y sus detalles
if(!isset($_POST['id_consulta']) && isset($_POST['id_paciente']) && isset($_POST['id_especialista']) && isset($_POST['estado'])
&& isset($_POST['monto']) && isset($_POST['detalle'])){
    $id_paciente = $_POST['id_paciente'];
    $id_especialista = $_POST['id_especialista'];
    $monto = $_POST['monto'];
    $estado = $_POST['estado'];
    $detalles = $_POST['detalle'];

    $Ficha = new Ficha_consultaController();
    $Ficha->create($id_paciente, $id_especialista, $monto, $estado, $detalles);
    echo "DONE";
}

//obtener detalles de una consulta
if(isset($_POST['id_c'])){
    $id_consulta = $_POST['id_c'];
    $Ficha = new Ficha_consultaController();
    $detalles = $Ficha->getDetalles($id_consulta)->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($detalles);
}

//recibir datos para editar una consulta y sus detalles
if(isset($_POST['id_consulta']) && isset($_POST['id_paciente']) && isset($_POST['id_especialista']) && isset($_POST['estado'])
&& isset($_POST['monto']) && isset($_POST['detalle'])){
    $id_consulta = $_POST['id_consulta'];
    $id_paciente = $_POST['id_paciente'];
    $id_especialista = $_POST['id_especialista'];
    $monto = $_POST['monto'];
    $estado = $_POST['estado'];
    $detalles = $_POST['detalle'];
    
    $Ficha = new Ficha_consultaController();
    $Ficha->edit($id_consulta, $id_paciente, $id_especialista, $monto, $estado, $detalles);
    echo "DONE";
}