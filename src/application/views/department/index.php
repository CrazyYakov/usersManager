<?php
$this->page = 'Список департаментов';
/**
 * @var array $departments
 * @var array $fields
 */

?>
<div class="container">

    <header class="pb-3 mb-4 border-bottom">
        <h1 class="mt-4">Список департаментов</h1>
        <a href="/department/create" class=" btn btn-primary ">Добавить департамент</a>
    </header>
    <h1>Department</h1>
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

            <? if (empty($departments)) : ?>
                <td colspan="8">
                    <h1 align="center"> <i>Нет данных </i></h1>
                </td>
            <? else : ?>
                <?php foreach ($departments as $department) : ?>
                    <tr>
                        <th scope="row"><?= $department['id'] ?></th>
                        <td><?= $department['name'] ?></td>
                        <td>
                            <a href="/department/view/?action=form&id=<?= $department['id'] ?>" class=" btn btn-info">Обзор</a>
                            <a href="/department/update/?action=form&id=<?= $department['id'] ?>" class=" btn btn-info">Изменить</a>
                            <a href="/department/delete/?action=form&id=<?= $department['id'] ?>" class=" btn btn-info">Удалить</a>
                        </td>
                    </tr>
                <? endforeach ?>
            <? endif ?>

        </tbody>
    </table>
</div>