<?php

require_once "modelo/MCargo.php";
require_once "vista/VCargo.php";

class CargoController{
    private $MCargo;
    private $VCargo;

    public function __construct(){
        $this->MCargo = new MCargo();
        $this->VCargo = new VCargo();
    }

    public function index(){
        $this->VCargo->index();
    }

    public function create(){
        if(isset($_POST)){
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $this->MCargo->setNombre($nombre);
            $this->MCargo->setDescripcion($descripcion);
            $this->MCargo->create();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'cargo/index');
    }

    public function edit(){
        if(isset($_POST)){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $this->MCargo->setId($id);
            $this->MCargo->setNombre($nombre);
            $this->MCargo->setDescripcion($descripcion);
            $this->MCargo->edit();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'cargo/index');
    }

    public function delete(){
        if(isset($_POST)){
            $id = $_POST['id'];
            $this->MCargo->setId($id);
            $this->MCargo->delete();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'cargo/index');
    }

}