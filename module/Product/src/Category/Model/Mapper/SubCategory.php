<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ting
 * Date: 13-4-30
 * Time: 上午9:06
 * To change this template use File | Settings | File Templates.
 */

namespace Category\Model\Mapper;
use Tiddr\Mapper\Base;


class SubCategory extends Base
{
    protected $tableName = 'sub_category';

    /**
     * get the categories all sub categories
     * @param $categoryId
     *
     * @return object
     */
    public function getSubCategory($categoryId)
    {
        return $this->select(
            $this->getSelect()->where(array('category_id' => $categoryId))
        )->current();
    }

    /**
     * get the categories primary sub categories
     * @param $categoryId
     *
     * @return object
     */
    public function getPrimarySubCategory($categoryId)
    {
        return $this->select(
            $this->getSelect()->where(array('primary' => 1, 'category_id' => $categoryId))
        )->current();
    }
}