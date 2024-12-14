<?php
$db_name = 'mysql:host=localhost;dbname=spa_db';
$user_name = 'root';
$user_password = '';

try {
    $conn = new PDO($db_name, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Установка режима ошибок

} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit; // Завершение скрипта при ошибке подключения
}

function unique_id() {
    $chars = '0123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM';
    $charLength = strlen($chars);
    $randomString = '';
    for ($i = 0; $i < 20; $i++) { // Исправлено условие цикла
        $randomString .= $chars[mt_rand(0, $charLength - 1)];
    }
    return $randomString;
}


?>