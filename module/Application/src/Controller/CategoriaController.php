<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\AdapterInterface;
use Zend\View\Model\ViewModel;
use Application\Model\Categoria;
use Application\Persistence\CategoriaDao;

class CategoriaController extends AbstractActionController
{    
    private $db;
    public function __construct(AdapterInterface $db) {
        $this->db = $db;
    }
    public function indexAction()
    {
        $view = new ViewModel();
        
        $categoriaDao = new CategoriaDao($this->db);
        $view->setVariable("listaCategoriasDespesa",$categoriaDao->listarCategoriasDespesa());
        $view->setVariable("listaCategoriasReceita",$categoriaDao->listarCategoriasReceita());
        $view->setTemplate("application/categoria/index.phtml");
        return $view;
    }

    public function cadastrarAction()
    {
        $view = new ViewModel();
        if($this->getRequest()->isPost()){
            $tipo = $this->getRequest()->getPost("tipo");
            $nome = $this->getRequest()->getPost("nome");

            $categoria = new Categoria();
            $categoria->setTipo($tipo);
            $categoria->setNome($nome);

            $categoriaDao = new CategoriaDao($this->db);
            if($categoriaDao->cadastrar($categoria)){
                $view->setVariable("resp", "Categoria cadastrada");
            }else{
                $view->setVariable("resp", "Erro ao cadastrar");
            }
        }
        $view->setVariable("listaCategoriasDespesa",$categoriaDao->listarCategoriasDespesa());
        $view->setVariable("listaCategoriasReceita",$categoriaDao->listarCategoriasReceita());
        $view->setTemplate("application/categoria/index.phtml");
        return $view;
    }
    
    public function buscarAction()
    {
        $view = new ViewModel();
        $id = $this->params()->fromRoute("id");
        $categoriaDao = new CategoriaDao($this->db);
        if($this->getRequest()->isPost()) {
            $nome = $this->getRequest()->getPost("nome");
            $lista = $fd->buscar($nome);

            $view->setVariable("nome", $nome);
        }

        $view->setVariable("lista", $lista);
        return $view;
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
