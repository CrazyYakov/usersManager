<?php
$this->page = 'Обновить характеристику пользователя';

/**
 * @var $departments
 * @var $jobs
 * @var $user
 */
?>
<div class="container">
    <form action="/user/update?id=<?= $_GET['id'] ?>" method="post" class="w-25 mt-5">

        <input type="text" name="name" class="form-floating" value="<?= $user[0]['name'] ?>">
        <label for="exampleFormControlInput1" class="form-label">Введите имя </label>
        <br>
        <br>
        <div class="form-floating">
            <?php //if (!$departmentId && $_POST['submit']) echo "is-invalid"?>
            <select name="department_id" class="form-select">
                <?php // if (!isset($departament)) :?>
                <option selected disabled>Выберите отдел</option>
                <?php // endif;?>
                <? foreach ($departments as $department) : ?>
                    <option
                            value="<?= $department['id'] ?>"
                        <? if ($department['id'] == $user[0]['department_id']) : ?> selected <? endif; ?>
                    >
                        <?= $department['name'] ?>
                    </option>

                <?php endforeach; ?>
            </select>
            <label for="floatingSelectGrid" class="form-label"> Название отдела</label>
        </div>

        <div class="form-floating">
            <?php //if (!$departmentId && $_POST['submit']) echo "is-invalid"?>
            <select name="job_id" class="form-select ">
                <?php // if (!isset($departament)) :?>
                <option selected disabled>Выберите работу</option>
                <?php // endif;?>
                <?php foreach ($jobs as $job) : ?>
                    <option
                            value="<?= $job['id'] ?>"
                        <? if ($job['id'] == $user[0]['job_id']) : ?> selected <? endif; ?>
                    >
                        <?= $job['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="floatingSelectGrid" class="form-label"> Название работы</label>
        </div>

        <br>
        <br>
        <input type="text" name="salary" class="form-floating" value="<?= $user[0]['salary'] ?>">
        <label for="exampleFormControlInput1" class="form-label ">Введите зарплату </label>
        <br>
        <label for="birthday">День Рождения:</label>
        <input type="date" name="birthday" class="form-floating"
               value="<?= $user[0]['birthday'] ?>">
        <br>
        <br>
        <label for="created_at">Дата регистрации:</label>
        <input type="date" name="created_at" class="form-floating"
               value="<?= $user[0]['created_at'] ?>">
        <br>
        <br>
        <input type="submit" value="Сохранить" name="submit" class="btn btn-primary">

    </form>
    <br>
    <a href="<?=($_SERVER['HTTP_REFERER'] ?? "/user") ?>" class="btn btn-primary">Назад</a>
</div>
