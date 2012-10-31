<?php
namespace Todo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TodoController extends AbstractActionController
{

    protected $todoTable;

    public function getTodoTable()
    {
        if (!$this->todoTable) {
            $sm = $this->getServiceLocator();
            $this->todoTable = $sm->get('Todo\Model\TodoTable');
        }
        return $this->todoTable;
    }
    public function indexAction()
    {
        return new ViewModel(array(
            'todos' => $this->getTodoTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}
