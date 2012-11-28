<?php
namespace Person\Controller;
use Zend\Mvc\Controller\AbstractActionController;
/**
 * User: wangting
 * Date: 12-11-28
 * Time: 下午1:47
 * copyright 2012 tiddr.de
 */
class PersonFrontController extends AbstractActionController
{
    /**
     * @var \Person\Model\Mapper\Person
     */
    protected $personMapper = null;

    /**
     * @var \Product\Model\Mapper\Product'
     */
    protected $productMapper = null;


    protected $imageMapper = null;

    public function getImageMapper ()
    {
        if (!$this->imageMapper) {
            $this->imageMapper = $this->getServiceLocator()->get('Product\Model\Mapper\Image');
        }
        return $this->imageMapper;
    }

    /**
     * @return array|null|object|\Product\Model\Mapper\Product
     */
    public function getProductMapper ()
    {
        if (!$this->productMapper) {
            $this->productMapper = $this->getServiceLocator()->get('\Product\Model\Mapper\Product');
        }
        return $this->productMapper;
    }

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
    public function indexAction()
    {
        $this->setLayout();
        $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->redirect('person-front', array('action', 'list'));
        }

        $person = $this->getPersonMapper()->findById($id);
        $personsProduct = $this->getProductMapper()->getProductByFilter('author_id', $id);
        return array(
            'person' => $person,
            'products' => $personsProduct,
            'imageMapper' => $this->getImageMapper(),
            'personMapper' => $this->getPersonMapper(),
        );
    }

}
