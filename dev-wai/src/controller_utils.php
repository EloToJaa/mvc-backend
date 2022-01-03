<?php

$msg = [];

function get_messages() {
    $msg = $GLOBALS['msg'];
    // print_r($msg);
    // print_r($GLOBALS['msg']);
    $GLOBALS['msg'] = [];
    return $msg;
}

function alert($message, $success = false) {
    echo '<script>console.log("' . $message . '");</script>';
    // $GLOBALS['msg'] = [
    //     'content' => $message,
    //     'success' => $success
    // ];
    array_push($GLOBALS['msg'], [
        'content' => $message,
        'success' => $success
    ]);
    // print_r($GLOBALS['msg']);
}

function upload_file() {
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

            convert_image($target_file, 3, "Testowanie");
        }
        else {
            alert("Błąd podczas wysyłania pliku");
        }
    }
}