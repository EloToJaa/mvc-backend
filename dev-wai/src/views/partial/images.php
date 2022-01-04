<h1>Galeria</h1>
<hr><br>

<form action="/collection/add" method="post" enctype="multipart/form-data">
    <?php foreach ($images as $image) { ?>
        <div class="responsive">
            <div class="gallery">
                <a target="_blank" href="/images/watermark/<?= $image['file_name'] ?>">
                    <img src="/images/min/<?= $image['file_name'] ?>" alt="<?= $image['title'] ?>">
                </a>
                <div class="desc">
                    <b>Tytuł:</b> <?= $image['title'] ?> <br>
                    <b>Autor:</b> <?= $image['author'] ?> <br>
                    <b>Id:</b> <?= $image['img_id'] ?> <br>
                    <b>Nazwa:</b> <?= $image['file_name'] ?> <br>
                    <b>Wybierz: </b> <input type="checkbox" name="check_<?= $image['img_id'] ?>">
                </div>
            </div>
        </div>
    <?php }  ?>

    <div class="clearfix"></div>

    <input type="submit" value="Zapamiętaj wybrane">
</form>

<br>
<?php for ($page = 1; $page <= $pages; $page++) { ?>
    <span class="page_link"><a href="/gallery?page=<?= $page ?>"><?= $page ?></a></span>
<?php }  ?>
<br><br>

<a href="/upload"><input id="helpBtn" type="submit" value="Dodaj zdjęcie"></a>
<a href="/collection"><input id="helpBtn" type="submit" value="Zapamiętane"></a>