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

    public function get($id = null)
    {
        $query = !empty($id) ? "SELECT * FROM {$this->getTableName()} WHERE id = $id" : null;

        return $this->select($query);
    }

    public function create($data)
    {
        return $this->insert($data);
    }


    public function update($dataPost, $id)
    {
        return parent::update($dataPost, $id);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }
}
