<?php

namespace Product\Model\Mapper;

use Category\Model\Mapper\SubCategory;
use Tiddr\Mapper\Base;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Where;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;

/**
 * Description of Product
 *
 * @author wangting
 */
class Product extends Base
{

    protected $tableName = 'product';

    /**
     * @var SubCategory
     */
    protected $subCategoryMapper;


    public function setSubCategoryMapper(SubCategory $subCategoryMapper)
    {
        $this->subCategoryMapper = $subCategoryMapper;
    }

    public function getSubCategoryMapper()
    {
        return $this->subCategoryMapper;
    }

    public function fetchAll($select = null)
    {
        if (null === $select) {
            $select = $this->getSelect();
        }
        $select->join(
            array('c' => 'sub_category'),
            'sub_category_id = c.id', array('sub_category_name' => 'name'));
        return parent::fetchAll($select);
    }

    public function getProductByFilter($filterName, $filterValue)
    {
        $select = $this->getSelect()->where(array($filterName => $filterValue));
        return $this->select($select);
    }

    public function getProductBySubCategoryName($subCategoryName)
    {
        $select = $this->getSelect();
        $select->join(
            array('c' => 'sub_category'),
            'sub_category_id = c.id',
            array('sub_category_name' => 'name')
        )->where(['c.name' => $subCategoryName]);
        return $this->select($select);
    }

    public function findProductByCategory($categoryId)
    {
        // find out all sub categories in category
        $subcategories = $this->getSubCategoryMapper()->getSubCategories($categoryId);
        $subCategoryIds = array();
        foreach($subcategories as $subCategory) {
            $subCategoryIds[] = $subCategory->getId();
        }
        // find all products in the categories
        return $this->select($this->getSelect()->where(array('sub_category_id' => $subCategoryIds)));
    }

    public function getProductByBetweenFilter($filterName, $minValue, $maxValue)
    {
        $where = new Where();
        $where->between($filterName, $minValue, $maxValue);
        $select = $this->getSelect()->where($where);
        return $this->select($select);
    }

    public function fetchProductBySubCategory($id)
    {
        return $this->select($this->getSelect()->where(array('sub_category_id' => $id)));
    }
}
