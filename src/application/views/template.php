<?php
/** @var  $content
 */

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?= $this->page ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/application/public/css/style.css">

    <? if ($this->route->getUrl() == 'auth/login') : ?>
        <link rel="stylesheet" href="/application/public/css/style_login.css">
    <? endif; ?>

</head>
<body>
<? if (!empty($this->session->getSession('session_login'))): ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
        <div class="container-fluid container">
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user">Сотрудники</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/department">Список департаментов</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/job">Список професий</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <a href="/auth/out" class="btn btn-danger">Выйти</a>
            </div>
        </div>
    </nav>
<? endif ?>
<?= $content; ?>
</body>
</html>