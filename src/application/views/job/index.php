<?php
$this->page = 'Список работ';
/**
 * @var array $jobs
 * @var array $fields
 */

?>
<div class="container">
    <header class="pb-3 mb-4 border-bottom">
        <h1 class="mt-4">Список работ</h1>
        <a href="/job/create" class=" btn btn-primary ">Добавить работу</a>
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

            <? if (empty($jobs)) : ?>
                <td colspan="8">
                    <h1 align="center"> <i>Нет данных </i></h1>
                </td>
            <? else : ?>
                <?php foreach ($jobs as $job) : ?>
                    <tr>
                        <th scope="row"><?= $job['id'] ?></th>
                        <td><?= $job['name'] ?></td>
                        <td>
                            <a href="/job/view/?action=form&id=<?= $job['id'] ?>" class=" btn btn-info">Обзор</a>
                            <a href="/job/update/?action=form&id=<?= $job['id'] ?>" class=" btn btn-info">Изменить</a>
                            <form
                                    class="form_btn"
                                    onsubmit="return confirm('Вы уверены что хотите удалить?')"
                                    action="/job/delete?id=<?= $job['id'] ?>"
                                    method="post"
                            >
                                <button type="submit"  class=" btn btn-info">Удалить</button>
                            </form>
                        </td>
                    </tr>
                <? endforeach ?>
            <? endif ?>

        </tbody>
    </table>

</div>