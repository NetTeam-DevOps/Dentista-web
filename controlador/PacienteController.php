<?php

require_once "modelo/MPaciente.php";
require_once "vista/VPaciente.php";

class PacienteController{
    private $MPaciente;
    private $VPaciente;

    public function __construct(){
        $this->MPaciente = new MPaciente();
        $this->VPaciente = new VPaciente();
    }

    public function index(){
        $this->VPaciente->index();
    }

    public function getPaciente($id){
        $this->MPaciente->setId($id);
        $paciente = $this->MPaciente->getPaciente();
        return $paciente;
    }
    
    public function create(){
        if(isset($_POST)){
            $ci = $_POST['ci'];
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];
            $telefono = $_POST['telefono'];

            $this->MPaciente->setCi($ci);
            $this->MPaciente->setNombre($nombre);
            $this->MPaciente->setEdad($edad);
            $this->MPaciente->setTelefono($telefono);
            $this->MPaciente->create();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'paciente/index');
    }

    public function edit(){
        if(isset($_POST)){
            $id = $_POST['id'];
            $ci = $_POST['ci'];
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];
            $telefono = $_POST['telefono'];

            $this->MPaciente->setId($id);
            $this->MPaciente->setCi($ci);
            $this->MPaciente->setNombre($nombre);
            $this->MPaciente->setEdad($edad);
            $this->MPaciente->setTelefono($telefono);
            $this->MPaciente->edit();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'paciente/index');
    }

    public function delete(){
        
        if(isset($_POST)){
            $id = $_POST['id'];

            $this->MPaciente->setId($id);
            $this->MPaciente->delete();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'paciente/index');
    }
}