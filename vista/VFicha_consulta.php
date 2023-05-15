<?php

require_once "modelo/MPaciente.php";
require_once "modelo/MEspecialista.php";
require_once "modelo/MServicio.php";

class VFicha_consulta{
    private $MPaciente;
    private $MEspecialista;
    private $MServicio;
    private $MFicha_consulta;

    public function __construct(){
        $this->MPaciente = new MPaciente();
        $this->MEspecialista = new MEspecialista();
        $this->MServicio = new MServicio();
        $this->MFicha_consulta = new MFicha_consulta();
    }

    public function index(){
        $consultas = $this->MFicha_consulta->index();
        require_once "public/views/layout/nav.php";
        require_once "public/views/consulta/index.php";
    }

    

    public function new(){
        $pacientes = $this->indexPacientes();
        $especialistas = $this->indexEspecialistas();
        $servicios = $this->indexServicios();
        require_once "public/views/layout/nav.php";
        require_once "public/views/consulta/new.php";
    }

    public function editView($id_consulta, $id_paciente, $id_especialista){
        //obtenemos datos de la consulta para llenar campos
        $this->MFicha_consulta->setId($id_consulta);
        $consulta = $this->MFicha_consulta->getConsulta()->fetch(PDO::FETCH_OBJ);

        //obtenemos datos del paciente de esta consulta para llenar en los campos
        $this->MPaciente->setId($id_paciente);
        $paciente_edit = $this->MPaciente->getPaciente()->fetch(PDO::FETCH_OBJ);

        //obtenemos datos del especialista de esta consulta para llenar en los campos
        $this->MEspecialista->setId($id_especialista);
        $especialista_edit = $this->MEspecialista->getEspecialista()->fetch(PDO::FETCH_OBJ);
        
        //obtenemos los datos de todos los pacientes, especialistas y servicios para poder elegir otro de estos
        $pacientes = $this->indexPacientes();
        $especialistas = $this->indexEspecialistas();
        $servicios = $this->indexServicios();
        require_once "public/views/layout/nav.php";
        require_once "public/views/consulta/new.php";
    }

    public function indexPacientes(){
        return $this->MPaciente->index();
    }

    public function indexEspecialistas(){
        return $this->MEspecialista->index();
    }

    public function indexServicios(){
        return $this->MServicio->index();
    }
}