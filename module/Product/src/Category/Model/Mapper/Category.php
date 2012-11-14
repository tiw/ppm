<?php

namespace Category\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;

/**
 * Description of Category
 *
 * @author wangting
 */
class Category extends AbstractDbMapper
{

    protected $tableName = 'category';
    public function findById($id)
    {
        $select = $this->getSelect()->where(array('id' => $id));
        return $this->select($select)->current();
    }

    public function fetchAll()
    {
        return $this->select($this->getSelect());
    }

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setId($result->getGeneratedValue());
        return $entity;
    }

    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'id = ' . $entity->getId();
        }
        return parent::update($entity, $where, $tableName, $hydrator);
    }

    public function deleteById($id, $tableName = null)
    {
        $where = 'id = ' . $id;
        parent::delete($where, $tableName);
    }
}

?>
