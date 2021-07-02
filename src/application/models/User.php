<?php

namespace models;

use core\Model;


class User extends Model
{
    protected string $tableName = "users";
    protected array $fields = ['name', 'job_id', 'department_id', 'salary', 'birthday', 'created_at'];

    public function __construct()
    {
        $this->defineModel($this->tableName, $this->fields);
    }

    public function get($id = null)
    {
        $query = !empty($id) ? "SELECT * FROM USERS WHERE id = $id" : null;

        return $this->select($query);
    }

    public function getUser($id)
    {
        $query = <<< EOT
         SELECT
                users.id as ID,
                users.name as name,
                job.name as job,
                dep.name as department,
                users.salary,
                users.birthday,
                users.created_at               
        FROM USERS
        LEFT JOIN DEPARTMENTS as dep on dep.id = USERS.department_id
        LEFT JOIN JOBS        as job on job.id = USERS.job_id
        WHERE users.id = {$id}
        EOT;
        return $this->select($query);
    }

    public function getAll()
    {
        $query = <<< EOT
        SELECT
                users.id as ID,
                users.name as name,
                job.name as job,
                dep.name as department,
                users.salary,
                users.birthday,
                users.created_at               
        FROM USERS
        LEFT JOIN DEPARTMENTS as dep on dep.id = USERS.department_id
        LEFT JOIN JOBS        as job on job.id = USERS.job_id
        ORDER BY users.id
        EOT;
        return $this->select($query);
    }

    public function create($data)
    {
        return $this->insert($data);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }

    public function updateUser()
    {

    }

}
