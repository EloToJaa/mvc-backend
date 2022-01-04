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
        'file_name' => $file_name,
        'img_id' => (get_img_id() - 1)
    ];

    add_image($image);

    return 'upload_view';
}

function gallery(&$model) {
    $model['title'] = 'Galeria';

    $items_on_page = 8;

    $images = get_images();
    $model['pages'] = count($images) / $items_on_page + 1;

    get_page($model);

    paging($model, $images, $items_on_page);

    return 'gallery_view';
}

function collection(&$model) {
    $model['title'] = 'Kolekcja';

    if (!isset($_SESSION['images'])) {
        return 'redirect:gallery';
    }

    $items_on_page = 8;

    $images = $_SESSION['images'];
    $model['pages'] = count($images) / $items_on_page + 1;

    get_page($model);

    paging($model, $images, $items_on_page);

    return 'collection_view';
}

function collection_add(&$model) {
    $model['title'] = 'Kolekcja';

    // Adding to collection
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $images = get_images();
        for($i = 1; $i <= count($images); $i++) {
            $image = $images[$i - 1];
            if(isset($_POST['check_' . $i]) && $_POST['check_' . $i] === 'Yes') {
                array_push($_SESSION['images'], $image);
            }
        }
    }

    return 'redirect:collection';
}

function collection_del(&$model) {
    $model['title'] = 'Kolekcja';

    // Removing from collection 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $images = [];
        foreach($_SESSION['images'] as $image) {
            if($_POST['check_' . $image['img_id']] !== 'Yes') {
                array_push($images, $image);
            }
        }
    }

    return 'redirect:collection';
}

function login(&$model) {
    $model['title'] = 'Logowanie';

    if (is_logged_in()) {
        return 'redirect:logged_in';
    }

    $model['messages'] = get_messages();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $password = $_POST['password'];

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

function register(&$model) {
    $model['title'] = 'Rejestracja';

    if (is_logged_in()) {
        return 'redirect:logged_in';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];

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

function logout(&$model) {
    $model['title'] = 'Wylogowanie';
    if (is_logged_in()) {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['images'] = [];
    }
    return 'redirect:logged_in';
}

function logged_in(&$model) {
    $model['title'] = 'Dane';

    $logged = $_SESSION['user_id'] !== null;
    if ($logged) {
        $user = get_user_by_id($_SESSION['user_id']);
        $model['user'] = $user;
        return 'logged_in_view';
    } else {
        return 'not_logged_in_view';
    }
}
