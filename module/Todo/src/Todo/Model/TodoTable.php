<?php

namespace Todo\Model;

use Zend\Db\TableGateway\TableGateway;

class TodoTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
	$select = $this->tableGateway->getSql()->select();
	$select->join(array('u' => 'user'), 'assignto = u.user_id');
	$statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($select);
	return $results = $statement->execute();

        //$resultSet = $this->tableGateway->selectWith($select);
	//return $resultSet;
    }

    public function getTodo($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveTodo(Todo $todo)
    {
        $data = array(
            'description' => $todo->description,
            'status' => $todo->status,
            'assignto' => $todo->assignTo,
            'priority' => $todo->priority,
        );

        $id = (int) $todo->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getTodo($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id dose not exist');
            }
        }
    }

    public function deleteTodo($id)
    {
        $this->tableGateway->delete((array('id' => $id)));
    }
}
