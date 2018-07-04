<?php

namespace Application\Persistence;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Application\Model\Categoria;

class CategoriaDao {
    private $table;

    public function __construct(AdapterInterface $db) {
        $this->table = new tableGateway("categoria",$db);
    }

    //gravar no banco
    public function cadastrar(Categoria $categoria) {
        $data = [
            'tipo' => $categoria->getTipo(),
            'nome' => $categoria->getNome(),
        ];
        return $this->table->insert($data);
    }

    public function listarCategoriasDespesa() {
<<<<<<< HEAD
        $sql="select id, nome from categoria where tipo = 'despesa'";
=======
        $sql="select id,nome from categoria where tipo = 'despesa'";
>>>>>>> 6a60525c5bfe37582e4901caf922c0811a0383e2

        return $this->table->getAdapter()->getDriver()
                        ->getConnection()->execute($sql);
    }
    
    public function listarCategoriasReceita() {
<<<<<<< HEAD
        $sql="select id, nome from categoria where tipo = 'receita'";
=======
        $sql="select id,nome from categoria where tipo = 'receita'";
>>>>>>> 6a60525c5bfe37582e4901caf922c0811a0383e2

        return $this->table->getAdapter()->getDriver()
                        ->getConnection()->execute($sql);
    }
/*
    public function buscar($nome = ""){
        //Objeto de condições
        $predicate = new \Zend\Db\Sql\Predicate\Predicate();
        $predicate->like("nome", $nome . "%");

        //objeto para montar SELECT
        $select = new \Zend\Db\Sql\Select();
        $select->from("funcionario")
            ->join("cargo", "funcionario.id_cargo = cargo.idcargo", "*",
            \Zend\Db\Sql\Join::JOIN_LEFT)
            ->where($predicate)
            ->order("nome asc");

        return $this->table->selectWith($select);
    }
*/
/*    
    public function buscar2($nome = ""){
        $sql="select * from funcionario where nome like '" . $nome . "%' ";

        return $this->table->getAdapter()->getDriver()
                        ->getConnection()->execute($sql);
    }
*/
<<<<<<< HEAD
   
=======
 
>>>>>>> 6a60525c5bfe37582e4901caf922c0811a0383e2
    public function buscarId($id = 0){
        $sql="select tipo, nome from categoria where id = ". $id;

        return $this->table->getAdapter()->getDriver()
                        ->getConnection()->execute($sql);
    }
<<<<<<< HEAD
   
    public function atualizar(Categoria $categoria) {
=======

/*    
    public function atualizar(\Application\Model\Funcionario $f) {
>>>>>>> 6a60525c5bfe37582e4901caf922c0811a0383e2
        $data = [
            'tipo' => $categoria->getTipo(),
            'nome' => $categoria->getNome(),
        ];
        return $this->table->update($data, 'id = ' . $categoria->getId());
    }
    
    public function excluir($id = 0){
        return $this->table->delete("id = " . $id);
    } 
}
