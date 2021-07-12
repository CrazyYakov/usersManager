<?php


namespace models;

use core\Model;

class Job extends Model
{
    protected string $tableName = "jobs";
    protected array $fields = ['name'];
    protected array $fieldsName = ['id' => 'ID', 'name' => 'Профессия'];

    public function get(array $parameters = null)
    {
        return $this->select(null, $parameters, 'id');
    }
}
