<?php

namespace Todo\Model;

use Zend\Stdlib\Hydrator\ObjectProperty;

class TodoHydrator extends ObjectProperty
{

    public function extract($object)
    {

        $data = parent::extract($object);
        return $this->mapField('assignTo', 'assignto', $data);
    }

    public function hydrate(array $data, $object)
    {
        $data = $this->mapField('assignto', 'assignTo', $data);
        return parent::hydrate($data, $object);
    }

    protected function mapField($keyFrom, $keyTo, array $array)
    {
        $array[$keyTo] = $array[$keyFrom];
        unset($array[$keyFrom]);
        return $array;
    }

}