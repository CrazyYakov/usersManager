<?php

/**
 * @var array $data
 * @var array $fields
 */

$this->page = 'Пользователи';
?>
<div class="container">
    <header class="pb-3 mb-4 border-bottom">
        <h1 class="mt-4">Список сотрудников</h1>
        <a href="/user/create" class=" btn btn-primary ">Создать пользователя</a>
    </header>

    <table class="table">
        <thead>
        <tr>

            <th scope="col">id</th>
            <?php foreach ($fields as $parameter) : ?>
                <th scope="col"> <?= $parameter ?></th>
            <?php endforeach ?>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <? if (empty($data)) : ?>
            <tr>
                <td colspan="8"><h1 align="center"><i>Нет данных </i></h1></td>
            </tr>
        <? else : ?>

            <?php foreach ($data as $key => $person) : ?>
                <tr>
                    <th scope="row"><?= $person['id'] ?></th>
                    <td><?= $person['name'] ?></td>
                    <td><?= $person['job'] ?></td>
                    <td><?= $person['department'] ?></td>
                    <td><?= $person['salary'] ?></td>
                    <td><?= $person['birthday'] ?></td>
                    <td><?= $person['created_at'] ?></td>
                    <td>
                        <a href="/user/view/?action=form&id=<?= $person['id'] ?>" class=" btn btn-info">Обзор</a>
                        <a href="/user/update/?action=form&id=<?= $person['id'] ?>" class=" btn btn-info">Изменить</a>
                        <form
                                class="form_btn"
                                onsubmit="return confirm('Вы уверены что хотите удалить?')"
                                action="/user/delete?id=<?= $person['id'] ?>"
                                method="post"
                        >
                            <button type="submit"  class="btn btn-info">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>

        <? endif ?>

        </tbody>
    </table>
</div>