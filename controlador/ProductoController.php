<?php

require_once "modelo/MProducto.php";
require_once "vista/VProducto.php";

class ProductoController{
    private $MProducto;
    private $VProducto;

    public function __construct(){
        $this->MProducto = new MProducto();
        $this->VProducto = new VProducto();
    }

    public function index(){
        $this->VProducto->index();
    }

    public function getProducto($id){
        $this->MProducto->setId($id);
        $producto = $this->MProducto->getProducto();
        return $producto;
    }

    public function create(){
        if(isset($_POST)){
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $marca = $_POST['marca'];
            $descripcion = $_POST['descripcion'];
            $this->MProducto->setNombre($nombre);
            $this->MProducto->setPrecio($precio);
            $this->MProducto->setMarca($marca);
            $this->MProducto->setDescripcion($descripcion);
            $this->MProducto->create();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'producto/index');
    }

    public function edit(){
        if(isset($_POST)){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $marca = $_POST['marca'];
            $descripcion = $_POST['descripcion'];
            $this->MProducto->setId($id);
            $this->MProducto->setNombre($nombre);
            $this->MProducto->setPrecio($precio);
            $this->MProducto->setMarca($marca);
            $this->MProducto->setDescripcion($descripcion);
            $this->MProducto->edit();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'producto/index');
    }

    public function delete(){
        if(isset($_POST)){
            $id = $_POST['id'];
            $this->MProducto->setId($id);
            $this->MProducto->delete();
        }
        //llamar al metodo index de la vista de esta manera para limpiar la url
        header("Location:".ROOT.'producto/index');
    }

}