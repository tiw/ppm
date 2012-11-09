<?php

namespace Todo\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class TodoForm extends Form
{

    private $_userMapper;

    public function setUserMapper($userMapper)
    {
        $this->_userMapper = $userMapper;
    }

    public function getUserMapper()
    {
        return $this->_userMapper;
    }

    public function __construct($name = null)
    {
        parent::__construct('todo');
    }

    public function init()
    {
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));

        $statusOptions = array(
            'new' => '新任务',
            'processing' => '进行中',
            'finished' => '完成',
            'closed' => '关闭',
        );

        $status = new Select('status');
        $status->setLabel('状态');
        $status->setValueOptions($statusOptions);
        $this->add($status);


        $allUsers = $this->getUserMapper()->fetchAll();
        $options = array();
        foreach ($allUsers as $user) {
            $options[$user->getId()] = $user->getUsername();
        }

        $assignTo = new Select('assignto');
        $assignTo->setLabel('Assign To');
        $assignTo->setValueOptions($options);
        $this->add($assignTo);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }

}
