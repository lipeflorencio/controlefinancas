<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\AdapterInterface;
use Zend\View\Model\ViewModel;
use Application\Model\Contato;
use Doctrine\ORM\EntityManager;
use Zend\View\Model\JsonModel;

class ContatoController extends AbstractActionController
{    
    private $em;
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function indexAction()
    {
        $view = new ViewModel();

        return $view;
    }

    public function cadastrarAction()
    {
        $view = new ViewModel();
        return $view;
    }
    
    public function buscarAction()
    {
        $categoriaDao = new CategoriaDao($this->db);
        if($this->getRequest()->isPost()) {            
            $id = $this->getRequest()->getPost("id");
            $categoria = $categoriaDao->buscarId($id);
            $row = $categoria->current();               
        }

        return new JsonModel([
            'status' => 'SUCCESS',
            'data' => [$row]
        ]);
    }
    
    public function editarAction()
    {
        $view = new ViewModel();

        return $view;
    }
    
    public function excluirAction()
    {
        $view = new ViewModel();
        return $view;
    }
}
