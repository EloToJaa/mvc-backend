<?php

require_once 'business.php';
require_once 'controller_utils.php';

function index(&$model) {
    $model['title'] = 'Strona Główna';
    return 'index_view';
}

function task_start(&$model) {
    $model['title'] = 'Zadanie';
    return 'start_view';
}

function task_login(&$model) {
    $model['title'] = 'Zaloguj się';
    return 'task_view';
}

function bug(&$model) {
    $model['title'] = 'Zgłoś błąd';
    return 'bug_view';
}

function upload(&$model) {
    $model['title'] = 'Dodaj zdjęcie';
    if(isset($_FILES['fileToUpload']['name'])) {
        $file_name = upload_file($_POST['watermark']);
    }
    $model['messages'] = get_messages();

    if(!isset($_FILES['fileToUpload']['name'])) {
        return 'upload_view';
    }

    $image = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'file_name' => $file_name
    ];

    add_image($image);

    return 'upload_view';
}

function gallery(&$model) {
    $model['title'] = 'Galeria';
    
    // $model['images'] = get_images();
    return 'gallery_view';
}