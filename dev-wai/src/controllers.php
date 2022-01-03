<?php

require_once 'business.php';
require_once 'controller_utils.php';

function index(&$model)
{
    $model['title'] = 'Strona Główna';
    return 'index_view';
}

function task_start(&$model)
{
    $model['title'] = 'Zadanie';
    return 'start_view';
}

function task_login(&$model)
{
    $model['title'] = 'Zaloguj się';
    return 'task_view';
}

function bug(&$model)
{
    $model['title'] = 'Zgłoś błąd';
    return 'bug_view';
}

function upload(&$model)
{
    $model['title'] = 'Dodaj zdjęcie';
    if (isset($_FILES['fileToUpload']['name'])) {
        $file_name = upload_file($_POST['watermark']);
    }
    $model['messages'] = get_messages();

    if (!isset($_FILES['fileToUpload']['name'])) {
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

function gallery(&$model)
{
    $model['title'] = 'Galeria';
    $items_on_page = 8;

    $number_of_img = get_img_id() - 1;
    $model['pages'] = $number_of_img / $items_on_page + 1;

    if (!ctype_digit($_GET['page'])) {
        $model['current_page'] = 1;
    } else {
        $page = intval($_GET['page']);
        if (!isset($page) || $page < 1 || $page > $model['pages']) {
            $model['current_page'] = 1;
        } else {
            $model['current_page'] = $page;
        }
    }

    $images = get_images();

    $page = $model['current_page'];
    $start_img = ($page - 1) * $items_on_page;
    $end_img = min($start_img + $items_on_page, count($images));
    $model['images'] = [];
    for ($i = $start_img; $i < $end_img; $i++) {
        array_push($model['images'], $images[$i]);
    }

    return 'gallery_view';
}

function login(&$model)
{
    $model['title'] = 'Logowanie';

    if (isset($_SESSION['user_id'])) {
        return 'redirect:logged_in';
    }

    $model['messages'] = get_messages();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $password = $_POST['password'];

        // get_messages();

        $valid_login = true;

        if (!user_exists($login)) {
            alert('Użytkownik o nazwie ' . $login . ' nie istnieje');
            $valid_login = false;
        }

        if (!$valid_login) {
            $model['messages'] = get_messages();
            return 'login_view';
        }

        $user = get_user($login);
        $model['login'] = $login;
        $hashed_password = $user['password'];
        $id = $user['_id'];

        if (!password_verify($password, $hashed_password)) {
            alert('Hasło jest nieprawidłowe');
            $valid_login = false;
        }

        if (!$valid_login) {
            $model['messages'] = get_messages();
            return 'login_view';
        }

        // Start session
        $_SESSION['user_id'] = $id;

        return 'redirect:logged_in';
    }
    return 'login_view';
}

function register(&$model)
{
    $model['title'] = 'Rejestracja';

    if (isset($_SESSION['user_id'])) {
        return 'redirect:logged_in';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];

        // get_messages();

        $valid_registration = true;

        if ($password !== $repeat_password) {
            alert('Hasła nie są takie same');
            $valid_registration = false;
        }

        if (user_exists($login)) {
            alert('Użytkownik o nazwie ' . $login . ' już istnieje');
            $valid_registration = false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            alert('Nieprawidłowy adres email');
            $valid_registration = false;
        }

        if (!$valid_registration) {
            $model['messages'] = get_messages();
            return 'register_view';
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $user = [
            'email' => $email,
            'login' => $login,
            'password' => $hashed_password
        ];

        add_user($user);

        alert('Zarejestrowano. Możesz się teraz zalogować');

        return 'redirect:login';
    }
    return 'register_view';
}

function logout(&$model)
{
    $model['title'] = 'Wylogowanie';
    if (isset($_SESSION['user_id'])) {
        session_unset();
        session_destroy();
        session_start();
    }
    return 'redirect:logged_in';
}

function logged_in(&$model)
{
    $logged = $_SESSION['user_id'] !== null;
    if ($logged) {
        $model['title'] = 'Zalogowany';
        return 'logged_in_view';
    } else {
        $model['title'] = 'Nie zalogowany';
        return 'not_logged_in_view';
    }
}
