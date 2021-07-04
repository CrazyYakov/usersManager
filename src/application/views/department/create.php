<?php
$this->page = "Добавить департамент";
?>

<div class="container">
    <form action="create" method="post" class="w-25 mt-5">
        <input type="text" name="name" class="form-floating">
        <label for="exampleFormControlInput1" class="form-label ">Добавить</label>
        <input type="submit" value="Добавить" name="submit" class="btn btn-primary mt-5 mb-3">
    </form>
    
    <a href="/department" class="btn btn-primary">Назад</a>
</div>