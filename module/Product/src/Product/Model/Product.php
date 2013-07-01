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
     * @var int sub category id
     */
    protected $subCategoryId;

    /**
     * The id of the author
     * @var type int
     */
    protected $authorId;

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

    protected $parameters;

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    protected $style;

    public function setStyle($style)
    {
        $this->style = $style;
    }

    public function getStyle()
    {
        return $this->style;
    }

    /**
     * category name
     * @var string
     */
    protected $subCategoryName;

    /**
     * Description of the product
     * @var string
     */
    protected $description;

    protected $description2;

    protected $description3;

    public function setDescription3($description3)
    {
        $this->description3 = $description3;
    }

    public function getDescription3()
    {
        return $this->description3;
    }

    public function setDescription2($description2)
    {
        $this->description2 = $description2;
    }

    public function getDescription2()
    {
        return $this->description2;
    }
    /**
     * From which country
     * @var type string
     */
    protected $countryId;

    /**
     * in which kind of material
     * @var type string
     */
    protected $material;

    /**
     * when the product is added
     * @var type date
     */
    protected $createdAt;



    public function getCountryId()
    {
        return $this->countryId;
    }
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;
    }
    public function getMaterial()
    {
        return $this->material;
    }
    public function setMaterial($material)
    {
        $this->material = $material;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

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

    /**
     * @param int $subCategoryId
     */
    public function setSubCategoryId($subCategoryId)
    {
        $this->subCategoryId = $subCategoryId;
    }

    /**
     * @return int
     */
    public function getSubCategoryId()
    {
        return $this->subCategoryId;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
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

    public function readSubCategoryName()
    {
        return $this->subCategoryName;
    }

    public function writeSubCategoryName($name)
    {
        $this->subCategoryName = $name;
    }
}

?>
