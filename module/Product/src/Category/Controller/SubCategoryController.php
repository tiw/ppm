<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ting
 * Date: 13-4-30
 * Time: 上午9:35
 * To change this template use File | Settings | File Templates.
 */

namespace Category\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Category\Model\SubCategory;

class SubCategoryController extends AbstractActionController
{

    protected $subCategoryMapper;

    public function getSubCategoryMapper()
    {
        if (!$this->subCategoryMapper) {
            $sm = $this->getServiceLocator();
            $this->subCategoryMapper = $sm->get('Category\Model\Mapper\SubCategory');
        }
        return $this->subCategoryMapper;
    }

    public function addAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
//        if (!$id) {
//            $this->redirect()->toRoute('category');
//        }

        $form = $this->getServiceLocator()->get('SubCategoryForm');
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $data->setCategoryId($id);
                $this->getSubCategoryMapper()->insert($data);
            }
            $this->redirect()->toRoute('category', array('action' => 'edit', 'id' => $id));
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->redirect()->toRoute('sub-category');
        }
        $image = $this->getSubCategoryMapper()->findById($id);
        $form = $this->getServiceLocator()->get('SubCategoryForm');
        $form->get('submit')->setValue('Edit');
        $form->bind($image);


        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getSubCategoryMapper()->update($form->getData());
            }
        }
        return array('form' => $form, 'image' => $image);
    }
}