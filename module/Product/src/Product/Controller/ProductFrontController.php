<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Product\Model\Product;

class ProductFrontController extends AbstractActionController
{

    protected $productMapper;
    protected $productImageMapper;
    protected $categoryMapper;
    protected $chineseSeason;
    protected $personMapper;

    public function getPersonMapper()
    {
        if (!$this->personMapper) {
            $this->personMapper = $this->getServiceLocator()->get('PersonMapper');
        }
        return $this->personMapper;
    }

    protected function setLayout()
    {
        $this->layout('layout/front-layout');
    }

    public function getProductImageMapper()
    {
        if (!$this->productImageMapper) {
            $sm = $this->getServiceLocator();
            $this->productImageMapper = $sm->get('Product\Model\Mapper\Image');
        }
        return $this->productImageMapper;
    }

    public function getSeasonService()
    {
        if (!$this->chineseSeason) {
            $sm = $this->getServiceLocator();
            $this->chineseSeason = $sm->get('SeasonService');
        }
        return $this->chineseSeason;
    }

    public function getCategoryMapper()
    {
        if (!$this->categoryMapper) {
            $sm = $this->getServiceLocator();
            $this->categoryMapper = $sm->get('Category\Model\Mapper\Category');
        }
        return $this->categoryMapper;
    }
    public function getProductMapper()
    {

        if (!$this->productMapper) {
            $sm = $this->getServiceLocator();
            $this->productMapper = $sm->get('Product\Model\Mapper\Product');
        }
        return $this->productMapper;
    }

    public function filterAction()
    {
        $this->setLayout();
        $filterName = $this->params()->fromRoute('filter-name', '');
        $filterValue = $this->params()->fromRoute('filter-value', '');
        if ($filterName === 'season') {
            list($year, $season) = explode('-', $filterValue);
            $min = $this->getSeasonService()->seasonStart($year, $season);
            $max = $this->getSeasonService()->seasonEnd($year, $season);
            $products = $this->getProductMapper()->getProductByBetweenFilter('created_at', $min, $max);
        } else {
            $products = $this->getProductMapper()->getProductByFilter($filterName, $filterValue);
        }
        return array(
            'products' => $products,
            'imageMapper' => $this->getProductImageMapper(),
            'personMapper' => $this->getPersonMapper()
        );
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
        return array(
            'product' => $product,
            'images' => $images,
            'firstImage' => $firstImage,
            'imageMapper' => $this->getProductImageMapper(),
            'categoryName' => $this->getCategoryMapper()->findById($product->getCategoryId())->getName(),
            'author' => $this->getPersonMapper()->findById($product->getAuthorId()),
        );
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
        return array(
            'products' => $products,
            'imageMapper' => $this->getProductImageMapper(),
            'personMapper' => $this->getPersonMapper(),
        );
    }

}