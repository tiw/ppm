<?php

namespace Todo;

use Todo\Model\Todo;
use Todo\Model\TodoTable;
use User\Model\Mapper\User as UserMapper;
use Zfcuser\Mapper\UserHydrator;
use Todo\Form\TodoForm;
use Todo\Model\TodoHydrator;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Todo\Model\TodoTable' => function($sm) {
                    $tableGateway = $sm->get('TodoTableGateway');
                    $table = new TodoTable($tableGateway);
                    return $table;
                },
                'TodoTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Todo());
                    return new TableGateway('todo', $dbAdapter, null, $resultSetPrototype);
                },
                'UserMapper' => function($sm) {
                    $mapper = new UserMapper();
                    $mapper->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    $mapper->setEntityPrototype(new \User\Model\User());
                    $mapper->setHydrator(new UserHydrator());
                    return $mapper;
                },
                'TodoForm' => function($sm) {
                    $form = new TodoForm();
                    $form->setUserMapper($sm->get('UserMapper'));
                    $tanslator = $sm->get('translator');
                    $form->setTranslator($sm->get('translator'));
                    $form->setHydrator(new TodoHydrator());
                    $form->bind(new Todo());
                    $form->init();
                    return $form;
                },
            ),
        );
    }

    /*
      protected $sm;
      protected $app;
      public function onBootstrap($e)
      {
      $this->app = $e->getApplication();
      $this->sm = $this->app->getServiceManager();
      $eventManager = $this->app->getEventManager();
      $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_DISPATCH, array($this, 'preDispatch'), 100);
      }

      public function preDispatch()
      {
      $auth = $this->sm->get('zfcuser_auth_service');

      // check the module controller and action name
      // the white list is /user/login

      $req = $this->app->getRequest();
      $params = $req->getQuery()->toArray();
      var_dump($params);die;
      if (!$auth->hasIdentity()) {
      header("Location: http://zf2.my/user/login");
      }
      }
     */
}
