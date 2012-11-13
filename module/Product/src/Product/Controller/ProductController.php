<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Product\Model\Product;
/**
 * Description of ProductController
 *
 * @author wangting
 */
class ProductController extends AbstractActionController
{

    protected $productMapper;

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
        return array('products' => $this->getProductMapper()->fetchAll());
    }

    public function addAction()
    {
        $form = $this->getServiceLocator()->get('ProductForm');
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $product = new Product;
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $product = $form->getData();
                $mapper = $this->getProductMapper();
                $mapper->insert($product);
                return $this->redirect()->toRoute('product');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('product', array(
                'action' => 'add',
            ));
        }
        $product = $this->getProductMapper()->findById($id);
        $form = $this->getServiceLocator()->get('ProductForm');
        $form->bind($product);
        $form->get('submit')->setValue('Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getProductMapper()->update($form->getData());
                return $this->redirect()->toRoute('product');
            }
        }
        return array('id' => $id, 'form' => $form);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('product');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->getProductMapper()->deleteById($id);
            }
            return $this->redirect()->toRoute('product');
        }
        return array('id' => $id, 'product' => $this->getProductMapper()->findById($id));
    }

}

?>
