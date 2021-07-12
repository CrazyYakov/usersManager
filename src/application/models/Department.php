<?php


namespace models;

use core\Model;

class Department extends Model
{
    protected string $tableName = "departments";
    protected array $fields = ['name'];
    protected array $fieldsName = ['id' => 'ID', 'name' => 'Департамент'];

    public function get(array $parameters = null)
    {
        return $this->select(null, $parameters);
    }

}
