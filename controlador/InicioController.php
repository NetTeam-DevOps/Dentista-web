<?php
require_once "vista/VInicio.php";

class InicioController{
    private $VInicio;

    public function __construct(){
        $this->VInicio = new VInicio();
    }

    public function index(){
        $this->VInicio->index();
    }
}