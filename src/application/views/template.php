<?php /** @var  $content */ ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?= $this->page ?></title>
    <link rel="stylesheet" href="/application/public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<? if (isset($_SESSION['session_login']) && !empty($_SESSION['session_login'])): ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
        <div class="container-fluid">
            <div class="collapse navbar-collapse container" id="navbarNav">
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
        </div>
    </nav>
<? endif ?>
<?= $content; ?>
</body>
</html>