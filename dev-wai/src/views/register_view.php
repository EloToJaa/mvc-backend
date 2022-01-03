<!DOCTYPE html>
<html lang="pl">

<?php include "includes/head.inc.php"; ?>

<body>
    <?php include "includes/header.inc.php"; ?>
    <section>
        <h1>Rejestracja</h1>
        <hr><br>

        <form method="post" enctype="multipart/form-data">
            <label for="email"><span style="color:red">*</span> Adres e-mail:</label>
            <input type="text" id="email" name="email" value="" required>

            <label for="login"><span style="color:red">*</span> Login:</label>
            <input type="text" id="login" name="login" value="" required>

            <label for="password"><span style="color:red">*</span> Hasło:</label>
            <input type="password" id="password" name="password" value="" required>

            <label for="repeat_password"><span style="color:red">*</span> Powtórz hasło:</label>
            <input type="password" id="repeat_password" name="repeat_password" value="" required>

            <input type="submit" value="Zarejestruj" name="submit">
            <br><br><span style="color:red">*</span> - Wymagane pole<br><br>

            <?php include "partial/messages.php"; ?>
        </form>

        <a href="/login"><input id="helpBtn" type="submit" value="Zaloguj się" name="submit"></a>

    </section>
    <?php include "includes/footer.inc.php"; ?>
</body>

</html>