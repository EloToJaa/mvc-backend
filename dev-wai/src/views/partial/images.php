<h1>Galeria</h1>
<hr><br>
<!-- <div class="responsive">
    <div class="gallery">
        <a target="_blank" href="static/img/img1.jpg">
            <img src="static/img/img1.jpg" alt="Obrazek 1">
        </a>
        <div class="desc">Obrazek numer 1</div>
    </div>
</div>


<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="static/img/img2.jpg">
            <img src="static/img/img2.jpg" alt="Obrazek 2">
        </a>
        <div class="desc">Obrazek numer 2</div>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="static/img/img3.jpg">
            <img src="static/img/img3.jpg" alt="Obrazek 3">
        </a>
        <div class="desc">Obrazek numer 3</div>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="static/img/img4.jpg">
            <img src="static/img/img4.jpg" alt="Obrazek 4">
        </a>
        <div class="desc">Obrazek numer 4</div>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="static/img/img5.jpg">
            <img src="static/img/img5.jpg" alt="Obrazek 5">
        </a>
        <div class="desc">Obrazek numer 5</div>
    </div>
</div>

<div class="responsive">
    <div class="gallery">
        <a target="_blank" href="static/img/img6.jpg">
            <img src="static/img/img6.jpg" alt="Obrazek 6">
        </a>
        <div class="desc">Obrazek numer 6</div>
    </div>
</div> -->

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