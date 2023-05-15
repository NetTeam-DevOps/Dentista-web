<?php

class VTipo_servicio{
    private $MTipo_servicio;

    public function __construct(){
        $this->MTipo_servicio = new MTipo_servicio();
    }

    public function index(){
        $tipos = $this->MTipo_servicio->index();
        require_once "public/views/layout/nav.php";
        require_once "public/views/tipo_servicio/index.php";
    }

}