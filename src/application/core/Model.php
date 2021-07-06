<?php

namespace core;

use services\PostgresDataBase;


class Model extends Repository
{
    public function __construct()
    {
        $this->defineModel(
            $this->tableName ?? null,
            $this->fields ?? null,
            PostgresDataBase::getInstance()
        );
    }
}
