<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoriaController extends AbstractActionController
{    
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
