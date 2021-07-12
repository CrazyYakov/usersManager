<?php
$this->page = 'Список департаментов';
/**
 * @var array $departments
 * @var array $fields
 * @var array $status
 */

?>

<div class="container">

    <header class="pb-3 mb-4 border-bottom">
        <h1 class="mt-4">Список департаментов</h1>
        <a href="/department/create" class=" btn btn-primary ">Добавить департамент</a>
    </header>
    <table class="table">
        <thead>
        <tr>
            <?php foreach ($fields as $parameter) : ?>
                <th scope="col"> <?= $parameter ?></th>
            <?php endforeach ?>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <? if (empty($departments)) : ?>
            <td colspan="8">
                <h1 align="center"><i>Нет данных </i></h1>
            </td>
        <? else : ?>
            <?php foreach ($departments as $department) : ?>
                <tr>
                    <th scope="row"><?= $department['id'] ?></th>
                    <td><?= $department['name'] ?></td>
                    <td class="dep_btns">
                        <a href="/department/?action=view&id=<?= $department['id'] ?>" class=" btn btn-info">Обзор</a>
                        <a href="/department/?action=update&id=<?= $department['id'] ?>"
                           class=" btn btn-info">Изменить</a>
                        <form
                                class="form_btn"
                                onsubmit="return confirm('Вы уверены что хотите удалить?')"
                                action="/department/delete?id=<?= $department['id'] ?>"
                                method="post"
                        >
                            <button type="submit" class=" btn btn-info">Удалить</button>
                        </form>
                    </td>
                </tr>
            <? endforeach ?>
        <? endif ?>
        </tbody>
    </table>
</div>