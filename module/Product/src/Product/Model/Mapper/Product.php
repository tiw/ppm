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

    public function findById($id)
    {
        $select = $this->getSelect()->where(array('id' => $id));
        return $this->select($select)->current();
    }

    public function insert($entity, $tableName = null, \Zend\Stdlib\Hydrator\HydratorInterface $hydrator = null)
    {
        parent::insert($entity, $tableName, $hydrator);
    }


    public function update($entity, $where=null, $tableName = null, \Zend\Stdlib\Hydrator\HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'id = ' . $entity->getId();
        }
        parent::update($entity, $where, $tableName, $hydrator);
    }

    public function deleteById($id, $tableName = null)
    {
        $where = 'id = ' . $id;
        parent::delete($where, $tableName);
    }

}

?>
