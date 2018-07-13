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
                $resp = "<div class='alert alert-success alert-dismissible'>" . 
                        "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" .
                        "Categoria cadastrada com sucesso!</div>";
                $view->setVariable("resp", $resp);
            }else{
                $resp = "<div class='alert alert-danger alert-dismissible'>" . 
                        "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" .
                        "Erro ao cadastrar!</div>";
                $view->setVariable("resp", $resp);
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
                $resp = "<div class='alert alert-success alert-dismissible'>" . 
                        "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" .
                        "Categoria editada com sucesso!</div>";
                $view->setVariable("resp", $resp);
            }else{
                $resp = "<div class='alert alert-danger alert-dismissible'>" . 
                        "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" .
                        "Erro ao editar!</div>";
                $view->setVariable("resp", $resp);
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
        
        $resp = "<div class='alert alert-success alert-dismissible'>" . 
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" .
                "Categoria excluída com sucesso!</div>";
        $view->setVariable("resp", $resp);

        $view->setVariable("listaCategoriasDespesa",$categoriaDao->listarCategoriasDespesa());
        $view->setVariable("listaCategoriasReceita",$categoriaDao->listarCategoriasReceita());
        $view->setTemplate("application/categoria/index.phtml");
        
        return $view;
    }
}
