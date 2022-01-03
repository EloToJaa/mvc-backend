<!DOCTYPE html>
<html lang="pl">

<?php include "includes/head.inc.php"; ?>

<body>
    <?php include "includes/header.inc.php"; ?>
    <section>
        <h1>Obrazek SVG</h1>
        <hr><br>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            Wybierz zdjęcie:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>

    </section>
    <?php include "includes/footer.inc.php"; ?>
</body>

</html>