<?php

namespace models;

use core\Model;


class User extends Model
{
    protected string $tableName = "users";
    protected array $fields = ['name', 'job_id', 'department_id', 'salary', 'birthday'];

    protected array $fieldsName = [
        'id' => 'ID',
        'name' => 'Имя',
        'job' => 'Профессия',
        'department' => 'Департамент',
        'salary' => 'Зарплата',
        'birthday' => 'День рождение',
        'created_at' => 'Дата регистрации'
    ];

    public function get(array $parameters = null)
    {
        return $this->select(null, $parameters);
    }

    public function getUsers(array $filter = null)
    {
        $query = <<< EOT
        SELECT
                users.id as "id",
                users.name as "Имя",
                job.name as "Профессия",
                department.name as "Департамент",
                users.salary "Зарплата",
                users.birthday "День рождение",
                users.created_at "Дата регистрации"
        FROM USERS
        LEFT JOIN DEPARTMENTS as department on department.id = USERS.department_id
        LEFT JOIN JOBS        as job on job.id = USERS.job_id
        EOT;

        $orderBy = "job.name, department.name";

        return $this->select($query, $filter, $orderBy);
    }
}
