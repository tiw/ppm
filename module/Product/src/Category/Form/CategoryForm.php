<?php
namespace Category\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

/**
 * Description of CategoryForm
 *
 * @author wangting
 */
class CategoryForm extends Form
{

    public function __construct()
    {
        parent::__construct('category');
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

?>
