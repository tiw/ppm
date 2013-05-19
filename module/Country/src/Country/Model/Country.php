<?php
namespace Country\Model;
/**
 * Created by JetBrains PhpStorm.
 * User: ting
 * Date: 13-5-18
 * Time: 下午4:33 
 */

class Country
{
    /**
     * @var int
     */
    private $_id;

    /**
     * @var string
     */
    private $_name;

    /**
     * @var bool
     */
    private $_isPrimary;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param boolean $isPrimary
     */
    public function setIsPrimary($isPrimary)
    {
        $this->_isPrimary = $isPrimary;
    }

    /**
     * @return boolean
     */
    public function getIsPrimary()
    {
        return $this->_isPrimary;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

}