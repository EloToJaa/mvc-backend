<!DOCTYPE html>
<html lang="pl">

<?php include "includes/head.inc.php"; ?>

<body>
    <?php include "includes/header.inc.php"; ?>
    <section>
        <h1>Dodawanie zdjęcia</h1>
        <hr><br>

        <form method="post" enctype="multipart/form-data">
            <label for="fileToUpload"><span style="color:red">*</span> Wybierz zdjęcie:</label>
            <br><input type="file" name="fileToUpload" id="fileToUpload" required><br>

            <label for="author"><span style="color:red">*</span> Autor:</label>
            <input type="text" id="author" name="author" value="" required>

            <label for="title"><span style="color:red">*</span> Tytuł:</label>
            <input type="text" id="title" name="title" value="" required>

            <label for="watermark"><span style="color:red">*</span> Watermark tekst:</label>
            <input type="text" id="watermark" name="watermark" value="" required>

            <input type="submit" value="Wyślij zdjęcie" name="submit">
            <br><br><span style="color:red">*</span> - Wymagane pole<br><br>

            <?php include "partial/messages.php"; ?>
        </form>

        <a href="/gallery"><input id="helpBtn" type="submit" value="Galeria"></a>
    </section>
    <?php include "includes/footer.inc.php"; ?>
</body>

</html>