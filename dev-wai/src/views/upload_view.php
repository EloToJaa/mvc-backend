<!DOCTYPE html>
<html lang="pl">

<?php include "includes/head.inc.php"; ?>

<body>
    <?php include "includes/header.inc.php"; ?>
    <section>
        <h1>Dodawanie zdjęcia</h1>
        <hr><br>

        <form action="/upload" method="post" enctype="multipart/form-data">
            Wybierz zdjęcie:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>

    </section>
    <?php include "includes/footer.inc.php"; ?>
</body>

</html>