<?php if(isset($messages)) foreach($messages as $message) {
    if ($message['success']) { ?>
        <span class="login successful-login"><?= $message['content'] ?></span>
    <?php } else {?>
        <span class="login wrong-login"><?= $message['content'] ?></span>
<?php } } ?>