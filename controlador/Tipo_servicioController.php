<?php

require_once "modelo/MTipo_servicio.php";
require_once "vista/VTipo_servicio.php";

class Tipo_servicioController{
    private $MTipo_servicio;
    private $VTipo_servicio;

    public function __construct(){
        $this->MTipo_servicio = new MTipo_servicio();
        $this->VTipo_servicio = new VTipo_servicio();
    }

    public function index(){
        $this->VTipo_servicio->index();
    }

    public function create(){
        if(isset($_POST)){
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $this->MTipo_servicio->setNombre($nombre);
            $this->MTipo_servicio->setDescripcion($descripcion);
            $this->MTipo_servicio->create();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'tipo_servicio/index');
    }

    public function edit(){
        if(isset($_POST)){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $this->MTipo_servicio->setId($id);
            $this->MTipo_servicio->setNombre($nombre);
            $this->MTipo_servicio->setDescripcion($descripcion);
            $this->MTipo_servicio->edit();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'tipo_servicio/index');
    }

    public function delete(){
        if(isset($_POST)){
            $id = $_POST['id'];

            $this->MTipo_servicio->setId($id);
            $this->MTipo_servicio->delete();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'tipo_servicio/index');
    }

}