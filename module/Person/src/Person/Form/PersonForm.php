<?php
namespace Person\Form;
use Zend\Form\Form;
use Zend\Form\Element\File;
/**
 * User: wangting
 * Date: 12-11-28
 * Time: 上午9:56
 * copyright 2012 tiddr.de
 */
class PersonForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('person-form', $options = array());
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
            'name' => 'description',
            'attributes' => array(
                'type' => 'textarea',
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));

        $file = new File('image');
        $file->setLabel('Image');
        $this->add($file);

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
