<?php

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ImageController extends AbstractActionController
{

    protected $productImageMapper;

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

    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->redirect()->toRoute('product-image');
        }
        $image = $this->getProductImageMapper()->findById($id);
        $form = $this->getServiceLocator()->get('ImageForm');
        $form->get('submit')->setValue('Edit');
        $form->bind($image);


        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getProductImageMapper()->update($form->getData());
                $imagePath = $image->getImagePath();
                preg_match('/_(\d+)\./', $imagePath, $match);
                $index = $match[1];
                $this->_saveFile($index, $image->getProductId(), $image);
                //return $this->redirect()->toRoute('product-image');
            }
        }


        return array('form' => $form, 'image' => $image);
    }

    private function _saveFile($index, $productId, $image = null)
    {
        $imageName = 'image';
        if ($_FILES[$imageName]['error'] == 0) {

            if (null !== $image && $image->getImagePath()) {
                $filename = __DIR__ . '/../../../../../public/' . $image->getImagePath();
                if (file_exists($filename)) {
                    unlink($filename);
                }
            }

            $suffix = array_pop(explode('.', $_FILES[$imageName]['name']));
            $generatedImageName = "product" . $productId . '_' . $index . '.' . $suffix;
            $uploadName = __DIR__ . '/../../../../../public/product_images/' . $generatedImageName;
            $imagePath = "/product_images/" . $generatedImageName;
            if ($_FILES[$imageName]['size'] == 0) {
                return;
            }
            $result = move_uploaded_file($_FILES[$imageName]['tmp_name'], $uploadName);
            if ($result) {
                if (null === $image) {
                    $image = new Image();
                    $image->setName('image' . $index);
                    $image->setProductId($productId);
                    $image->setImagePath($imagePath);
                    $image->setSequence($index);
                    $this->getProductImageMapper()->insert($image);
                } else {
                    $image->setImagePath($imagePath);
                    $this->getProductImageMapper()->update($image);
                }
            }
        }
    }

}