<?php

namespace Product;

use ZfcBase\Module\AbstractModule;
use Category\Form\CategoryForm;

class Module extends AbstractModule
{

    public function getDir()
    {
        return __DIR__;
    }

    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    public function getAutoloaderConfig()
    {
        $config = parent::getAutoloaderConfig();
        // add second namespace
        $config['Zend\Loader\StandardAutoloader']['namespaces']['Category'] =
            $this->getDir() . '/src/Category';
        return $config;
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'CategoryForm' => function($sm) {
                     $form = new CategoryForm();
                     $form->init();
                     return $form;
                }
            ),
        );
    }

}