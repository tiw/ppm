<?php
namespace Product\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;

/**
 * Description of Product
 *
 * @author wangting
 */
class Product extends AbstractDbMapper
{

    protected $tableName = 'product';

    public function fetchAll()
    {
        return $this->select($this->getSelect());
    }

    public function insert($entity, $tableName = null, \Zend\Stdlib\Hydrator\HydratorInterface $hydrator = null)
    {
        parent::insert($entity, $tableName, $hydrator);
    }
}

?>
