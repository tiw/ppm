<?php
namespace Product\Model\Mapper;
use Zend\Stdlib\Hydrator\ClassMethods;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductHydrator
 *
 * @author wangting
 */
class ProductHydrator extends ClassMethods
{
    //put your code here
    public function hydrate(array $data, $object)
    {
        if (isset($data['sub_category_name'])) {
            $object->writeSubCategoryName($data['sub_category_name']);
        }
        return parent::hydrate($data, $object);
    }
}

?>
