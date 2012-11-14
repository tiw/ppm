<?php

namespace Product\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;

class Image extends AbstractDbMapper
{
    protected $tableName = 'product_image';

    public function insert($entity, $tableName = null, \Zend\Stdlib\Hydrator\HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setId($result->getGeneratedValue());
        return $entity;
    }

    public function findByProduct($productId)
    {
        $select = $this->getSelect();
        $select->where(array('product_id' => $productId));
        return $this->select($select);
    }
}
