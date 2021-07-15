<?php
$this->page = "Авторизация";
?>
<div class="text-center container w-25">
    <main class="form-signin">
        <form action="/Auth/login" method="post">
            <h1 class="h3 mb-3 fw-normal">Please log in</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" name="login" placeholder="name">
                <label for="floatingInput">login</label>
            </div>
            <div class="form-floating mt-2">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-5" type="submit">Sign in</button>
        </form>
    </main>
</div>







