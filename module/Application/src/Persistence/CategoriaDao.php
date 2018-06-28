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
        $sql="select id,nome from categoria where tipo = 'despesa'";

        return $this->table->getAdapter()->getDriver()
                        ->getConnection()->execute($sql);
    }
    
    public function listarCategoriasReceita() {
        $sql="select id,nome from categoria where tipo = 'receita'";

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
 
    public function buscarId($id = 0){
        $select = $this->table->select(['id' => $id]);
        $row = $select->current();
        return $row;
    }

/*    
    public function atualizar(\Application\Model\Funcionario $f) {
        $data = [
            'nome' => $f->getNome(),
            'email' => $f->getEmail(),
            'salario' => $f->getSalario(),
            'id_cargo' => $f->getCargo()->getIdCargo(),
        ];
        return $this->table->update($data, 'id = ' . $f->getId());
    }
*/
/*    
    public function excluir($id = 0){
        return $this->table->delete("id = " . $id);
    } 
 */
}
