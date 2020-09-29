<?php
// Имя пользователя
$username = 'manager';
// Новый пароль
$password = 'Pzgn942e';
// Предоставить ли пользователю неограниченные права
$sudo = true;

require 'config.core.php';
require MODX_CORE_PATH. 'model/modx/modx.class.php';
$modx = new modX();
if ((!$modx) || (!$modx instanceof modX)) {
    echo 'Could not create MODX class';
}
$modx->initialize('mgr');
$modx->getService('error', 'error.modError', '', '');
$user = $modx->getObject('modUser', ['username' => $username]);

if ($user) {
    $profile = $user->getOne('Profile');
    $user->set('password', $password);
    $profile->set('blocked', 0);
    $profile->set('blockeduntil', 0);
    $profile->set('blockedafter', 0);
    $user->setSudo($sudo);
    $user->save();
    echo 'Пользователь обновлён';
} else {
    echo 'Пользователь не найден';
}
?>