<?php

namespace Product;

use Category\Form\SubCategoryForm;
use ZfcBase\Module\AbstractModule;
use Category\Form\CategoryForm;
use Category\Model\Mapper\Category as CategoryMapper;
use Category\Model\Mapper\SubCategory as SubCategoryMapper;
use Category\Model\Category;
use Category\Model\SubCategory;
use Category\Model\Mapper\CategoryHydrator;
use Category\Model\Mapper\SubCategoryHydrator;
use Product\Form\ProductForm;
use Product\Model\Mapper\ProductHydrator;
use Product\Model\Product;
use Product\Model\Mapper\Product as ProductMapper;
use Product\Model\Mapper\Image as ImageMapper;
use Product\Model\Image;
use Product\Model\Mapper\ImageHydrator;

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
                'SubCategoryForm' => function($sm) {
                    $form = new SubCategoryForm();
                    $form->setHydrator(new SubCategoryHydrator());
                    $form->bind(new SubCategory());
                    $form->init();
                    return $form;
                },
                'ProductForm' => function($sm) {
                    $form = new ProductForm();
                    $form->setHydrator(new ProductHydrator());
                    $form->setCategoryMapper($sm->get('Category\Model\Mapper\Category'));
                    $form->setPersonMapper($sm->get('PersonMapper'));
                    $form->setSubCategoryMapper($sm->get('Category\Model\Mapper\SubCategory'));
                    $form->bind(new Product());
                    $form->init();
                    return $form;
                },
                'ImageForm' => function($sm) {
                    $form = new Form\ImageForm();
                    $form->setHydrator(new ImageHydrator());
                    $form->bind(new Image());
                    $form->init();
                    return $form;
                },
                'Category\Model\Mapper\Category' => function($sm) {
                    $mapper = new CategoryMapper();
                    $mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper->setEntityPrototype(new Category());
                    $mapper->setHydrator(new CategoryHydrator());
                    return $mapper;
                },
                'Category\Model\Mapper\SubCategory' => function($sm) {
                    $mapper = new SubCategoryMapper();
                    $mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper->setEntityPrototype(new SubCategory());
                    $mapper->setHydrator(new SubCategoryHydrator());
                    return $mapper;
                },
                'Product\Model\Mapper\Product' => function($sm) {
                    $mapper = new ProductMapper();
                    $mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper->setEntityPrototype(new Product());
                    $mapper->setHydrator(new ProductHydrator());
                    return $mapper;
                },
                'Product\Model\Mapper\Image' => function($sm) {
                    $mapper = new ImageMapper();
                    $mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper->setEntityPrototype(new Image());
                    $mapper->setHydrator(new ImageHydrator());
                    return $mapper;
                },
                'SeasonService' => function($sm) {
                    return new \Tiddr\Date\ChineseSeason();
                }
            ),
        );
    }

}