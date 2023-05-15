<?php

class VCargo{
    private $MCargo;

    public function __construct(){
        $this->MCargo = new MCargo();
    }

    public function index(){
        $cargos = $this->MCargo->index();
        require_once "public/views/layout/nav.php";
        require_once "public/views/cargo/index.php";
    }

}