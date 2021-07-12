<?php
$this->page = 'Обновить  пользователя';

/**
 * @var array $department
 */
?>


<div class="container">

    <form action="/department/update?id=<?= $_GET['id'] ?>" method="post" class="w-25 mt-5">

        <input type="text" name="name" class="form-floating" value="<?= $department[0]['name'] ?>">
        <label for="exampleFormControlInput1" class="form-label">Введите имя</label>

        <input type="submit" value="Отправить" name="submit" class="btn btn-primary mt-5 mb-3">

    </form>
    <a href="<?=($_SERVER['HTTP_REFERER'] ?? "/department") ?>" class="btn btn-primary">Назад</a>
</div>