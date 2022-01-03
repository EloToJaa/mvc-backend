<!DOCTYPE html>
<html lang="pl">

<?php include "includes/head.inc.php"; ?>

<body>
    <?php include "includes/header.inc.php"; ?>
    <section>
        <h1>Dodawanie zdjęcia</h1>
        <hr><br>

        <form action="/upload" method="post" enctype="multipart/form-data">
            <label for="fileToUpload"><span style="color:red">*</span> Wybierz zdjęcie:</label>
            <br><input type="file" name="fileToUpload" id="fileToUpload"><br>

            <label for="author"><span style="color:red">*</span> Autor:</label>
            <input type="text" id="author" name="author" value="">

            <label for="title"><span style="color:red">*</span> Tytuł:</label>
            <input type="text" id="title" name="title" value="">

            <label for="watermark"><span style="color:red">*</span> Watermark tekst:</label>
            <input type="text" id="watermark" name="watermark" value="">

            <input type="submit" value="Upload Image" name="submit">
            <br><br><span style="color:red">*</span> - Wymagane pole

            <?php include "partial/messages.php"; ?>
        </form>

    </section>
    <?php include "includes/footer.inc.php"; ?>
</body>

</html>