<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected function setLayout()
    {
        $this->layout('layout/index-layout');
    }
    public function indexAction()
    {
        $this->setLayout();


        $currentMonth = date('Y-m');

        $countries = array(
            'France', 'Italy', 'Greece', 'Spain', 'Others regions'
        );
        $materials = array(
            'Metals', 'Gem/stone', 'Wood/bamboo', 'Glass', 'Textile'
        );

        $categories = array(
            'Necklaces', 'Earrings', 'Rings', 'Bracelets'
        );

        $decorations = array(
            'Display', 'Dangle'
        );

        $utensils = array(
            'Stationery', 'Tools'
        );

        $vintageItems = array(
            'Finery', 'Accessories'
        );

        return array(
            'name' => 'Ting',
            'currentMonth' => $currentMonth,
            'countries' => $countries,
            'materials' => $materials,
            'categories' => $categories,
            'decorations' => $decorations,
            'utensils' => $utensils,
            'vintageItems' => $vintageItems
        );
    }
}
