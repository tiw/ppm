<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Product\Model\Mapper\ProductHydrator;

class ProductRestController extends AbstractRestfulController
{

    protected $productMapper = null;
    public function getProductMapper()
    {
        if (!$this->productMapper) {
            $sm = $this->getServiceLocator();
            $this->productMapper = $sm->get('Product\Model\Mapper\Product');
        }
        return $this->productMapper;
    }

    public function getList()
    {
        $products = $this->getProductMapper()->fetchAll();
        $productArray = array();
        $productHydrate = new ProductHydrator();
        foreach($products as $product) {
            $productArray[] = $productHydrate->extract($product);
        }
        return new JsonModel(
            $productArray
            //$products->toJson()
        );
    }

    public function get($id)
    {
        
    }

    public function create($data)
    {
        
    }

    public function update($id, $data)
    {
        
    }

    public function delete($id)
    {
        
    }
}
