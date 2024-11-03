<?php

require_once 'autoload.php';

$method = $_SERVER['REQUEST_METHOD'];
$urlArray = explode('/', $_SERVER['REQUEST_URI']);
$user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// При расширении функционала эту часть изменить и перенести в роуты
if ($method === 'GET') {
    require_once 'view/home.php';
} else if ($method === 'POST') {
    require_once 'controller/MessageController.php';
}
