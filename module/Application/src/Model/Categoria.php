<?php

namespace Application\Model;

class Categoria {
    
    private $id;
    private $tipo;
    private $nome;

    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function validate(){
        $error = [];
        if($this->nome == ""){
            $error[] = "Preencha o campo nome";
        }

        if($this->tipo == ""){
            $error[] = "Preencha o campo tipo";
        }

        return $error;
    }

}
