<?php

namespace core;

use services\PostgresDataBase;


class Model extends Repository
{
    public array $data = [];
    protected array $fieldsName;

    public function __construct()
    {
        $this->defineModel(
            $this->tableName ?? null,
            $this->fields ?? null,
            PostgresDataBase::getInstance()
        );
    }

    public function getFields(): array
    {
        if (!empty($this->fieldsName)) {
            return array_filter($this->fieldsName);
        }
        return parent::getFields();
    }

    public function select(string $query = null, array $values = null, string $orderBy = null)
    {
        if ($result = parent::select($query, $values, $orderBy)) {
            //Если пустой fieldsName, то задаем для запроса
            if (empty($this->fieldsName)) {
                $this->fieldsName = array_map(function ($field) {
                    if (!is_int($field)) {
                        return $field;
                    }
                    return null;
                }, array_keys($result[0]));
            }
            //Перегрузка свойст для полей модели
            if (count($result) == 1) {
                foreach ($result as $row) {
                    for ($i = 0; $i < count($row); $i++) {
                        if (!is_int(array_keys($row)[$i])) {
                            $this->data[array_keys($row)[$i]] = $row[array_keys($row)[$i]];
//                            $this->__set(array_keys($row)[$i],$row[array_keys($row)[$i]] );
                        }
                    }
                }
            }
        }
        return $result;
    }

    public function insert(?array $dataPost): bool
    {
        if (!$result = parent::insert($dataPost)) {
            return false;
        }
        //перегружаем свойства
        $this->select(null, ['id' => $this->db->lastInsertId()]);
        return $result;
    }

    public function update(array $dataPost, array $parameters): bool
    {

        if (!$result = parent::update($dataPost, $parameters)) {
            return false;
        }
        //перегружаем свойства
        $this->select(null, $parameters);
        return $result;
    }

    public function delete(array $parameters)
    {
        return parent::delete($parameters);
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
}
