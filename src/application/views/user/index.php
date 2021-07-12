<?php

/**
 * @var array $data
 * @var array $fields
 */

$this->page = 'Пользователи';

?>
<div class="container">
    <header class="pb-3 mb-4 border-bottom" role="presentation">
        <h1 class="mt-4"><q>Список сотрудников</q></h1>
        <a href="/user/create" class=" btn btn-primary" role="button">Создать пользователя</a>
    </header>

    <table class="table">
        <thead>
        <tr>
            <?php foreach ($fields as $field) : ?>
                <th scope="col"> <?= $field ?></th>
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
                    <td><?= $person[$fields['name']] ?></td>
                    <td><?= $person[$fields['job']] ?></td>
                    <td><?= $person[$fields['department']] ?></td>
                    <td><?= $person[$fields['salary']] ?></td>
                    <td><?= $person[$fields['birthday']] ?></td>
                    <td><?= $person[$fields['created_at']] ?></td>
                    <td>
                        <a href="/user/view/?&id=<?= $person['id'] ?>" class=" btn btn-info">Обзор</a>
                        <a href="/user/update/?&id=<?= $person['id'] ?>" class=" btn btn-info">Изменить</a>
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