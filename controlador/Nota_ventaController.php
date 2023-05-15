<?php

require_once "modelo/MNota_venta.php";
require_once "modelo/MDetalle_venta.php";
require_once "vista/VNota_venta.php";

class Nota_ventaController{
    private $MNota_venta;
    private $MDetalle_venta;
    private $VNota_venta;

    public function __construct(){
        $this->MNota_venta = new MNota_venta();
        $this->MDetalle_venta = new MDetalle_venta();
        $this->VNota_venta = new VNota_venta();
    }

    public function index(){
        $this->VNota_venta->index();
    }

    public function new(){
        $this->VNota_venta->new();
    }

    public function getVenta($id){
        $this->DNota_venta->setId($id);
        $venta = $this->DNota_venta->getVenta();
        return $venta;
    }

    public function create($id_paciente, $id_especialista, $monto, $observacion, $detalles){
        //primero creamos la cabecera de la nota de venta
        $this->MNota_venta->setId_paciente($id_paciente);
        $this->MNota_venta->setId_especialista($id_especialista);
        $this->MNota_venta->setMonto($monto);
        $this->MNota_venta->setObservacion($observacion);
        $this->MNota_venta->create();

        //luego guardamos los detalles que se encuentran en el array detalles
        foreach($detalles as $producto){
            $id_prod = $producto[0];
            $cantidad = $producto[1];
            $precio = $producto[2];
            $this->MDetalle_venta->setId_producto($id_prod);
            $this->MDetalle_venta->setCantidad($cantidad);
            $this->MDetalle_venta->setPrecio($precio);
            $this->MDetalle_venta->create();
        }
    }

    public function editView(){
        if(isset($_GET)){
            //obtenemos los id de la venta para pasarlos a la vista
            $id_venta = $_GET['id'];
            $id_paciente = $_GET['id_p'];
            $id_especialista = $_GET['id_e'];
            $this->VNota_venta->editView($id_venta, $id_paciente, $id_especialista);
        }
    }

    public function edit($id_venta, $id_paciente, $id_especialista, $monto, $observacion, $detalles){
        //primero creamos la cabecera de la nota de venta
        $this->MNota_venta->setId($id_venta);
        $this->MNota_venta->setId_paciente($id_paciente);
        $this->MNota_venta->setId_especialista($id_especialista);
        $this->MNota_venta->setMonto($monto);
        $this->MNota_venta->setObservacion($observacion);
        $this->MNota_venta->edit();

        //luego actualizamos los detalles de esta venta que se encuentran en el array detalles
        $this->MDetalle_venta->setId_nota_venta($id_venta);
        //primero eliminamos todos para insertar los nuevos
        $this->MDetalle_venta->delete();
        foreach($detalles as $producto){
            $id_prod = $producto[0];
            $cantidad = $producto[1];
            $precio = $producto[2];
            $this->MDetalle_venta->setId_producto($id_prod);
            $this->MDetalle_venta->setCantidad($cantidad);
            $this->MDetalle_venta->setPrecio($precio);
            $this->MDetalle_venta->edit();
        }
    }

    public function delete(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            //primero borramos todos los detalles de esta venta
            $this->MDetalle_venta->setId_nota_venta($id);
            $this->MDetalle_venta->delete();

            //Ahora eliminamos la cabecera de la nota de venta
            $this->MNota_venta->setId($id);
            $this->MNota_venta->delete();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'nota_venta/index');
    }

    public function getDetalles($id_venta){
        $this->MDetalle_venta->setId_nota_venta($id_venta);
        $detalles = $this->MDetalle_venta->getDetalles();
        return $detalles;
    }

}