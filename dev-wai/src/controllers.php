<?php
require_once 'business.php';


function index(&$model) {
    return 'index_view';
}

function task_start(&$model) {
    return 'start_view';
}

function task_login(&$model) {
    return 'task_view';
}

function bug(&$model) {
    return 'bug_view';
}

function gallery(&$model) {
    
    return 'gallery_view';
}