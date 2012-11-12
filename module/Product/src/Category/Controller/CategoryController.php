<?php
namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Category\Model\Category;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryController
 *
 * @author wangting
 */
class CategoryController extends AbstractActionController
{
    protected $categoryMapper;

    public function getCategoryMapper()
    {
        if (!$this->categoryMapper) {
            $sm = $this->getServiceLocator();
            $this->categoryMapper = $sm->get('Category\Model\Mapper\Category');
        }
        return $this->categoryMapper;
    }
    public function indexAction()
    {

    }

    public function addAction()
    {
        $form = $this->getServiceLocator()->get('CategoryForm');
        $translator = $this->getServiceLocator()->get('translator');
        $form->get('submit')->setValue($translator->translate('Add', 'category'));

        $request = $this->getRequest();

        if ($request->isPost()) {
            $category = new Category();
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $category  = $form->getData();
                $mapper = $this->getCategoryMapper();
                $mapper->insert($category);
                return $this->redirect()->toRoute('category');

            }
        }
        return array('form' => $form);
    }
}

?>
