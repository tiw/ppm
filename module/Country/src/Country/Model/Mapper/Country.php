<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ting
 * Date: 13-5-18
 * Time: 下午4:36 
 */

namespace Country\Model\Mapper;

use Tiddr\Mapper\Base;

class Country extends Base
{
    protected $tableName = 'country';


    public function getIdByName($name)
    {
        $select = $this->getSelect()->where(array('name' => $name));
        return $this->select($select)->current();

    }

}