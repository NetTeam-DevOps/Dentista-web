<?php

class VPaciente{
    private $MPaciente;

    public function __construct(){
        $this->MPaciente = new MPaciente();
    }

    public function index(){
        $pacientes = $this->MPaciente->Index();
        require_once "public/views/layout/nav.php";
        require_once "public/views/paciente/index.php";
    }


}