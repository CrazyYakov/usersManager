<?php


namespace models;

use core\Model;

class Department extends Model
{
    protected string $tableName = "departments";
    protected array $fields = ['name'];


    public function __construct()
    {
        $this->defineModel($this->tableName, $this->fields);
    }

    public function get(){
        return $this->select();
    }
}