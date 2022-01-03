<!DOCTYPE html>
<html lang="pl">

<?php include "includes/head.inc.php"; ?>

<body>
    <?php include "includes/header.inc.php"; ?>
    <section>
        <h1>Zalogowano</h1>
        <hr><br>

        <h2>Dane użytkownika</h2><br>

        <b>Id:</b> <?= $user['_id'] ?> <br>
        <b>Email:</b> <?= $user['email'] ?> <br>
        <b>Login:</b> <?= $user['login'] ?> <br><br>

        <a href="/logout"><input id="helpBtn" type="submit" value="Wyloguj się" name="submit"></a>

    </section>
    <?php include "includes/footer.inc.php"; ?>
</body>

</html>