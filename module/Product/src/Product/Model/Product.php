<?php
namespace Product\Model;
/*
 *
 */

/**
 * Description of Product
 *
 * @author wangting
 */
class Product
{
    /**
     * product id
     * @var type int
     */
    protected $id;

    /**
     * product name
     * @var type string
     */
    protected $name;

    /**
     * The id of the product
     * @var type int
     */
    protected $categoryId;

    /**
     * Display name
     * @var type string
     */
    protected $displayName;

    /**
     * the price of the product
     * @var type decimal
     */
    protected $price;

    /**
     * Description of the product
     * @var type string
     */
    protected $description;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}

?>
