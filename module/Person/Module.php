<?php
namespace Person;

use ZfcBase\Module\AbstractModule;
use Person\Model\Person;
use Person\Model\Mapper\PersonHydrator;
use Person\Form\PersonForm;
use Person\Model\Mapper\Person as PersonMapper;
/**
 * User: wangting
 * Date: 12-11-28
 * Time: 上午9:41
 * copyright 2012 tiddr.de
 */
class Module extends AbstractModule
{
    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    public function getDir()
    {
        return __DIR__;
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'PersonForm' => function($sm) {
                    $form = new PersonForm();
                    $form->setHydrator(new PersonHydrator());
                    $form->bind(new Person());
                    $form->init();
                    return $form;
                },
                'PersonMapper' => function($sm) {
                    $mapper = new PersonMapper();
                    $mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper->setEntityPrototype(new Person());
                    $mapper->setHydrator(new PersonHydrator());
                    return $mapper;
                }
            ),
        );
    }

}
