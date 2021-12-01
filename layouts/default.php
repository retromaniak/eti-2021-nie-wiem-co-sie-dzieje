<html>
    <head>
        <title>
            <?php echo $title ?>
        </title>
    </head>
    <body>
    <h1>Hello APSL!</h1>
        <?php include 'addons/flashMessages.php'?>
        <?php if($session->has('user')): ?>
        <p> Witaj <?php echo $session->get('user'); ?></p>
        <?php else: ?>
            <form name="loginForm" method="post" action="<?php echo $router->generate('do_login') ?>">
                <input type="text" name="login" value="" placeholder="Enter your username here">
                <input type="password" name="password" value="" placeholder="Enter your pass here">

                <button type="submit">Zaloguj</button>
            </form>
        <?php endif; ?>

        <a href="<?php echo $router->generate('home') ?>">Home</a>
        <a href="<?php echo $router->generate('body') ?>">BODY Page</a>
        <a href="<?php echo $router->generate('article', ['id' => 2]) ?>">Article Page</a>
        <?php if($session->has('user')): ?>
            <a href="<?php echo $router->generate('logout') ?>">Logout</a>
        <?php endif; ?>

        <?php echo $content ?>

        <?php echo $session->get('user', 'Anonymous') ?>
    </body>
</html>