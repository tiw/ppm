<?php
namespace Country;
/**
 * Created by JetBrains PhpStorm.
 * User: ting
 * Date: 13-5-18
 * Time: 下午4:38 
 */

use Country\Form\CountryForm;
use Country\Model\Mapper\Country as CountryMapper;
use Country\Model\Country;
use Country\Model\Mapper\CountryHydrator;
use ZfcBase\Module\AbstractModule;

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

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Country\Model\Mapper\Country' => function($sm) {
                    $mapper = new CountryMapper();
                    $mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper->setEntityPrototype(new Country());
                    $mapper->setHydrator(new CountryHydrator());
                    return $mapper;
                },
                'CountryForm' => function() {
                    $form = new CountryForm();
                    $form->setHydrator(new CountryHydrator());
                    $form->bind(new Country());
                    $form->init();
                    return $form;

                }
            )
        );
    }
}