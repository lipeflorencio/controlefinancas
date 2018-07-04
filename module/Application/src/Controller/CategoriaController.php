<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\AdapterInterface;
use Zend\View\Model\ViewModel;
use Application\Model\Categoria;
use Application\Persistence\CategoriaDao;
use Zend\View\Model\JsonModel;

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
                $view->setVariable("resp","<div class='alert alert-success'>" . "Categoria cadastrada com sucesso</div>");
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

        $categoriaDao = new CategoriaDao($this->db);
        if($this->getRequest()->isPost()) {
            
            $id = $this->getRequest()->getPost("id");
            $tipo = $this->getRequest()->getPost("tipoEdicao");
            $nome = $this->getRequest()->getPost("nomeEdicao");

            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria->setTipo($tipo);
            $categoria->setNome($nome);

            if($categoriaDao->atualizar($categoria)){
                $view->setVariable("resp","<div class='alert alert-success'>" . "Categoria editada com sucesso</div>");
            }else{
                $view->setVariable("resp", "Erro ao editar");
            }
        }
        $view->setVariable("listaCategoriasDespesa",$categoriaDao->listarCategoriasDespesa());
        $view->setVariable("listaCategoriasReceita",$categoriaDao->listarCategoriasReceita());
        $view->setTemplate("application/categoria/index.phtml");
        return $view;
    }
    
    public function excluirAction()
    {
        $view = new ViewModel();
        
        $id = $this->params()->fromRoute("id");
        $categoriaDao = new CategoriaDao($this->db);
        $categoriaDao->excluir($id);

        $view->setVariable("listaCategoriasDespesa",$categoriaDao->listarCategoriasDespesa());
        $view->setVariable("listaCategoriasReceita",$categoriaDao->listarCategoriasReceita());
        $view->setTemplate("application/categoria/index.phtml");
        $view->setVariable("resp","<div class='alert alert-success'>" . "Categoria excluída com sucesso</div>");
        
        return $view;
    }
}
