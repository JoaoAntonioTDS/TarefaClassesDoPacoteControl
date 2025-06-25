<?php
require_once("../model/Carros.php");

class CarroDao {

    private $con;

    public function __construct() {
        $this->con = new mysqli("localhost", "root", "", "seu_banco");
    }

    public function inserir(Carros $carro) {
        $sql = "INSERT INTO carros (marca, modelo, ano) VALUES (?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssi",
            $carro->getMarca(),
            $carro->getModelo(),
            $carro->getAno()
        );
        $stmt->execute();
    }

    public function excluir($id) {
        $sql = "DELETE FROM carros WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function alterar(Carros $carro) {
        $sql = "UPDATE carros SET marca = ?, modelo = ?, ano = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssii",
            $carro->getMarca(),
            $carro->getModelo(),
            $carro->getAno(),
            $carro->getId()
        );
        $stmt->execute();
    }

    public function buscarId(Carros $carro) {
        $sql = "SELECT * FROM carros WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $carro->getId());
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function buscaTodos() {
        $sql = "SELECT * FROM carros";
        $result = $this->con->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
