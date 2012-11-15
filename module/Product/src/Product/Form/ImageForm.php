<?php

namespace Product\Form;


use Zend\Form\Form;
use Zend\Form\Element\File;

/**
 * Description of ImageForm
 *
 * @author wangting
 */
class ImageForm extends Form
{
    public function __construct()
    {
        $name = 'product_image';
        parent::__construct($name, $options = array());
    }

    function init()
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

        $file = new File('image');
        $file->setLabel('Image');
        $this->add($file);

        $this->add(array(
            'name' => 'sequence',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Sequence',
            )
        ));

        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type' => 'textarea',
            ),
            'options' => array(
                'label' => 'Description',
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
    }
}

?>
