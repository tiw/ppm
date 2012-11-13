<?php

namespace Product;

use ZfcBase\Module\AbstractModule;
use Category\Form\CategoryForm;
use Category\Model\Mapper\Category as CategoryMapper;
use Category\Model\Category;
use Category\Model\Mapper\CategoryHydrator;


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
                     $form->setHydrator(new CategoryHydrator());
                     $form->bind(new Category());
                     $form->init();
                     return $form;
                },
                'Category\Model\Mapper\Category' => function($sm) {
                    $mapper = new CategoryMapper();
                    $mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper->setEntityPrototype(new Category());
                    $mapper->setHydrator(new CategoryHydrator());
                    return $mapper;
                }
            ),
        );
    }

}