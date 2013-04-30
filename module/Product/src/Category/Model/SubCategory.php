<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ting
 * Date: 13-4-30
 * Time: 上午9:03
 * To change this template use File | Settings | File Templates.
 */

namespace Category\Model;


class SubCategory
{
    protected $id;

    protected $name;

    protected $isPrimary;

    protected $categoryId;

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;
    }

    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

}