<?php
namespace Todo\Model;

class TodoTest extends \PHPUnit_Framework_TestCase
{
    public function testTodoInitialState()
    {
        $todo = new Todo();

        $this->assertNull($todo->id);
        $this->assertNull($todo->description);
        $this->assertNull($todo->status);
    }

    public function testExchangeArray()
    {
        $todo = new Todo();

        $todo->exchangeArray(
            array(
                'id' => 1,
                'description' => 'read kafuka am strand',
                'status' => 'doing'
            )
        );
        $this->assertEquals(1, $todo->id);
        $this->assertEquals('read kafuka am strand', $todo->description);
        $this->assertEquals('doing', $todo->status);
    }
}
