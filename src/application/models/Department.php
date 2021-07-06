<?php


namespace models;

use core\Model;

class Department extends Model
{
    protected string $tableName = "departments";
    protected array $fields = ['name'];

    public function get(array $parameters = null)
    {
        return $this->select(null, $parameters);
    }

    public function create($data)
    {
        return $this->insert($data);
    }

    public function update($dataPost, $id)
    {
        return parent::update($dataPost, $id);
    }

    public function delete(array $parameters)
    {
        return parent::delete($parameters);
    }
}
