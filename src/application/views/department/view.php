<?php

/** @var array $department */

$this->page = 'Просмотр Отдела';
?>
<div class="container">
    <header class="pb-3 mb-4 border-bottom">
        <h1 class="mt-4">Отдел</h1>
    </header>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <?php foreach ($department[0] as $parameter => $value): ?>
                <?if (!is_int($parameter)) : ?><p class="col-md-8 fs-4"> <b> <?= $parameter ?>:</b> <?= $value ?> </p> <?endif;?>
            <?php endforeach; ?>
        </div>
    </div>
</div>