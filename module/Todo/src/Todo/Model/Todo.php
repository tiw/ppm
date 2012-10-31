<?php
namespace Todo\Model;

class Todo
{
    public $id;
    public $description;
    public $status;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->status = (isset($data['status'])) ? $data['status'] : null;
    }
}
