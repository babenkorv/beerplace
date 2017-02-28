<?php
$user = new \application\models\User();
$bar = new \application\models\Bar();
$comment = new \application\models\Comment();
$unActiveUser = $user->select(['id'])->count('id')->findOne()["COUNT(ID)"] - $user->select(['id'])->where('is_active', '=', "1")->count('id')->findOne()["COUNT(ID)"];
$unActiveBar = $bar->select(['id'])->count('id')->findOne()["COUNT(ID)"] - $bar->select(['id'])->where('is_active', '=', "1")->count('id')->findOne()["COUNT(ID)"];
$unActiveComment = $comment->select(['id'])->count('id')->findOne()["COUNT(ID)"] - $comment->select(['id'])->where('is_active', '=', "1")->count('id')->findOne()["COUNT(ID)"];

\vendor\components\AssetManager::setAsset(
    $this->viewUniqueName, [
        'css' => [
            'css/indexPage.css',
            'assets/leaflet/leaflet.css',
            'css/modal.css',
            'css/adminPage.css',
        ],
        'js' => [
            'assets/vue.min.js',
            'js/login.js',
        ],
    ]
);

$assets = \vendor\components\AssetManager::register($this->viewUniqueName);
?>


<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?= $assets['html'] ?>
</head>
<body>
<header>
    <div class="title"><a href="/">beer place</a></div>
    <ul class="header-menu">
        <li class="header-menu-item"><a href="/">to beer card</a></li>
    </ul>
</header>
<div class="container">
    <ul class="admin_mnu">
        <li class="admin-menu-item"><a href="/admin/user">Users (+<?=$unActiveUser?>)</a></li>
        <li class="admin-menu-item"><a href="/admin/bar">Bars (+<?=$unActiveBar?>)</a></li>
        <li class="admin-menu-item"><a href="/admin/comment">Comments (+<?=$unActiveComment?>)</a></li>
    </ul>
    <div class="content">
        <?= $content ?>
    </div>
</div>

<?= $assets['js'] ?>
</body>
</html>
