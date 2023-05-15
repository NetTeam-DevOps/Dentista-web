<?php

require_once "modelo/MPaciente.php";
require_once "modelo/MEspecialista.php";
require_once "modelo/MProducto.php";

class VNota_venta{
    private $MPaciente;
    private $MEspecialista;
    private $MProducto;
    private $MNota_venta;

    public function __construct(){
        $this->MPaciente = new MPaciente();
        $this->MEspecialista = new MEspecialista();
        $this->MProducto = new MProducto();
        $this->MNota_venta = new MNota_venta();
    }

    public function index(){
        $ventas = $this->MNota_venta->index();
        require_once "public/views/layout/nav.php";
        require_once "public/views/venta/index.php";
    }

    

    public function new(){
        $pacientes = $this->indexPacientes();
        $especialistas = $this->indexEspecialistas();
        $productos = $this->indexProductos();
        require_once "public/views/layout/nav.php";
        require_once "public/views/venta/new.php";
    }

    public function editView($id_venta, $id_paciente, $id_especialista){
        //obtenemos datos de la venta para llenar campos
        $this->MNota_venta->setId($id_venta);
        $venta = $this->MNota_venta->getVenta()->fetch(PDO::FETCH_OBJ);

        //obtenemos datos del paciente de esta venta para llenar en los campos
        $this->MPaciente->setId($id_paciente);
        $paciente_edit = $this->MPaciente->getPaciente()->fetch(PDO::FETCH_OBJ);

        //obtenemos datos del especialista de esta venta para llenar en los campos
        $this->MEspecialista->setId($id_especialista);
        $especialista_edit = $this->MEspecialista->getEspecialista()->fetch(PDO::FETCH_OBJ);
        
        //obtenemos todos los datos de pacientes especialistas y productos para poder elegir otro de estos
        $pacientes = $this->indexPacientes();
        $especialistas = $this->indexEspecialistas();
        $productos = $this->indexProductos();
        require_once "public/views/layout/nav.php";
        require_once "public/views/venta/new.php";
    }

    public function indexPacientes(){
        return $this->MPaciente->index();
    }

    public function indexEspecialistas(){
        return $this->MEspecialista->index();
    }

    public function indexProductos(){
        return $this->MProducto->index();
    }
}