<?php

if ($post = json_decode(file_get_contents('php://input'), true)) {
    if (isset($post['name'], $post['email'], $post['message']) && $post['name'] && $post['email'] && $post['message']) {
        if ((new Message())->addMessage($post['name'], $post['email'], $post['message'])) {
            $result_arr = [
                'res' => 1,
                'message' => 'Введенные данные успешно сохранены',
            ];

            $result = json_encode($result_arr, JSON_UNESCAPED_UNICODE);
            echo $result;
            die();
        }
    }

    $result_arr = [
        'res' => 0,
        'error' => 'Ошибка ввода'
    ];
    $result = json_encode($result_arr, JSON_UNESCAPED_UNICODE);
    echo $result;
    die();
}

$result_arr = [
    'res' => 0,
    'error' => 'Ошибка приложения'
];
$result = json_encode($result_arr, JSON_UNESCAPED_UNICODE);
echo $result;
die();
