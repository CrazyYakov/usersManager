<?php


namespace models;

use core\Model;
use services\PostgresDataBase as db;

class Job extends Model
{
    protected string $tableName = "jobs";
    protected array $fields = ['name'];


    public function get(array $parameters = null)
    {
        return $this->select(null, $parameters);
    }

    public function create($data)
    {
        return $this->insert($data);
    }


    public function update(array $dataPost,array $parameters)
    {
        return parent::update($dataPost, $parameters);
    }

    public function delete($parameters)
    {
        return parent::delete($parameters);
    }
}
