<?php
namespace Country\Controller;
/**
 * Created by JetBrains PhpStorm.
 * User: ting
 * Date: 13-5-18
 * Time: 下午4:25
 * To change this template use File | Settings | File Templates.
 */

use Country\Model\Country;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
/**
 * Class Country
 * @package Country\Controller
 */


class CountryController extends AbstractActionController
{
    public function indexAction()
    {
        $sm = $this->getServiceLocator();
        $countries = $sm->get('Country\Model\Mapper\Country')->fetchAll();
//        $countries->setCurrentPageNumber($this->params()->fromRoute('page'));
        return array(
            'title' => 'List of countries',
            'countries' => $countries,
        );
    }

    public function addAction()
    {
        $sm = $this->getServiceLocator();
        $countryForm = $sm->get('CountryForm');
        if ($this->getRequest()->isPost()) {
            $countryForm->setData($this->getRequest()->getPost());
            if($countryForm->isValid()) {
                $country = new Country();
                $country->setName($this->getRequest()->getPost()->name);
                if ($this->getRequest()->getPost()->isPrimary === '1') {
                    $country->setIsPrimary(true);
                } else {
                    $country->setIsPrimary(false);
                }
                $sm->get('Country\Model\Mapper\Country')->insert($country);
                $this->redirect()->toRoute('country');
            }
        }
        return array(
            'countryForm' => $countryForm,
            'title' => 'Add new country'
        );
    }


    public function editAction()
    {
        $sm = $this->getServiceLocator();
        $countryId = $this->params()->fromRoute('id');
        $country = $sm->get('Country\Model\Mapper\Country')
            ->findById($countryId);
        $form = $sm->get('CountryForm');
        $form->bind($country);
        $form->get('submit')->setAttribute('value', 'Edit');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $data = $request->getPost();
            var_dump($data);
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $sm->get('Country\Model\Mapper\Country')->update($form->getData());
                return $this->redirect()->toRoute('country');
            }
        }

        return array(
            'id' => $countryId,
            'form' => $form,
        );
    }


    public function getCountryMapper()
    {
        return $this->getServiceLocator()->get('Country\Model\Mapper\Country');
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('country');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->getCountryMapper()->deleteById($id);
            }
            return $this->redirect()->toRoute('country');
        }
        return array(
            'id' => $id,
            'country' => $this->getCountryMapper()->findById($id),
        );
    }
}