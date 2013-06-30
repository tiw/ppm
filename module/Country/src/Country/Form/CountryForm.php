<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ting
 * Date: 13-6-30
 * Time: 上午11:36 
 */

namespace Country\Form;

use Zend\Form\Form;

class CountryForm extends Form
{
    public function __construct()
    {
        parent::__construct('country');
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
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));

        $this->add(array(
            'name' => 'is_primary',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Is Primary',
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn',
            )
        ));

    }
}