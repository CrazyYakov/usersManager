<?php
/**
 * @var array $user
 * @var array $fields
 */

$this->page = 'Просмотр пользователя';
?>
<div class="container">
    <header class="pb-3 mb-4 border-bottom">
        <h1 class="mt-4">Сотрудник</h1>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <? if (!empty($user)) : ?>
                <h1 class="display-5 fw-bold"> <?= $user[0]['name'] ?> </h1>
                <?php foreach ($user[0] as $parameter => $value): ?>
                    <? if (!is_int($parameter)) : ?>
                        <p class="col-md-8 fs-4">
                            <b> <?= $parameter ?>:</b>
                            <?= $value ?>
                        </p>
                    <? endif; ?>
                <?php endforeach; ?>
            <? endif; ?>
        </div>

    </div>
    <a href="<?= ($_SERVER['HTTP_REFERER'] ?? "/user") ?>" class="btn btn-primary">Назад</a>
</div>
