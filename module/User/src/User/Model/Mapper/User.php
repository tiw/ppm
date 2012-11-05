<?php

namespace User\Model\Mapper;

use ZfcUser\Mapper\User as ZfcUserMapper;

class User extends ZfcUserMapper
{
    /**
     * get all users
     * @return Zend\Db\ResultSet\HydratingResultSet
     */
    public function fetchAll()
    {
        return $this->select($this->getSelect());
    }
}
