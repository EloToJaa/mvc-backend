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
    
    return 'upload_view';
}

function gallery(&$model) {
    $model['title'] = 'Galeria';
    
    // $model['images'] = get_images();
    return 'gallery_view';
}