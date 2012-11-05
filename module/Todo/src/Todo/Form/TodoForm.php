<?php

namespace Todo\Form;

use Zend\Form\Form;
use User\Model\Mapper\User as UserMapper;

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
        $this->add(array(
            'name' => 'status',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => 'Status',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

        $allUsers = $this->getUserMapper()->fetchAll();
        echo count($allUsers);
        foreach($allUsers as $user) {
            var_dump($user);
            echo $user->getId();
        }
        die;
    }
}
