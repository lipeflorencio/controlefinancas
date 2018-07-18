<?php
namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contato")
 */

class Contato {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */    
    private $id;
    
    /** @ORM\Column(type="string") */
    private $nome;
    
    /** @ORM\Column(type="string",length=14) */
    private $codContato;
    
    /** @ORM\Column(type="integer") */
    private $tipo;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCodContato() {
        return $this->codContato;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setCodContato($codContato) {
        $this->codContato = $codContato;
        return $this;
    }

}
