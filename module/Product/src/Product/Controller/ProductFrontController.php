<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Product\Model\Product;

class ProductFrontController extends AbstractActionController
{

    protected $productMapper;

    protected $productImageMapper;

    public function getProductImageMapper()
    {
        if (!$this->productImageMapper) {
            $sm = $this->getServiceLocator();
            $this->productImageMapper = $sm->get('Product\Model\Mapper\Image');
        }
        return $this->productImageMapper;
    }

    public function getProductMapper()
    {
        if (!$this->productMapper) {
            $sm = $this->getServiceLocator();
            $this->productMapper = $sm->get('Product\Model\Mapper\Product');
        }
        return $this->productMapper;
    }

    public function indexAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->redirect()->toRoute('product-front', array('action' => 'list'));
        }
        $product = $this->getProductMapper()->findById($id);
        $images  = $this->getProductImageMapper()->findByProduct($id);
        return array('product' => $product, 'images' => $images);
    }

}