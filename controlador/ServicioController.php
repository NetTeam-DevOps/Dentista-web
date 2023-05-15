<?php

require_once "modelo/MServicio.php";
require_once "vista/VServicio.php";

class ServicioController{
    private $MServicio;
    private $VServicio;

    public function __construct(){
        $this->MServicio = new MServicio();
        $this->VServicio = new VServicio();
    }

    public function index(){
        $this->VServicio->index();
    }

    public function getServicio($id){
        $this->MServicio->setId($id);
        $servicio = $this->MServicio->getServicio();
        return $servicio;
    }

    public function create(){
        if(isset($_POST)){
            $nombre = $_POST['nombre'];
            $id_tipo_servicio = $_POST['tipo_servicio'];
            $precio = $_POST['precio'];
            $duracion = $_POST['duracion'];

            $this->MServicio->setNombre($nombre);
            $this->MServicio->setId_tipo_servicio($id_tipo_servicio);
            $this->MServicio->setPrecio($precio);
            $this->MServicio->setDuracion($duracion);
            $this->MServicio->create();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'servicio/index');
    }

    public function edit(){
        if(isset($_POST)){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $id_tipo_servicio = $_POST['tipo_servicio'];
            $precio = $_POST['precio'];
            $duracion = $_POST['duracion'];

            $this->MServicio->setId($id);
            $this->MServicio->setNombre($nombre);
            $this->MServicio->setId_tipo_servicio($id_tipo_servicio);
            $this->MServicio->setPrecio($precio);
            $this->MServicio->setDuracion($duracion);
            $this->MServicio->edit();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'servicio/index');
    }

    public function delete(){
        if(isset($_POST)){
            $id = $_POST['id'];

            $this->MServicio->setId($id);
            $this->MServicio->delete();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'servicio/index');
    }
}