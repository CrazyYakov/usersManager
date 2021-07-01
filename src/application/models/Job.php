<?php


namespace models;

use core\Model;

class Job extends Model
{
    protected string $tableName = "jobs";
    protected array $fields = ['name'];


    public function __construct()
    {
        $this->defineModel($this->tableName, $this->fields);
    }

    public function get()
    {
        return $this->select();
    }

}