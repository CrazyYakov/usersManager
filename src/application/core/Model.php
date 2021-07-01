<?php

namespace core;

use PDOException;
use services\DataBase;
use services\Validate;
use PDO;

class Model extends DataBase
{
    private PDO $db;
    protected string $tableName;
    protected array $fields;
    public string $id;

    protected function defineModel($table, $fields)
    {
        $this->tableName = $table;
        $this->fields = $fields;
        $this->db = parent::getInstance();
    }

    public function insert(array $dataPost): bool
    {
        unset($dataPost['submit']);
        if (!Validate::isCorrectFields($this->fields, $dataPost)) {
            return false;
        }

        $values = implode(",:", $this->fields);
        $field = implode(',', $this->fields);

        $query = "INSERT INTO $this->tableName ($field) VALUES (:$values)";

        $stmt = $this->db->prepare($query);

        foreach ($this->fields as $field) {
            $stmt->bindValue(":$field", $dataPost[$field]);
        }
        if ($stmt->execute()) {
            $this->id = $this->lastInsertId();
            return true;
        } else {
            return false;
        }

    }

    protected function select(string $query = null) :array
    {
        $query = $query ?? "SELECT * FROM $this->tableName";
        try {
            $stmt = ($this->db)->query($query);
            if (!$stmt) {
                throw new PDOException('query is not work');
            }
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error:  {$e->getMessage()}";
            exit();
        }
    }

    public function selectModel($id) :array
    {
        $query = "SELECT * FROM $this->tableName WHERE id = $id";
        return $this->select($query);
    }

    public function getFields() : array
    {
        return $this->fields;
    }


    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function delete($id)
    {

        $query = "delete FROM {$this->tableName} where id = $id";
        return $this->select($query);
    }

    public function update($dataPost, $id)
    {
        unset($dataPost['submit']);
        if (!Validate::isCorrectFields($this->fields, $dataPost)) {
            return false;
        }
        $valuesUpdate = "";
        foreach ($this->fields as $field){
            $valuesUpdate .= "{$field} = :$field, ";
        }
        $valuesUpdate = preg_replace('/, $/', '', $valuesUpdate);

        $query = "UPDATE {$this->tableName} SET {$valuesUpdate} WHERE id = $id";

        $stmt = $this->db->prepare($query);

        foreach ($this->fields as $field) {
            $stmt->bindValue(":$field", $dataPost[$field]);
        }
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}