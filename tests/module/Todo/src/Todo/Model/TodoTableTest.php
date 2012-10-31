<?php
namespace Todo\Model;

use PHPUnit_Framework_TestCase;
use Zend\Db\ResultSet\ResultSet;

class TodoTableTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        \Zend\Mvc\Application::init(include 'config/application.config.php');
    }

    public function testFetchAllReturnsAllTodos()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
            array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with()
            ->will($this->returnValue($resultSet));

        $todoTable = new TodoTable($mockTableGateway);

        $this->assertSame($resultSet, $todoTable->fetchAll());
    }

    public function testCanRetrieveATodoByItsId()
    {
        $todo = new Todo();
        $todo->exchangeArray(array('id' => 12, 'description' => 'dd', 'status' => 'done'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Todo());
        $resultSet->initialize(array($todo));

        $mockTableGateway = $this->getMock(
            'Zend\Db\TableGateway\TableGateway',
            array('select'), array(), '', false
        );
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 12))
            ->will($this->returnValue($resultSet));
        $todoTable = new TodoTable($mockTableGateway);
        $this->assertSame($todo, $todoTable->getTodo(12));
    }

    public function testCanDeleteATodoByItsId()
    {
        $mockTableGateway = $this->getMock(
            'Zend\Db\TableGateway\TableGateway',
            array('delete'), array(), '', false
        );
        $mockTableGateway->expects($this->once())
            ->method('delete')
            ->with(array('id' => 12));

        $todoTable = new TodoTable($mockTableGateway);
        $todoTable->deleteTodo(12);
    }

    public function testSaveTodoWillInsertNewTodoIfTheyDontAlreadyHaveAnId()
    {
        $todoData = array('description' => 'finish business plan', 'status' => 'open');
        $todo     = new Todo();
        $todo->exchangeArray($todoData);

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('insert')
            ->with($todoData);

        $todoTable = new TodoTable($mockTableGateway);
        $todoTable->saveTodo($todo);
    }

    public function testSaveTodoWillUpdateExistingTodoIfTheyAlreadyHaveAnId()
    {
        $todoData = array('id' => 123, 'description' => 'write bp', 'status' => 'open');
        $todo     = new Todo();
        $todo->exchangeArray($todoData);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Todo());
        $resultSet->initialize(array($todo));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
            array('select', 'update'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));
        $mockTableGateway->expects($this->once())
            ->method('update')
            ->with(array('description' => 'write bp', 'status' => 'open'),
                array('id' => 123));

        $todoTable = new TodoTable($mockTableGateway);
        $todoTable->saveTodo($todo);
    }

    public function testExceptionIsThrownWhenGettingNonexistentTodo()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Todo());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
            ->method('select')
            ->with(array('id' => 123))
            ->will($this->returnValue($resultSet));

        $todoTable = new TodoTable($mockTableGateway);

        try
        {
            $todoTable->getTodo(123);
        }
        catch (\Exception $e)
        {
            $this->assertSame('Could not find row 123', $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
    

}
