<?php
namespace Todo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Todo\Model\Todo;

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
        //$sm = $this->getServiceLocator();
        //$auth = $sm->get('zfcuser_auth_service');
        //$userId = $auth->getIdentity()->getId();
        $form = $this->getServiceLocator()->get('TodoForm');
        $translator = $this->getServiceLocator()->get('translator');
        $form->get('submit')->setValue($translator->translate('Add', 'todo'));

        $request = $this->getRequest();
        if ($request->isPost()) {
            $todo = new Todo();
            $form->setInputFilter($todo->getInputFilter());

            $form->setData($request->getPost());

            if ($form->isValid()) {
                $todo = $form->getData();
                $this->getTodoTable()->saveTodo($todo);
                return $this->redirect()->toRoute('todo');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('todo', array(
                'action' => 'add'
            ));
        }
        $todo = $this->getTodoTable()->getTodo($id);
	    $form = $this->getServiceLocator()->get('TodoForm');
        $translator = $this->getServiceLocator()->get('translator');
        $form->bind($todo);
        $form->get('submit')->setAttribute('value', $translator->translate('Edit', 'todo'));

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($todo->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getTodoTable()->saveTodo($form->getData());
                return $this->redirect()->toRoute('todo');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('todo');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getTodoTable()->deleteTodo($id);
            }

            return $this->redirect()->toRoute('todo');
        }

        return array(
            'id' => $id,
            'todo' => $this->getTodoTable()->getTodo($id)
        );
    }
}
