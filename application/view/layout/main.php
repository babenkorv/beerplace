<?php

\vendor\components\AssetManager::setAsset(
    $this->viewUniqueName, [
        'css' => [
            'css/indexPage.css',
            'assets/leaflet/leaflet.css',
            'css/modal.css',
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
        <?php echo (!\vendor\components\Auth::isGuest())    ? '<li class="header-menu-item"><a @click="showAccount = true">Call a friend</a></li>'  : ''; ?>
        <modal-account v-if="showAccount" @close="showAccount = false"></modal-account>
        <?php echo (\vendor\components\Auth::isAdmin())     ? '<li class="header-menu-item"><a href="/admin/bar">Admin dashboard</a></li>'         : ''; ?>
        <?php echo (\vendor\components\Auth::isGuest())     ? '<li class="header-menu-item"><a @click="showLogin = true">LogIn</a></li>'            : ''; ?>
        <modal-login v-if="showLogin" @close="showLogin = false"></modal-login>
        <?php echo (!\vendor\components\Auth::isGuest())    ? '<li class="header-menu-item"><a href="/main/logOut">LogOut</a></li>'                 : ''; ?>
    </ul>
</header>

<?= $content ?>

<?= $assets['js'] ?>

<script type="text/x-template" id="login-template">
    <div id="login-form">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <h3 class="text-center modal-title">Log In</h3>
                    <div class="modal-close"  @click="$emit('close')">X</div>

                    <form class="form-horizontal" action="/main/logIn" method="post">
                        <div class="form-group">
                            <div class="col-3">
                                <label class="form-label" for="email">Email</label>
                            </div>
                            <div class="col-9">
                                <input class="form-input" type="email" name="email" id="email" placeholder="Input your email ..."/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-3">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="col-9">
                                <input class="form-input" type="password" name="password" id="password" placeholder="Input your password ..."/>
                            </div>
                        </div>

                        <input class="btn" type="submit" value="Log in" id="login_button">
                    </form>

                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/x-template" id="account-template">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <h4 class="text-center modal-title"><?= \vendor\components\Auth::getUserEmail() ?></h4>
                    <div class="modal-close"  @click="$emit('close')">X</div>

                    <h5 class="text-center modal-title">Call a friends</h5>
                    <form class="form-horizontal" action="/main/callFriend" method="post">
                        <div class="form-group">
                            <div class="col-3">
                                <label for="email" class="form-label">Email</label>
                            </div>
                            <div class="col-9">
                                <input type="email" class="form-input" name="email" id="email"  placeholder="Input a friend email ...">
                            </div>
                        </div>

                        <input class="btn" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>

</script>

</body>
</html>
