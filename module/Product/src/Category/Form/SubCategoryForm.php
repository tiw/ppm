<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ting
 * Date: 13-4-30
 * Time: 上午9:46
 * To change this template use File | Settings | File Templates.
 */

namespace Category\Form;

use Zend\Form\Form;

class SubCategoryForm extends Form
{
    public function __construct()
    {
        parent::__construct('sub_category');
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