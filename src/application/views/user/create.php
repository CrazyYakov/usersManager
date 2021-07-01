<?php
$this->page = 'Создание пользователя';

/**
 * @var $departments
 * @var $jobs
 */

?>

<div class="container">
    <form action="create" method="post" class="w-25 mt-5">

        <input type="text" name="name" class="form-floating">
        <label for="exampleFormControlInput1" class="form-label ">Введите имя </label>
        <br>
        <br>
        <div class="form-floating">
            <?php //if (!$departmentId && $_POST['submit']) echo "is-invalid"?>
            <select name="department_id" class="form-select ">
                <?php // if (!isset($departament)) :?>
                <option selected disabled>Выберите отдел</option>
                <?php // endif;?>
                <?php foreach ($departments as $department) : ?>
                    <option value="<?= $department['id'] ?>">
                        <?= $department['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="floatingSelectGrid" class="form-label"> Название работы</label>
        </div>

        <div class="form-floating">
            <?php //if (!$departmentId && $_POST['submit']) echo "is-invalid"?>
            <select name="job_id" class="form-select ">
                <?php // if (!isset($departament)) :?>
                <option selected disabled>Выберите работу</option>
                <?php // endif;?>
                <?php foreach ($jobs as $job) : ?>
                    <option value="<?= $job['id'] ?>">
                        <?= $job['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="floatingSelectGrid" class="form-label"> Название отдела</label>
        </div>

        <br>
        <br>
        <input type="text" name="salary" class="form-floating">
        <label for="exampleFormControlInput1" class="form-label ">Введите зарплату </label>
        <br>
        <label for="birthday">День Рождения:</label>
        <input type="date" name="birthday" class="form-floating">
        <br>
        <br>
        <label for="created_at">Дата регистрации:</label>
        <input type="date" name="created_at" class="form-floating">
        <br>
        <br>
        <input type="submit" value="Отправить" name="submit" class="btn btn-primary">

    </form>
    <br>
    <a href="/user" class="btn btn-primary">Назад</a>
</div>>