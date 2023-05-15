<?php

require_once "modelo/MEspecialista.php";
require_once "vista/VEspecialista.php";

class EspecialistaController{
    private $MEspecialista;
    private $VEspecialista;

    public function __construct(){
        $this->MEspecialista = new MEspecialista();
        $this->VEspecialista = new VEspecialista();
    }

    public function index(){
        $this->VEspecialista->Index();
    }

    public function getEspecialista($id){
        $this->MEspecialista->setId($id);
        $especialista = $this->MEspecialista->getEspecialista();
        return $especialista;
    }

    public function create(){
        if(isset($_POST)){
            $ci = $_POST['ci'];
            $nombre = $_POST['nombre'];
            $id_cargo = $_POST['cargo'];
            $edad = $_POST['edad'];
            $telefono = $_POST['telefono'];

            $this->MEspecialista->setCi($ci);
            $this->MEspecialista->setNombre($nombre);
            $this->MEspecialista->setId_cargo($id_cargo);
            $this->MEspecialista->setEdad($edad);
            $this->MEspecialista->setTelefono($telefono);
            $this->MEspecialista->create();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'especialista/index');
    }

    public function edit(){
        if(isset($_POST)){
            $id = $_POST['id'];
            $ci = $_POST['ci'];
            $nombre = $_POST['nombre'];
            $id_cargo = $_POST['cargo'];
            $edad = $_POST['edad'];
            $telefono = $_POST['telefono'];

            $this->MEspecialista->setId($id);
            $this->MEspecialista->setCi($ci);
            $this->MEspecialista->setNombre($nombre);
            $this->MEspecialista->setId_cargo($id_cargo);
            $this->MEspecialista->setEdad($edad);
            $this->MEspecialista->setTelefono($telefono);
            $this->MEspecialista->edit();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'especialista/index');
    }

    public function delete(){
        if(isset($_POST)){
            $id = $_POST['id'];

            $this->MEspecialista->setId($id);
            $this->MEspecialista->delete();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'especialista/index');
    }
}