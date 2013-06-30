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
        $countries->setCurrentPageNumber($this->params()->fromRoute('page'));
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
                if ($this->getRequest()->getPost()->isPrimary === 'isPrimary') {
                    $country->setIsPrimary(true);
                } else {
                    $country->setIsPrimary(false);
                }
                $sm->get('Country\Model\Mapper\Country')->insert($country);
            }
        }
        return array(
            'countryForm' => $countryForm,
            'title' => 'Add new country'
        );
    }
}