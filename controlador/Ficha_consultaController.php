<?php

require_once "modelo/MFicha_consulta.php";
require_once "modelo/MDetalle_consulta.php";
require_once "vista/VFicha_consulta.php";

class Ficha_consultaController{
    private $MFicha_consulta;
    private $MDetalle_consulta;
    private $VFicha_consulta;

    public function __construct(){
        $this->MFicha_consulta = new MFicha_consulta();
        $this->MDetalle_consulta = new MDetalle_consulta();
        $this->VFicha_consulta = new VFicha_consulta();
    }

    public function index(){
        $this->VFicha_consulta->index();
    }

    public function new(){
        $this->VFicha_consulta->new();
    }

    public function getConsulta($id){
        $this->DFicha_consulta->setId($id);
        $consulta = $this->DFicha_consulta->getConsulta();
        return $consulta;
    }

    public function create($id_paciente, $id_especialista, $monto, $estado, $detalles){
        //primero creamos la cabecera de la ficha
        $this->MFicha_consulta->setId_paciente($id_paciente);
        $this->MFicha_consulta->setId_especialista($id_especialista);
        $this->MFicha_consulta->setMonto($monto);
        $this->MFicha_consulta->setEstado($estado);
        $this->MFicha_consulta->create();

        //luego guardamos los detalles que se encuentran en el array detalles
        foreach($detalles as $servicio){
            $id_serv = $servicio[0];
            $cantidad = $servicio[1];
            $precio = $servicio[2];
            $this->MDetalle_consulta->setId_servicio($id_serv);
            $this->MDetalle_consulta->setCantidad($cantidad);
            $this->MDetalle_consulta->setPrecio($precio);
            $this->MDetalle_consulta->create();
        }
    }

    public function editView(){
        if(isset($_GET)){
            //obtenemos los id de la consulta para pasarlos a la vista
            $id_consulta = $_GET['id'];
            $id_paciente = $_GET['id_p'];
            $id_especialista = $_GET['id_e'];
            $this->VFicha_consulta->editView($id_consulta, $id_paciente, $id_especialista);
        }
    }

    public function edit($id_consulta, $id_paciente, $id_especialista, $monto, $estado, $detalles){
        //primero editamos la cabecera de la ficha
        $this->MFicha_consulta->setId($id_consulta);
        $this->MFicha_consulta->setId_paciente($id_paciente);
        $this->MFicha_consulta->setId_especialista($id_especialista);
        $this->MFicha_consulta->setMonto($monto);
        $this->MFicha_consulta->setEstado($estado);
        $this->MFicha_consulta->edit();

        //luego actualizamos los detalles de esta consulta que se encuentran en el array detalles
        $this->MDetalle_consulta->setId_ficha_consulta($id_consulta);
        //primero eliminamos todos para insertar los nuevos
        $this->MDetalle_consulta->delete();
        foreach($detalles as $servicio){
            $id_serv = $servicio[0];
            $cantidad = $servicio[1];
            $precio = $servicio[2];
            $this->MDetalle_consulta->setId_servicio($id_serv);
            $this->MDetalle_consulta->setCantidad($cantidad);
            $this->MDetalle_consulta->setPrecio($precio);
            $this->MDetalle_consulta->edit();
        }
    }

    public function delete(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];

            //primero borramos todos los detalles de esta consulta
            $this->MDetalle_consulta->setId_ficha_consulta($id);
            $this->MDetalle_consulta->delete();

            //Ahora eliminamos la cabecera de la ficha
            $this->MFicha_consulta->setId($id);
            $this->MFicha_consulta->delete();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'ficha_consulta/index');
    }

    public function getDetalles($id_consulta){
        $this->MDetalle_consulta->setId_ficha_consulta($id_consulta);
        $detalles = $this->MDetalle_consulta->getDetalles();
        return $detalles;
    }

}