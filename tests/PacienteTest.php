<?php

use PHPUnit\Framework\TestCase;

require_once '../vendor/autoload.php';
require_once './modelo/MPaciente.php';

class PacienteTest extends TestCase
{
    public function testGetPaciente()
    {
        $paciente = new MPaciente();
        $paciente->setId(1);
        $result = $paciente->getPaciente();
        $this->assertNotNull($result);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->assertNotEmpty($data);
        $this->assertEquals(1, $data[0]['id']);
    }
    public function testCreate()
    {
        $paciente = new MPaciente();
        $paciente->setCi("1234567");
        $paciente->setNombre("Juan Perez");
        $paciente->setEdad(30);
        $paciente->setTelefono(75812311);
        $paciente->create();
        $database = $paciente->db->connect();
        $sql = "SELECT * FROM paciente WHERE ci='1234567'";
        $query = $database->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        $this->assertEquals("1234567", $result['ci']);
        $this->assertEquals("Juan Perez", $result['nombre']);
        $this->assertEquals(30, $result['edad']);
        $this->assertEquals(75812311, $result['telefono']);
    }

    public function testEdit()
    {
        $paciente = new MPaciente();

        $paciente->setCi('1234567');
        $paciente->setNombre('Juan');
        $paciente->setEdad(30);
        $paciente->setTelefono(75812311);

        $paciente->create();

        $paciente->setNombre('Pedro');
        $paciente->setEdad(35);

        $paciente->edit();

        $updatedPaciente = $paciente->getPaciente();

        $this->assertEquals('1234567', $updatedPaciente->getCi());
        $this->assertEquals('Pedro', $updatedPaciente->getNombre());
        $this->assertEquals(35, $updatedPaciente->getEdad());
        $this->assertEquals(75812311, $updatedPaciente->getTelefono());

        $updatedPaciente->delete();
    }

    public function testDelete()
    {
        $paciente = new MPaciente();
        $paciente->setId(1);

        $paciente->delete();

        $database = $paciente->db->connect();
        $sql = "SELECT * FROM paciente WHERE id=1";
        $query = $database->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        $this->assertFalse($result);
    }
}
