<?php

require_once("../model/Carros.php");
require_once("../dao/CarroDao.php");

class CarroControl {
    private $carro;
    private $acao;
    private $dao;

    public function __construct() {
        $this->carro = new Carros();
        $this->dao = new CarroDao();
        $this->acao = $_GET["a"];
        $this->verificaAcao();
    }

    function verificaAcao() {
        if ($this->acao == "inserir") {
            $this->inserir();
        } else if ($this->acao == "alterar") {
            $this->alterar();
        } else if ($this->acao == "excluir") {
            $this->excluir();
        }
    }

    function inserir() {
        $this->carro->setMarca($_POST["marca"]);
        $this->carro->setModelo($_POST["modelo"]);
        $this->carro->setAno($_POST["ano"]);
        $this->dao->inserir($this->carro);
    }

    function excluir() {
        $id = $_GET["id"];
        $this->dao->excluir($id);
    }

    function alterar() {
        $this->carro->setId($_POST["id"]);
        $this->carro->setMarca($_POST["marca"]);
        $this->carro->setModelo($_POST["modelo"]);
        $this->carro->setAno($_POST["ano"]);
        $this->dao->alterar($this->carro);
    }

    function buscarId(Carro $carro) {
        return $this->dao->buscarId($carro);
    }

    function buscaTodos() {
        return $this->dao->buscaTodos();
    }
}

new CarroControl();
