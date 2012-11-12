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
    public function findById($id)
    {
        $select = $this->getSelect()->where(array('id' => $id));
        return $this->select($select)->current();
    }
}

?>
