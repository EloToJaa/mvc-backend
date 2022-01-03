<?php

function get_messages() {
    if(isset($GLOBALS['msg'])) {
        $msg = $GLOBALS['msg'];
        $GLOBALS['msg'] = [];
        return $msg;
    }
    $GLOBALS['msg'] = [];
    return null;
}

function alert($message, $success = false) {
    // echo '<script>console.log("' . $message . '");</script>';
    array_push($GLOBALS['msg'], [
        'content' => $message,
        'success' => $success
    ]);
}

function upload_file($watermark) {
    $upload_result = 1;
    $target_file = basename($_FILES["fileToUpload"]["name"]);
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $upload_result = 1;
        }
        else {
            alert("Załączony plik nie jest zdjęciem");
            $upload_result = 0;
            return;
        }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        alert("Rozmiar pliku jest większy niż 1MB");
        $upload_result = 0;
    }

    // Check file type
    if($image_file_type != "jpg" && $image_file_type != "png") {
        alert("Niepoprawne rozszerzenie pliku");
        $upload_result = 0;
    }

    if ($upload_result == 0) {
        alert("Plik nie został wysłany");
    }
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            alert("Plik " . htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])) . " został pomyślnie wysłany", true);
            $id = get_img_id();
            convert_image($target_file, $id, $watermark);
            return $id . '.' . $image_file_type;
        }
        else {
            alert("Błąd podczas wysyłania pliku");
        }
    }
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function get_page(&$model) {
    if (!isset($_GET['page']) || !ctype_digit($_GET['page'])) {
        // page variable is string
        $model['current_page'] = 1;
    } else {
        $page = intval($_GET['page']);
        if (!isset($page) || $page < 1 || $page > $model['pages']) {
            $model['current_page'] = 1;
        } else {
            $model['current_page'] = $page;
        }
    }
}

function paging(&$model, $images, $items_on_page) {
    $page = $model['current_page'];

    $number_of_img = count($images);

    $start_img = ($page - 1) * $items_on_page;
    $end_img = min($start_img + $items_on_page, count($images));

    $model['images'] = [];
    for ($i = $start_img; $i < $end_img; $i++) {
        // $images[$i]['img_id'] = $i + 1;
        array_push($model['images'], $images[$i]);
    }
}