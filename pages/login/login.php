<?php
require '../../api/mainloader.php';

if (isLogged()) {
    header('Location: ' . url('index.php'));
    exit('ALREADY_LOGGED_IN');
}

$header = new Header();
$header->setTitle("Authentication");
$header->setDescription("Pouvoir grignoter des carottes tous ensemble !");
$header->addCss('../assets/css/style.css');
$header->render();

$ref = (isset($_SERVER['HTTP_REFERER']))
    ? $_SERVER['HTTP_REFERER']
    : null;
?>

<div id="login-block" class="block">
    <h3>Je suis un lapin</h3>
    <form action="<?php echo url('login/process_login.php'); ?>" method="post">
        <input type="hidden" name="type" value="login">
        <input type="hidden" name="ref" value="<?php echo $ref ?>">
        <input name="email" placeholder="Email">
        <br />
        <input name="password" type="password" placeholder="Mot de passe">
        <br />
        <input type="submit" class="submit-block">
    </form>
</div>

<div id="register-block" class="block">
    <h3>Je veux devenir un lapin</h3>
    <form action="<?php echo url('login/process_register.php'); ?>" method="post">
        <input type="hidden" name="type" value="register">
        <input type="hidden" name="ref" value="<?php echo $ref ?>">
        <input name="display" placeholder="Pseudo">
        <br />
        <input name="email" placeholder="Email">
        <br />
        <input name="password" type="password" placeholder="Mot de passe">
        <br />
        <input type="submit" class="submit-block">
    </form>
</div>