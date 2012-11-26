<?php

namespace Product\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Element\File;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductForm
 *
 * @author wangting
 */
class ProductForm extends Form
{

    protected $categoryMapper = null;

    public function setCategoryMapper($mapper)
    {
        $this->categoryMapper = $mapper;
    }

    public function getCategoryMapper()
    {
        if (!$this->categoryMapper) {
            throw new Exception('Category Mapper is not set');
        }
        return $this->categoryMapper;
    }

    public function __construct()
    {
        $name = 'product';
        parent::__construct($name, $options=null);
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

        $categoryOptions = array();
        $allCategories = $this->getCategoryMapper()->fetchAll();
        foreach ($allCategories as $category) {
            $categoryOptions[$category->getId()] = $category->getName();
        }

        $this->add(array(
            'name'          => 'category_id',
            'type'          => 'Zend\Form\Element\Select',
            'options'       => array(
                'label'             => 'Category',
                //'hint'              => 'Hint',
                //'description'       => 'Description.',
                'value_options'     => $categoryOptions,
            ),
        ));
        
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Product name',
            )
        ));

        $this->add(array(
            'name' => 'display_name',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Product display name',
            )
        ));

        $this->add(array(
            'name' => 'price',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Price',
            ),
        ));

        $this->add(array(
            'name' => 'country',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Country'
            ),
        ));

        $this->add(array(
            'name' => 'material',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Material',
            ),
        ));

        $this->add(array(
            'name' => 'created_at',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Created At',
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

        $this->add(array(
            'name' => 'description2',
            'attributes' => array(
                'type' => 'textarea',
            ),
            'options' => array(
                'label' => 'Description2'
            )
        ));

        $this->add(array(
            'name' => 'description3',
            'attributes' => array(
                'type' => 'textarea',
            ),
            'options' => array(
                'label' => 'Description3'
            )
        ));

        $imageOne = new File('image1');
        $imageOne->setLabel('Image 1');
        $this->add($imageOne);

        $imageTwo = new File('image2');
        $imageTwo->setLabel('Image 2');
        $this->add($imageTwo);

        $imageTwo = new File('image3');
        $imageTwo->setLabel('Image 3');
        $this->add($imageTwo);


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
