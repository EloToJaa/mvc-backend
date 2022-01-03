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
    $items_on_page = 8;

    $number_of_img = get_img_id() - 1;
    $model['pages'] = $number_of_img / $items_on_page + 1;

    if(!ctype_digit($_GET['page'])) {
        $model['current_page'] = 1;
    }
    else {
        $page = intval($_GET['page']);
        if(!isset($page) || $page < 1 || $page > $model['pages']) {
            $model['current_page'] = 1;
        }
        else {
            $model['current_page'] = $page;
        }
    }

    $images = get_images();

    $page = $model['current_page'];
    $start_img = ($page - 1) * $items_on_page;
    $end_img = min($start_img + $items_on_page, count($images));
    $model['images'] = [];
    for($i = $start_img; $i < $end_img; $i++) {
        array_push($model['images'], $images[$i]); 
    }

    return 'gallery_view';
}