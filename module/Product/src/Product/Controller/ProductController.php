<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Product\Model\Product;
use Product\Model\Image;

/**
 * Description of ProductController
 *
 * @author wangting
 */
class ProductController extends AbstractActionController
{

    protected $productMapper;

    protected $productImageMapper;

    public function getProductMapper()
    {
        if (!$this->productMapper) {
            $sm = $this->getServiceLocator();
            $this->productMapper = $sm->get('Product\Model\Mapper\Product');
        }
        return $this->productMapper;
    }

    public function getProductImageMapper()
    {
        if (!$this->productImageMapper) {
            $sm = $this->getServiceLocator();
            $this->productImageMapper = $sm->get('Product\Model\Mapper\Image');
        }
        return $this->productImageMapper;
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

            $form->setData($request->getPost());
            if ($form->isValid()) {
                $mapper = $this->getProductMapper();
                $product = $mapper->insert($form->getData());
                foreach (range(1, 3) as $index) {
                    $this->_saveFile($index, $product->getId());
                }
                return $this->redirect()->toRoute('product');
            }
        }
        return array('form' => $form);
    }

    /**
     * @todo: use it
     * @param type $index
     * @param type $productId
     */
    private function _saveFile($index, $productId)
    {
        $imageName = 'image' . $index;
        if ($_FILES[$imageName]['error'] == 0) {
            $suffix = array_pop(explode('.', $_FILES[$imageName]['name']));
            $generatedImageName = "product" . $productId . '_' . $index . '.' . $suffix;
            $uploadName = __DIR__ . '/../../../../../public/product_images/' . $generatedImageName;
            $imagePath = "/product_images/" . $generatedImageName;
            if ($_FILES['image' . $index]['size'] < 0) {
                return;
            }
            $result = move_uploaded_file($_FILES['image' . $index]['tmp_name'], $uploadName);
            if ($result) {
                $image = new Image();
                $image->setName('image' . $index);
                $image->setProductId($productId);
                $image->setImagePath($imagePath);
                $image->setSequence($index);
                $this->getProductImageMapper()->insert($image);
            }
        }
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
        $images = $this->getProductImageMapper()->findByProduct($id);
        return array('id' => $id, 'form' => $form, 'images' => $images);
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
