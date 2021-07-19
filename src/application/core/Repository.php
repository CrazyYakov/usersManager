<?php


namespace core;

use PDOException;
use PDO;

class Repository
{
    protected PDO $db;
    protected string $tableName;
    protected array $fields;

    use \traits\Helpers;

    protected function defineModel($table, $fields, $dataBase)
    {
        $this->tableName = $table;
        $this->fields = $fields;
        $this->db = $dataBase;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function insert(?array $dataPost): bool
    {
        unset($dataPost['submit']);
        $dataPost = array_filter($dataPost);
        if (!$this->hastFields($this->fields, $dataPost)) {
            return false;
        }
        $values = implode(",:", array_keys($dataPost));
        $field = implode(',', array_keys($dataPost));
        $query = "INSERT INTO $this->tableName ($field) VALUES (:$values)";

        $stmt = $this->db->prepare($query);
        foreach (array_keys($dataPost) as $field) {
            $stmt->bindValue(":$field", $dataPost[$field]);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    protected function select(string $query = null, array $values = null, string $orderBy = null)
    {
        try {
            $query = $query ?? $this->selectFromTable();
            if ($values) {
                $bindValues = $this->bindValues($values, 'and');
                $query .= " WHERE $bindValues";
                $query .= $orderBy ? " ORDER BY $orderBy" : null;
                $stmt = $this->db->prepare($query);
                foreach (array_keys($values) as $value) {
                    $param = preg_replace('/(\w)*[.]/', '', $value);
                    $stmt->bindValue(":$param", $values[$value]);
                }
            } else {
                $query .= $orderBy ? " ORDER BY $orderBy" : null;
                $stmt = $this->db->prepare($query);
            }

            if (!$stmt->execute()) {
                throw new PDOException('query is not work');
            }
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return false;
        }
    }


    protected function delete(array $parameters)
    {
        if ($parameters == null){
            return false;
        }

        $query = "delete FROM $this->tableName";
        return $this->select($query, $parameters);
    }

    protected function update(array $dataPost, array $parameters): bool
    {
        unset($dataPost['submit']);

        if (!$this->hastFields($this->fields, $dataPost)) {
            return false;
        }

        $valuesUpdate = $this->bindValues($dataPost, ',');
        $parameterUpdate = $this->bindValues($parameters, 'and');
        $query = "UPDATE $this->tableName SET $valuesUpdate WHERE $parameterUpdate";

        $stmt = $this->db->prepare($query);

        foreach (array_keys($dataPost) as $field) {
            $stmt->bindValue(":$field", $dataPost[$field]);
        }

        foreach (array_keys($parameters) as $parameter) {
            $stmt->bindValue(":$parameter", $parameters[$parameter]);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private function selectFromTable(): string
    {
        return "SELECT * FROM $this->tableName";
    }

    private function bindValues($values, $separator): string
    {
        $valuesSelect = "";
        foreach (array_keys($values) as $value) {

            if (!is_int(intval($values[$value]))) {
                $param = preg_replace('/(\w)*[.]/', '', $value);
                $valuesSelect .= "$value like :$param% $separator ";
            } else {
                $param = preg_replace('/(\w)*[.]/', '', $value);
                $valuesSelect .= "$value = :$param $separator ";
            }

        }
        $pattern = "$separator $";
        $valuesSelect = preg_replace("/$pattern/", '', $valuesSelect);

        return trim($valuesSelect);
    }
}