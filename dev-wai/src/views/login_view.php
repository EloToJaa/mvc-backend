<!DOCTYPE html>
<html lang="pl">

<?php include "includes/head.inc.php"; ?>

<body>
    <?php include "includes/header.inc.php"; ?>
    <section>
        <h1>Dodawanie zdjęcia</h1>
        <hr><br>

        <form method="post" enctype="multipart/form-data">

            <label for="login"><span style="color:red">*</span> Login:</label>
            <input type="text" id="login" name="login" value="" required>

            <label for="password"><span style="color:red">*</span> Hasło:</label>
            <input type="text" id="password" name="password" value="" required>

            <input type="submit" value="Zaloguj się" name="submit">
            <br><br><span style="color:red">*</span> - Wymagane pole<br><br>

            <?php include "partial/messages.php"; ?>
        </form>

        <a href="/register"><input id="helpBtn" type="submit" value="Zarejestruj się" name="submit"></a>

    </section>
    <?php include "includes/footer.inc.php"; ?>
</body>

</html>