<?php


namespace core;

use PDOException;
use services\Validate;
use PDO;

class Repository
{
    private PDO $db;
    protected string $tableName;
    protected array $fields;
    public array $data = [];

    protected function defineModel($table, $fields, $dataBase)
    {
        $this->tableName = $table;
        $this->fields = $fields;
        $this->db = $dataBase;
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
            $this->select(null, ['id' => $this->db->lastInsertId()]);
            return true;
        } else {
            return false;
        }
    }

    protected function select(string $query = null, array $values = null)
    {
        try {
            $query = $query ?? $this->selectFromTables();
            if ($values) {
                $bindValues = $this->bindValues($values, 'and');
                $query .= " WHERE $bindValues";
                $stmt = $this->db->prepare($query);
                foreach (array_keys($values) as $value) {
                    $param = preg_replace('/(\w)*[.]/', '', $value);
                    $stmt->bindValue(":$param", $values[$value]);
                }
            } else {
                $stmt = $this->db->prepare($query);
            }

            if (!$stmt->execute()) {
                throw new PDOException('query is not work');
            }
            $result = $stmt->fetchAll();

            if (count($result) == 1) {
                foreach ($result as $row) {
                    for ($i = 0; $i < count($row); $i++) {
                        if (!is_int(array_keys($row)[$i])) {
                            $this->__set(array_keys($row)[$i], $row[$i]);
                        }
                    }
                }
            }

            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    private function selectFromTables(): string
    {
        return "SELECT * FROM $this->tableName";
    }

    private function bindValues($values, $separator): string
    {
        $valuesSelect = "";
        foreach (array_keys($values) as $value) {

//            if (is_string($values[$value])){
//                $valuesSelect .= "{$value} like :%{$value}% $separator ";
//            }
            $param = preg_replace('/(\w)*[.]/', '', $value);
            $valuesSelect .= "$value = :$param $separator ";
        }
        $template = "$separator $";
        $valuesSelect = preg_replace("/$template/", '', $valuesSelect);

        return trim($valuesSelect);
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    protected function delete(array $parameters)
    {
        $query = "delete FROM $this->tableName";
        return $this->select($query, $parameters);
    }

    protected function update(array $dataPost, array $parameters)
    {
        unset($dataPost['submit']);
        if (!Validate::isCorrectFields($this->fields, $dataPost)) {
            return false;
        }

        $valuesUpdate = $this->bindValues($dataPost, ',');
        $parameterUpdate = $this->bindValues($parameters, 'and');
        $query = "UPDATE $this->tableName SET $valuesUpdate WHERE $parameterUpdate";

        $stmt = $this->db->prepare($query);

        foreach ($this->fields as $field) {
            $stmt->bindValue(":$field", $dataPost[$field]);
        }
        foreach (array_keys($parameters) as $parameter) {
            $stmt->bindValue(":$parameter", $parameters[$parameter]);
        }

        if ($stmt->execute()) {
            $this->select(null, $parameters);
            return true;
        } else {
            return false;
        }
    }

}