<h1>Zapisane zdjęcia</h1>
<hr><br>

<form action="/collection/del" method="post" enctype="multipart/form-data">
    <?php foreach ($images as $image) { ?>
        <div class="responsive">
            <div class="gallery">
                <a target="_blank" href="/images/watermark/<?= $image['file_name'] ?>">
                    <img src="/images/min/<?= $image['file_name'] ?>" alt="<?= $image['title'] ?>">
                </a>
                <div class="desc">
                    <b>Tytuł:</b> <?= $image['title'] ?> <br>
                    <b>Autor:</b> <?= $image['author'] ?> <br>
                    <b>Wybierz: </b> <input type="checkbox" name="check_<?= $image['img_id'] ?>">
                </div>
            </div>
        </div>
    <?php }  ?>

    <div class="clearfix"></div>

    <input type="submit" value="Usuń">
</form>

<br>
<?php for ($page = 1; $page <= $pages; $page++) { ?>
    <span class="page_link"><a href="/collection?page=<?= $page ?>"><?= $page ?></a></span>
<?php }  ?>
<br><br>

<a href="/gallery"><input id="helpBtn" type="submit" value="Wróć do galerii"></a>