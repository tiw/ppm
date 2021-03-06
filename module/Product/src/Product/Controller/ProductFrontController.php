<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Product\Model\Product;
use Zend\View\Model\ViewModel;

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
        $this->layout('layout/category-layout');
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

    /**
     * get the product mapper
     *
     * @return \Product\Model\Mapper\Product
     */
    public function getProductMapper()
    {

        if (!$this->productMapper) {
            $sm = $this->getServiceLocator();
            $this->productMapper = $sm->get('Product\Model\Mapper\Product');
        }
        return $this->productMapper;
    }


    public function filterByCategoryAction()
    {
        $this->setLayout();
        $categoryId = $this->params()->fromRoute('id', '1');
        $products = $this->getProductMapper()->findProductByCategory($categoryId);
        return array(
            'products' => $products,
            'imageMapper' => $this->getProductImageMapper(),
            'personMapper' => $this->getPersonMapper()
        );
    }

    public function filterAction()
    {
        $logoMap = array(
            'season' => '/images/h3.png',
            'country' => '/images/h2.png',
            'material' => '/images/h5.png'
        );
        $this->setLayout();
        $filterName = $this->params()->fromRoute('filter-name', '');
        $filterValue = $this->params()->fromRoute('filter-value', '');
        $title = "products";
        $defaultLogo = '/images/h1.png';
        if ($filterName === 'season') {
            $aDate = $filterValue . '-1';
            $startDate =  $aDate;
            $endDate = date("Y-m-t", strtotime($aDate));
            $products = $this->getProductMapper()->getProductByBetweenFilter('created_at', $startDate, $endDate);
            $title = "the product at {$filterValue}";
        } elseif($filterName === 'category') {
            $products = $this->getProductMapper()->getProductBySubCategoryName($filterValue);
        } else {
            if ($filterName === 'country') {
                $title = $filterValue;
                $filterName = 'country_id';
                $filterValue = $this->getServiceLocator()
                    ->get('Country\Model\Mapper\Country')->getIdByName($filterValue)->getName();
            } else if ($filterName === 'material') {
                $title = $filterValue;
            }
            $products = $this->getProductMapper()->getProductByFilter($filterName, $filterValue);
        }
        return array(
            'logo' => isset($logoMap[$filterName]) ? $logoMap[$filterName] : $defaultLogo,
            'title' => $title,
            'products' => $products,
            'imageMapper' => $this->getProductImageMapper(),
            'personMapper' => $this->getPersonMapper()
        );
    }

    public function indexAction()
    {
        $this->layout('layout/product-details-layout');

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
        $country = $this->getServiceLocator()->get('Country\Model\Mapper\Country')->findById($product->getCountryId());
        return array(
            'country' => $country->getName(),
            'product' => $product,
            'images' => $images,
            'firstImage' => $firstImage,
            'imageMapper' => $this->getProductImageMapper(),
            'categoryName' => '',//$this->getCategoryMapper()->findById($product->getCategoryId())->getName(),
            'author' => $this->getPersonMapper()->findById($product->getAuthorId()),
        );
    }

    public function decorationsAction()
    {
        $this->setLayout();
        $name = $this->params()->fromRoute('name', 'Display');
        $products = $this->getProductMapper()->getProductBySubCategoryName($name);
        $view = new ViewModel(array(
            'logo' => '/images/h7.png',
            'products' => $products,
            'imageMapper' => $this->getProductImageMapper(),
            'personMapper' => $this->getPersonMapper(),
        ));
        $view->setTemplate('product/product-front/filter');
        return $view;
    }

    public function utensilsAction()
    {
        $this->setLayout();
        $name = $this->params()->fromRoute('name', 'Stationery');
        $products = $this->getProductMapper()->getProductBySubCategoryName($name);
        $view = new ViewModel(array(
            'logo' => '/images/h1.png',
            'products' => $products,
            'imageMapper' => $this->getProductImageMapper(),
            'personMapper' => $this->getPersonMapper(),
        ));
        $view->setTemplate('product/product-front/filter');
        return $view;
    }
    public function vintagesAction()
    {
        $this->setLayout();
        $name = $this->params()->fromRoute('name', 'Finery');
        $products = $this->getProductMapper()->getProductBySubCategoryName($name);
        $view = new ViewModel(array(
            'logo' => '/images/h8.png',
            'products' => $products,
            'imageMapper' => $this->getProductImageMapper(),
            'personMapper' => $this->getPersonMapper(),
        ));
        $view->setTemplate('product/product-front/filter');
        return $view;
    }
    public function omamentsAction()
    {
        $this->setLayout();
        $name = $this->params()->fromRoute('name', 'Necklaces');
        $products = $this->getProductMapper()->getProductBySubCategoryName($name);
        $view = new ViewModel(array(
            'logo' => '/images/h6.png',
            'products' => $products,
            'imageMapper' => $this->getProductImageMapper(),
            'personMapper' => $this->getPersonMapper(),
        ));
        $view->setTemplate('product/product-front/filter');
        return $view;
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
            'logo' => '/images/h6.png',
            'products' => $products,
            'imageMapper' => $this->getProductImageMapper(),
            'personMapper' => $this->getPersonMapper(),
        );
    }

}