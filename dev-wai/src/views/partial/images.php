<h1>Galeria</h1>
<hr><br>

<?php foreach($images as $image) { ?>
    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="/images/watermark/<?= $image['file_name'] ?>">
                <img src="/images/min/<?= $image['file_name'] ?>" alt="<?= $image['title'] ?>">
            </a>
            <div class="desc">
                <b>Tytuł:</b> <?= $image['title'] ?> <br>
                <b>Autor:</b> <?= $image['author'] ?>
            </div>
        </div>
    </div>
<?php }  ?>

<div class="clearfix"></div>

<br>
<?php for($page = 1; $page <= $pages; $page++) { ?>
    <span class="page_link"><a href="/gallery?page=<?= $page ?>"><?= $page ?></a></span>
<?php }  ?>
<br><br>

<a href="/upload"><input type="submit" value="Dodaj zdjęcie"></a>