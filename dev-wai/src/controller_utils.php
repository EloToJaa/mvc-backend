<?php

function upload_file() {
    $upload_result = 1;
    $target_file = basename($_FILES["fileToUpload"]["name"]);
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            alert("Ten plik jest zdjęciem - " . $check["mime"]);
            $upload_result = 1;
        }
        else {
            alert("Ten plik nie jest zdjęciem");
            $upload_result = 0;
        }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        alert("Rozmiar pliku jest większy niż 1MB");
        $upload_result = 0;
    }

    // Check file extension
    if($image_file_type != "jpg" && $image_file_type != "png") {
        alert("Niepoprawne rozszerzenie pliku");
        $upload_result = 0;
    }

    // Check if $upload_result is set to 0 by an error
    if ($upload_result == 0) {
        alert("Plik nie został wysłany");
    }
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            alert("Plik " . htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])) . " został wysłany");

            convert_image($target_file, 1, "Test");
        }
        else {
            alert("Błąd podczas wysyłania pliku");
        }
    }
}