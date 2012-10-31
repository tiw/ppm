<?php
namespace Todo\Controller;

use Todo\Controller\TodoController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

class TodoControllerTest extends PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp()
    {
        $bootstrap        = \Zend\Mvc\Application::init(include 'config/application.config.php');
        $this->controller = new TodoController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->event      = $bootstrap->getMvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setEventManager($bootstrap->getEventManager());
        $this->controller->setServiceLocator($bootstrap->getServiceManager());
    }
    

    public function testAddActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'add');
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }


    public function testDeleteActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'delete');

        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }

    public function testEditActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'edit');

        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->routeMatch->setParam('action', 'index');

        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }


    public function testGetTodoTableReturnAnInstanceOfTodoTable()
    {
        $this->assertInstanceOf('Todo\Model\TodoTable', $this->controller->getTodoTable());
    }

}
