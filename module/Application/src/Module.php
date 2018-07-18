<?php
namespace Application;

use Zend\Db\Adapter\AdapterInterface;
use Application\Controller\CategoriaController;
use Application\Controller\ContatoController;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getControllerConfig() {
        return [
            'factories' => [
                CategoriaController::class => function($container){
                    //pegando as configurações do banco
                    $db = $container->get(AdapterInterface::class);
                    return new CategoriaController($db);
                },
                ContatoController::class => function($container){
                    //pegando as configurações do banco com O Doctrine
                    $em = $container->get(\Doctrine\ORM\EntityManager::class);
                    return new ContatoController($em);
                },                        
            ]
        ];
    }
}
