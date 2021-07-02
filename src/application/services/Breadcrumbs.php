<?php




class Breadcrumbs{


}


echo  <<<EOT
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/user/index">Список сотрудников</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?={$user[0]['id']}?></li>
        </ol>
    </nav>

EOT;
