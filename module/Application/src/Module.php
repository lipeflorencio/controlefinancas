<?php

namespace Application;

use Application\Controller\CategoriaController;

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
                CategoriaController::class => function(){
                    //pegando as configurações do banco
                    //$db = $container->get(AdapterInterface::class);
                    //return new FuncionarioController($db);
                    return new CategoriaController();
                }
            ]
        ];
    }
}
