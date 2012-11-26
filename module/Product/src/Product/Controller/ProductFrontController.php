<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Product\Model\Product;

class ProductFrontController extends AbstractActionController
{

    protected $productMapper;
    protected $productImageMapper;

    protected function setLayout()
    {
        $this->layout('layout/front-layout');
    }

    public function getProductImageMapper()
    {
        $this->setLayout();
        if (!$this->productImageMapper) {
            $sm = $this->getServiceLocator();
            $this->productImageMapper = $sm->get('Product\Model\Mapper\Image');
        }
        return $this->productImageMapper;
    }

    public function getProductMapper()
    {
        $this->setLayout();

        if (!$this->productMapper) {
            $sm = $this->getServiceLocator();
            $this->productMapper = $sm->get('Product\Model\Mapper\Product');
        }
        return $this->productMapper;
    }

    public function indexAction()
    {
        $this->setLayout();

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->redirect()->toRoute('product-front', array('action' => 'list'));
        }
        $product = $this->getProductMapper()->findById($id);
        if (!$product) {
            $this->redirect()->toRoute('product-front', array('action' => 'list'));
        }
        $images = $this->getProductImageMapper()->findByProduct($id);
        $firstImage = $this->getProductImageMapper()->getFirstImage($id);
        return array('product' => $product, 'images' => $images, 'firstImage' => $firstImage);
    }

    public function listAction()
    {
        $this->setLayout();

        $images = $this->getProductImageMapper()->getAllFirstImage();
        return array('images' => $images);
    }

    public function categoryAction()
    {
        $this->setLayout();

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->redirect()->toRoute('product-front', array('action' => 'list'));
        }
        $products = $this->getProductMapper()->fetchProductByCategory($id);
        return array('products' => $products, 'imageMapper' => $this->getProductImageMapper());
    }

}