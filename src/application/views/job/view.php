<?php

/** @var array $job */
/** @var array $fields */
/** @var array $data */

$this->page = 'Просмотр работы';
?>
<div class="container">
    <header class="pb-3 mb-4 border-bottom">
        <h1 class="mt-4">Профессия</h1>
    </header>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold"> <?= $job[0]['name'] ?> </h1>
            <?php foreach ($job[0] as $parameter => $value): ?>
                <? if (!is_int($parameter)) : ?><p class="col-md-8 fs-4"> <b> <?= $parameter ?>:</b> <?= $value ?>
                    </p> <? endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <a href="<?= ($_SERVER['HTTP_REFERER'] ?? "/user") ?>" class="btn btn-primary">Назад</a>
    <? if (empty($data)) : ?>
    <? else : ?>
        <table class="table ">
            <thead>
            <tr>
                <?php foreach ($fields as $parameter) : ?>
                    <th scope="col"> <?= $parameter ?></th>
                <?php endforeach ?>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $key => $person) : ?>
                <tr>
                    <th scope="row"><?= $person['id'] ?></th>
                    <td><?= $person[$fields['name']] ?></td>
                    <td><?= $person[$fields['department']] ?></td>
                    <td><?= $person[$fields['salary']] ?></td>
                    <td><?= $person[$fields['birthday']] ?></td>
                    <td><?= $person[$fields['created_at']] ?></td>
                    <td>
                        <a href="/user/view/?&id=<?= $person['id'] ?>" class=" btn btn-info">Обзор</a>
                        <a href="/user/update/?&id=<?= $person['id'] ?>" class=" btn btn-info">Изменить</a>
<!--                        <form-->
<!--                                class="form_btn"-->
<!--                                onsubmit="return confirm('Вы уверены что хотите удалить?')"-->
<!--                                action="/user/delete?id=--><?//= $person['id'] ?><!--"-->
<!--                                method="post"-->
<!--                        >-->
<!--                            -->
<!--                            <button type="submit" class="btn btn-info">Удалить</button>-->
<!--                        </form>-->
                    </td>
                </tr>
            <?php endforeach ?>

            </tbody>
        </table>
    <? endif ?>
</div>